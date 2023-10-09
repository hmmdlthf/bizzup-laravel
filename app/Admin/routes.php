<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('customers', CustomerController::class);
    $router->resource('countries', CountryController::class);
    $router->resource('states', StateController::class);
    $router->resource('cities', CityController::class);
    $router->resource('emails', EmailController::class);
    $router->resource('phones', PhoneController::class);
    $router->resource('websites', WebsiteController::class);
    $router->resource('whatsapps', WhatsappController::class);
    $router->resource('social-types', SocialTypeController::class);
    $router->resource('socials', SocialController::class);
    $router->resource('other-images', OtherImageController::class);
    $router->resource('products', ProductController::class);
    $router->resource('nfc-cards', NfcCardController::class);

});
