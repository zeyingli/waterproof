<?php

namespace App\Http\Controllers;

use App\Models\Administration\Kiosk;
use App\Models\Administration\Record;
use App\Models\Administration\Transaction;
use App\Models\Administration\Umbrella;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class FrontendController extends Controller
{
    // Environment Variables
    private static $billBySecond = 0.001;
    private static $maximumCharge = 20;
    private static $defaultPaymentCode = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getBillBySecond()
    {
        return self::$billBySecond;
    }

    public function getDefaultPaymentCode()
    {
        return self::$defaultPaymentCode;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // Get Current Authenticated User Info
        $currentUser = Auth::user();

        // Check if User has Active or Overdued Record
        $rentalCheck = $this->rentalAvailabilityCheck($currentUser->id);

        // Retrieve Available Kiosk Station(s)
        $kiosks = Kiosk::where('status', 1)->orderBy('id', 'ASC')->get();

        // Centering Old Main Building
        Mapper::map(40.7964652, -77.86278949);

        // Retrieve Specific Location for Available Kiosk
        foreach ($kiosks as $kiosk) {
            $umbrella = $this->countAvailableUmbrella($kiosk->id);

            if ($rentalCheck) {
                Mapper::informationWindow($kiosk->lat, $kiosk->lng, 'Available Umbrella: '.$umbrella.'<br><a href="/pickup/'.$kiosk->id.'/">Pickup Umbrella Here</a>', ['open' => false, 'maxWidth'=> 200, 'markers' => ['icon' => 'https://cdn.mapmarker.io/api/v1/pin?size=50&background=%23009CE0&icon=fa-umbrella&color=%23FFFFFF&voffset=0&hoffset=1&']]);
            } else {
                Mapper::informationWindow($kiosk->lat, $kiosk->lng, 'Available Umbrella: '.$umbrella.'<br><a href="/dropoff/'.$kiosk->id.'/">Dropoff Umbrella Here</a>', ['open' => false, 'maxWidth'=> 200, 'markers' => ['icon' => 'https://cdn.mapmarker.io/api/v1/pin?size=50&background=%23009CE0&icon=fa-arrow-down&color=%23F44E3B&voffset=0&hoffset=1&']]);
            }
        }

        $data = [
            'rentalCheck' => $rentalCheck,
            'kiosks'      => $kiosks,
        ];

        return view('frontend.dashboard')->with($data);
    }

    // Pickup Umbrella View
    public function pickup($id)
    {
        $kiosk = Kiosk::findOrFail($id);
        $umbrella = $this->countAvailableUmbrella($id);
        $overdueCheck = $this->overdueRecordCheck(Auth::id());

        return view('frontend.pickup', compact('kiosk', 'umbrella', 'overdueCheck'));
    }

    // On Trip View
    public function ontrip()
    {
        $activeRecord = Record::where([
            ['users_id', Auth::id()],
            ['status', 0],
        ])->first();

        $data = [
            'record' => $activeRecord,
        ];

        return view('frontend.ontrip')->with($data);
    }

    // Dropoff Umbrella View
    public function dropoff($id)
    {
        $kiosk = Kiosk::findOrFail($id);
        $umbrella = $this->countAvailableUmbrella($id);

        return view('frontend.dropoff', compact('kiosk', 'umbrella'));
    }

    // Return Account Page
    public function account()
    {
        $currentUser = Auth::user();
        $overdueCheck = $this->overdueRecordCheck($currentUser->id);

        $data = [
            'currentUser'  => $currentUser,
            'overdueCheck' => $overdueCheck,
        ];

        return view('frontend.account')->with($data);
    }

    // Account Activation Page
    public function activate()
    {
        if (!empty(Auth::user()->username) || !empty(Auth::user()->phone)) {
            return redirect('/account')->with('success', 'Your account has been activated, no further action required.');
        }

        return view('frontend.activation');
    }

    // Return Recharge View
    public function recharge()
    {
        return view('frontend.recharge');
    }

    // Retrieve Payment History
    public function history()
    {
        $records = Record::where('users_id', Auth::id())->orderBy('id', 'DESC')->limit(8)->get();

        $data = [
            'records' => $records,
        ];

        return view('frontend.history')->with($data);
    }

    public function rewards()
    {
        return redirect('/account')->with('notice', 'Rewards program is rolling out, rent more and get more! Thanks for choosing Waterproof!');
    }

    // Help Center
    public function help()
    {
        return view('frontend.help');
    }

    // Terms of Use and Conditions
    public function terms()
    {
        return view('frontend.terms');
    }

    // Processing Account Activation
    public function doActivation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'          => 'required|max:20|unique:users',
            'phone'             => 'required|digits:10|unique:users',
            'terms'             => 'required',
            'skipVerification'  => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $currentUser = Auth::user();
        $currentUser->username = $request->username;
        $currentUser->phone = $request->phone;
        $currentUser->balance += 10.00;

        if (isset($request->skipVerification)) {
            $currentUser->email_verified_at = now();
        }

        $currentUser->save();

        return redirect('/account')->with('success', 'Your account has been succesfully activated. We hope you enjoy!');
    }

    // Add Balance Method
    public function addBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|regex:/^(\d*\.)?\d+$/',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $currentUser = User::findOrFail(Auth::id());
        $currentBalance = $currentUser->balance;
        $currentUser->balance = $currentBalance + $request->get('amount');
        $currentUser->save();

        return redirect('/account')->with('success', 'Value has been successfully added into your account.');
    }

    // Picking up Umbrella
    public function pickupUmbrella($id)
    {
        $currentUserId = Auth::id();
        // Final Check
        $rentalCheck = $this->rentalAvailabilityCheck($currentUserId);
        $overdueCheck = $this->overdueRecordCheck($currentUserId);

        if (!$rentalCheck || !$overdueCheck) {
            return redirect('/account')->with('errors', 'Unable to pickup umbrella due to you are having an active or overdued record on file, please try again later.');
        }

        $kiosk = Kiosk::find($id);
        $umbrellas = Umbrella::where([
            ['kiosk_id', $id],
            ['status', 0],
        ])->pluck('id')->toArray();
        $umbrellaId = array_random($umbrellas);

        $newRecord = new Record();
        $newRecord->users_id = $currentUserId;
        $newRecord->kiosk_id = $id;
        $newRecord->umbrella_id = $umbrellaId;
        $newRecord->start_time = now();
        $newRecord->status = 0;
        $newRecord->save();

        $lockUmbrella = $this->lockUmbrella($umbrellaId);

        return redirect('/ontrip')->with('success', 'Picked up Umbrella Successfully.');
    }

    // Dropping off Umbrella
    public function dropoffUmbrella($id)
    {
        $kiosk = Kiosk::find($id);

        $record = Record::where([
            ['users_id', Auth::id()],
            ['status', 0],
        ])->firstOrFail();

        $record->return_kiosk = $kiosk->name;
        $record->end_time = now();
        $startTime = $record->start_time;
        $endTime = now();

        $calcBill = $this->doCalcBill($startTime, $endTime);
        $runTransaction = $this->doTransaction($record->id, $calcBill);
        $unlockUmbrella = $this->unlockUmbrella($record->umbrella_id, $id);

        $record->save();

        if (!$runTransaction) {
            return redirect('/account')->with('overdued', 'Dropped off umbrella successfully, however your account does not have sufficient fund to pay for this order. Your account has been locked until paid off.');
        }

        return redirect('/account')->with('success', 'Dropped off umbrella successfully! Thank you for choosing Waterproof, we hope to see you again!');
    }

    // Pay Overdued Order
    public function payOverduedOrder(Request $request)
    {
        $record = $request->id;
        $amount = $request->amount;

        if (Auth::user()->balance < $amount) {
            return redirect('/account')->with('overdued', 'Account does not have sufficient fund for paying this order.');
        }

        $runTransaction = $this->doTransaction($record, $amount);

        return redirect('/account')->with('success', 'Overdue order has been succesfully paid off.');
    }

    // Rental Availability Check
    private static function rentalAvailabilityCheck($id)
    {
        $activeRecord = Record::where([
            ['users_id', $id],
            ['status', 0],
        ])->exists();

        if ($activeRecord) {
            return false;
        }

        return true;
    }

    // Overdued Record Check
    private static function overdueRecordCheck($id)
    {
        $overdueRecord = Record::where([
            ['users_id', $id],
            ['status', 3],
        ])->exists();

        if ($overdueRecord) {
            return false;
        }

        return true;
    }

    // Count Available Umbrella on Specific Kiosk
    public static function countAvailableUmbrella($id)
    {
        $query = DB::table('umbrella')->join('kiosk', 'umbrella.kiosk_id', '=', 'kiosk.id')->where([
                ['umbrella.kiosk_id', '=', $id],
                ['umbrella.status', '=', 0],
            ])->count();

        return $query;
    }

    // Calculating Billing Amount
    private static function doCalcBill($t1, $t2)
    {
        $startTime = Carbon::parse($t1);
        $endTime = Carbon::parse($t2);
        $duration = $endTime->diffInSeconds($startTime);

        $totalAmount = $duration * self::$billBySecond;

        if ($totalAmount > self::$maximumCharge) {
            $totalAmount = self::$maximumCharge;
        }

        return $totalAmount;
    }

    // Executing Transaction Procedure
    private static function doTransaction($id, $amount)
    {
        $currentUser = Auth::user();
        $currentBalance = $currentUser->balance;

        $newTransaction = new Transaction();
        $newTransaction->vendor_id = self::$defaultPaymentCode;
        $newTransaction->record_id = $id;
        $newTransaction->amount = $amount;

        $newTransaction->save();

        if ($currentBalance < $amount) {
            $mark = self::markOverdue($id);

            return false;
        } else {
            $chargeBill = self::chargeBalance($currentUser->id, $currentBalance, $amount);
            $mark = self::markComplete($id);
        }

        return true;
    }

    // Mark Order as Overdue
    private static function markOverdue($id)
    {
        $record = Record::find($id);

        $record->status = 3;
        $record->save();

        return $record;
    }

    // Mark Order as Complete
    private static function markComplete($id)
    {
        $record = Record::find($id);

        $record->status = 1;
        $record->save();

        return $record;
    }

    // Charge User Bill
    private static function chargeBalance($id, $current, $amount)
    {
        $newBalance = $current - $amount;
        $charge = User::find($id)->update(['balance' => $newBalance]);

        return $charge;
    }

    // Locking Umbrella
    private static function lockUmbrella($id)
    {
        $lock = Umbrella::find($id)->update(['status' => 1]);

        return $lock;
    }

    // Unlocking Umbrella
    private static function unlockUmbrella($id, $kiosk)
    {
        $unlock = Umbrella::find($id)->update([
            'kiosk_id' => $kiosk,
            'status'   => 0,
        ]);

        return $unlock;
    }
}
