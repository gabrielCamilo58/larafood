<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->middleware('auth')->group(function ()
{
     /** 
     * Route Products
     */
    route::any('products/search','ProductController@search')->name('products_search');
    route::delete('products/{id}/destroy', 'ProductController@destroy')->name('products_destroy');
    route::get('products/{id}/show', 'ProductController@show')->name('products_show');
    route::put('products/{id}/edit', 'ProductController@update')->name('products_update');
    route::get('products/{id}/edit', 'ProductController@edit')->name('products_edit');
    route::post('products/store', 'ProductController@store')->name('products_store');
    route::get('products/create', 'ProductController@create')->name('products_create');
    Route::get('products', 'ProductController@index')->name('products_index');

    /** 
     * Route Categories
     */
    route::any('categories/search','CategoryController@search')->name('categories_search');
    route::delete('categories/{id}/destroy', 'CategoryController@destroy')->name('categories_destroy');
    route::get('categories/{id}/show', 'CategoryController@show')->name('categories_show');
    route::put('categories/{id}/edit', 'CategoryController@update')->name('categories_update');
    route::get('categories/{id}/edit', 'CategoryController@edit')->name('categories_edit');
    route::post('categories/store', 'CategoryController@store')->name('categories_store');
    route::get('categories/create', 'CategoryController@create')->name('categories_create');
    Route::get('categories', 'CategoryController@index')->name('categories_index');


     /** 
     * Route Users
     */
    route::any('users/search','UserController@search')->name('users_search');
    route::delete('users/{id}/destroy', 'UserController@destroy')->name('users_destroy');
    route::get('users/{id}/show', 'UserController@show')->name('users_show');
    route::put('users/{id}/edit', 'UserController@update')->name('users_update');
    route::get('users/{id}/edit', 'UserController@edit')->name('users_edit');
    route::post('users/store', 'UserController@store')->name('users_store');
    route::get('users/create', 'UserController@create')->name('users_create');
    Route::get('users', 'UserController@index')->name('users_index');

    /**
     * Route Plan x Profile 
     */
    Route::post('profile/plan/{id}/available/search', 'ACL\PlanProfileController@searchProfilePlan')->name('plan_profile_available_search');
    Route::get('profile/plan/{id}/available', 'ACL\PlanProfileController@profiles')->name('plan_profile_available_Profile');
    Route::get('profile/{id}/plan/{idP}/detach', 'ACL\PlanProfileController@detach')->name('plan_profile_detach');
    Route::post('profile/{id}/plan/attach', 'ACL\PlanProfileController@attach')->name('plan_profile_attach');
    Route::any('profile/{id}/plan/available', 'ACL\PlanProfileController@planAvailable')->name('plan_profile_available');
    Route::get('profile/{id}/plan', 'ACL\PlanProfileController@plan')->name('plan_profile');

    /**
     * Route Permission x 
     */
    Route::post('profile/permissions/{id}/available/search', 'ACL\PermissionProfileController@searchProfilePermission')->name('profiles_permission_search');
    Route::get('profiles/permissons/{idPermission}/available', 'ACL\PermissionProfileController@profiles')->name('profiles_permissons_available_profiles');
    Route::get('profiles/{id}/permisson/{idPerssion}/detach', 'ACL\PermissionProfileController@detach')->name('profiles_permissons_detach');
    Route::post('profiles/{id}/permissons/attach', 'ACL\PermissionProfileController@attach')->name('profiles_permissons_attach');
    Route::any('profiles/{id}/permissons/available', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles_permissons_available');
    Route::get('profiles/{id}/permissons', 'ACL\PermissionProfileController@permissions')->name('profiles_permissons');
    

    /**
     * Route Permission
     */

    route::any('permission/search','ACL\PermissionController@search')->name('permission_search');
    route::delete('permission/{id}/destroy', 'ACL\PermissionController@destroy')->name('permission_destroy');
    route::get('permission/{id}/show', 'ACL\PermissionController@show')->name('permission_show');
    route::put('permission/{id}/edit', 'ACL\PermissionController@update')->name('permission_update');
    route::get('permission/{id}/edit', 'ACL\PermissionController@edit')->name('permission_edit');
    route::post('permission/store', 'ACL\PermissionController@store')->name('permission_store');
    route::get('permission/create', 'ACL\PermissionController@create')->name('permission_create');
    Route::get('permission', 'ACL\PermissionController@index')->name('permission_index');

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
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details_plan_create');
    Route::delete('plans/{url}/details/{idDetails}', 'DetailPlanController@destroy')->name('details_plan_destroy');
    Route::get('plans/{url}/details/{idDetails}', 'DetailPlanController@show')->name('details_plan_show');
    Route::put('plans/{url}/details/{idDetails}/edit', 'DetailPlanController@update')->name('details_plan_update');
    Route::get('plans/{url}/details/{idDetails}/edit', 'DetailPlanController@edit')->name('details_plan_edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details_plan_store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details_plan_index');



    /**
     * Routes Plans
     */
    Route::post('plans', 'PlanController@store')->name('plans_store');
    Route::get('plans', 'PlanController@index')->name('plans_index');
    Route::get('plans/create', 'PlanController@create')->name('plans_create');
    Route::any('plans/search', 'PlanController@search')->name('plans_search');
    Route::get('plans/{url}', 'PlanController@show')->name('plans_show');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans_destroy');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans_edit');
    Route::put('plans/{url}', 'PlanController@update')->name('plans_update');
    
    
    /**
     * Home Dashboard
     */
    Route::get('/', 'PlanController@index')->name('admin_index');
});

/**
 * Routes site
 */
Route::get('/plan/{url}', 'App\Http\Controllers\Site\SiteController@plan')->name('plan_subscription');
Route::get('/','App\Http\Controllers\Site\SiteController@index')->name('site_home');

/**
 * Auth Routes
 */
Auth::routes();