<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'Api\Internal'
], function () {
  Route::resource('tea-types', 'TeaTypeController');  
  Route::resource('tea-ingredient-roles', 'TeaIngredientRoleController');
  Route::resource('tea-ingredients', 'TeaIngredientController');
  Route::resource('tea-blends', 'TeaBlendController');
});
