<?php

namespace App\Http\Controllers;

use App\Models\Administration\Kiosk;
use App\Models\Administration\Record;
use App\Models\Administration\Transaction;
use App\Models\Administration\Umbrella;
use App\Models\Administration\Vendor;
use App\Models\User;
use Auth;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        
        // Check if User has Active Record
        $rentalCheck = true;
        $activeRecord = Record::where([
            ['users_id', $currentUser->id],
            ['status', 0],
        ])->exists();

        if ($activeRecord) {
            $rentalCheck = false;
        }

        // Retrieve Available Kiosk Station(s)
        $kiosks = Kiosk::where('status', 1)->orderBy('id', 'ASC')->get();

        // Centering Old Main Building
        Mapper::map(40.7964652, -77.86278949);

        // Retrieve Specific Location for Available Kiosk
        foreach ($kiosks as $kiosk) 
        {
            $umbrella = $this->countAvailableUmbrella($kiosk->id);

            if ($rentalCheck) {
                Mapper::informationWindow($kiosk->lat, $kiosk->lng, 'Available Umbrella: '. $umbrella . '<br><a href="/pickup/'.$kiosk->id.'/">Pickup Umbrella Here</a>', ['open' => false, 'maxWidth' => 200, 'markers' => ['title' => 'Available Kiosk']]);
            } else {
                Mapper::informationWindow($kiosk->lat, $kiosk->lng, 'Available Umbrella: '. $umbrella . '<br><a href="/dropoff/'.$kiosk->id.'/">Dropoff Umbrella Here</a>', ['open' => false, 'maxWidth' => 200, 'markers' => ['title' => 'Available Kiosk']]);
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

        return view('frontend.pickup', compact('kiosk', 'umbrella'));
    }

    // Dropoff Umbrella View
    public function dropoff($id)
    {
        $kiosk = Kiosk::findOrFail($id);

        return view('frontend.dropoff', compact($kiosk));
    }

    public function account()
    {
        $currentUser = Auth::user();

        return view('frontend.account', compact($currentUser));
    }

    public function recharge()
    {
        return view('frontend.recharge');
    }

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

    public function history()
    {
        $records = Record::where('users_id', Auth::id())->orderBy('id', 'DESC')->limit(8)->get();

        $data = [
            'records' => $records,
        ];

        return view('frontend.history')->with($data);
    }

    // Count Available Umbrella on Specific Kiosk
    protected static function countAvailableUmbrella($id)
    {
        $query = DB::table('umbrella')->join('kiosk', 'umbrella.kiosk_id', '=', 'kiosk.id')->where([
                ['umbrella.kiosk_id', '=', $id],
                ['umbrella.status', '=', 0],
            ])->count();

        return $query;
    }

}
