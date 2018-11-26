<?php

namespace App\Http\Controllers;

use App\Models\Administration\Kiosk;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        Mapper::map(53.381128999999990000, -1.470085000000040000);
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
}
