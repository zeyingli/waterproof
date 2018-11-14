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
    $router->get('/api/get-kiosks', 'KioskController@getKiosks');
    $router->get('/api/get-availableUmbrella', 'UmbrellaController@getAvailableUmbrella');

    // Custom Route
    $router->post('/operations/kiosk/status', 'KioskController@status');

});
