<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function ()
{
    /**
     * Route Profiles
     */
    
    route::any('profiles/search','ACL\ProfileController@search')->name('profiles_search');
    route::delete('profiles/{id}/destroy', 'ACL\ProfileController@destroy')->name('profiles_destroy');
    route::get('profiles/{id}/show', 'ACL\ProfileController@show')->name('profiles_show');
    route::put('profiles/{id}/edit', 'ACL\ProfileController@update')->name('profiles_update');
    route::get('profiles/{id}/edit', 'ACL\ProfileController@edit')->name('profiles_edit');
    route::post('profiles/store', 'ACL\ProfileController@store')->name('profiles_store');
    route::get('profiles/create', 'ACL\ProfileController@create')->name('profiles_create');
    Route::get('profiles', 'ACL\ProfileController@index')->name('profiles_index');


    /**
     * Routes Details Plans
     */
    Route::delete('plans/{url}/details/{idDetails}', 'DetailPlanController@destroy')->name('details_plan_destroy');
    Route::get('plans/{url}/details/{idDetails}', 'DetailPlanController@show')->name('details_plan_show');
    Route::put('plans/{url}/details/{idDetails}/edit', 'DetailPlanController@update')->name('details_plan_update');
    Route::get('plans/{url}/details/{idDetails}/edit', 'DetailPlanController@edit')->name('details_plan_edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details_plan_store');
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details_plan_create');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details_plan_index');



    /**
     * Routes Plans
     */
    Route::get('plans', 'PlanController@index')->name('plans_index');
    Route::get('plans/create', 'PlanController@create')->name('plans_create');
    Route::any('plans/search', 'PlanController@search')->name('plans_search');
    Route::post('plans', 'PlanController@store')->name('plans_store');
    Route::get('plans/{url}', 'PlanController@show')->name('plans_show');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans_destroy');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans_edit');
    Route::put('plans/{url}', 'PlanController@update')->name('plans_update');
    
    /**
     * Home Dashboard
     */
    Route::get('/', 'App\Http\Controllers\Admin\PlanController@index')->name('admin_index');
});


Route::get('/', function () {
    return view('welcome');
});
