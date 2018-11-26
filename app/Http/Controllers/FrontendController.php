<?php

namespace App\Http\Controllers;

use App\Models\Administration\Kiosk;
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
        $kiosks = Kiosk::where('status', 1)->get();

        Mapper::map(40.7964652, -77.86278949);

        foreach ($kiosks as $kiosk) 
        {
            $umbrella = DB::table('umbrella')->join('kiosk', 'umbrella.kiosk_id', '=', 'kiosk.id')->where([
                ['umbrella.kiosk_id', '=', $kiosk->id],
                ['umbrella.status', '=', 0],
            ])->count();
            Mapper::informationWindow($kiosk->lat, $kiosk->lng, 'Available Umbrella: '. $umbrella, ['open' => false, 'maxWidth' => 200, 'markers' => ['title' => 'Available Kiosk']]);
        }

        return view('frontend.dashboard');
    }

    public function account()
    {
        return view('frontend.account');
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
        return view('frontend.history');
    }
}
