<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Administration\Kiosk;
use App\Models\Administration\Record;
use App\Models\Administration\Transaction;
use App\Models\Administration\Umbrella;
use App\Models\Administration\Vendor;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class ApiController extends Controller
{
    use HasResourceActions;

    /**
     * @var string
     */
    protected $title = 'API Management';

    /**
      * @param $request
      * @return json
      */
    // Search for All Users
    public function getUsers()
    {
    	return User::where('id', '>', '0')->paginate(null, ['id', 'name as text']);
    }

    // Search for Specific User
    public function getUser(Request $request)
    {
    	$q = $request->get('q');

        return User::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    // Search for All Kiosks
    public function getKioskByName(Request $request) 
    {
        $q = $request->get('q');

        return Kiosk::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    // Search for Umbrella by Serial Number
    public function getUmbrellasBySerialNumber(Request $request)
    {
    	$q = $request->get('q');

    	return Umbrella::where('serial_number', 'like', "%$q%")->paginate(null, ['id', 'serial_number as text']);
    }

    // Search for All Available Umbrella by Serial Number
    public function getAllAvailableUmbrellaBySerialNumber(Request $request) 
    {
    	$q = $request->get('q');

    	return Umbrella::where([
    		['status', '=', 0],
    		['serial_number', 'like', "%$q%"],
    	])->paginate(null, ['id', 'serial_number as text']);
    }

    // Search for All Available Umbrella from Specific Kiosk
    public function getAvailableUmbrella(Request $request)
    {
        $kioskID = $request->get('q');

        return Umbrella::where([
            ['kiosk_id', '=', $kioskID],
            ['status', '=', 0],
        ])->count('id');
    }

    // Search for Specific Vendor
    public function getVendorByName(Request $request)
    {
    	$q = $request->get('q');

    	return Vendor::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function getRecordById(Request $request)
    {
    	$q = $request->get('q');

    	return Record::where('id', 'like', "%$q%")->paginate(null, ['id', 'status as status']);
    }

    // Search for Specific Order
    public function getRecordByName(Request $request)
    {
    	$q = $request->get('q');

    	return Record::where('id', 'like', "%$q%")->paginate(null, ['id', 'users_id as userID']);
    }

}


