<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/summary', 'HomeController@summary');

    // Operations Class
    $router->resources([
    	'/operations/kiosk' 		=> KioskController::class,
    	'/operations/umbrella' 		=> UmbrellaController::class, 
    	'/operations/record' 		=> RecordController::class,
    	'/operations/transaction' 	=> TransactionController::class,
    	'/operations/vendor' 		=> VendorController::class, 
    ]);

    // API Route
    $router->get('/api/get-users', 'ApiController@getUsers');
    $router->get('/api/get-user', 'ApiController@getUser');
    $router->get('/api/get-kiosk', 'ApiController@getKioskByName');
    $router->get('/api/get-umbrellas', 'ApiController@getUmbrellasBySerialNumber');
    $router->get('/api/get-allavailableumbrellas', 'ApiController@getAllAvailableUmbrellaBySerialNumber');
    $router->get('/api/get-availableumbrella', 'UmbrellaController@getAvailableUmbrella');
    $router->get('/api/get-vendor', 'ApiController@getVendorByName');
    $router->get('/api/get-record', 'ApiController@getRecordByName');
    $router->get('/api/get-recordId', 'ApiController@getRecordById');

    // Custom Route
    $router->post('/operations/kiosk/status', 'KioskController@status');

});
