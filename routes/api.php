<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/sanctum/token', 'App\Http\Controllers\Api\Auth\AuthClientController@auth');


Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/me', 'App\Http\Controllers\Api\Auth\AuthClientController@me');
    Route::post('/logout', 'App\Http\Controllers\Api\Auth\AuthClientController@logout');

    Route::post('/auth/v1/orders{identify}/evaluations', 'App\Http\Controllers\Api\EvaluationApiController@store');

    Route::post('auth/v1/order', 'App\Http\Controllers\Api\OrderApiController@store');
    Route::get('auth/v1/my-orders', 'App\Http\Controllers\Api\OrderApiController@myOrders');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api'
], function() {

Route::get('/tenants/{uuid}', 'TenantApiController@show');
Route::get('/tenants', 'TenantApiController@index');

Route::get('/categories/{identify}', 'CategoryApiController@show');
Route::get('/categories', 'CategoryApiController@categoriesByTenant');

Route::get('/tables/{identify}', 'tablesApiController@show');
Route::get('/tables', 'tablesApiController@tablesByTenant');

Route::get('/products/{identify}', 'ProductsApiController@show');
Route::get('/products', 'ProductsApiController@productsByTenant');

Route::post('/client', 'Auth\RegisterController@store');



Route::get('/order/{identify}', 'OrderApiController@show');
Route::post('/order', 'OrderApiController@store');


});