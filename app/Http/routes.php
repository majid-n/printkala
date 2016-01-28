<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'HomeController@welcome');
    Route::get('logout', 'UserController@logout');

    Route::get('login', 'UserController@showLogin');
    Route::post('login', 'UserController@postLogin');


    Route::get('register', 'UserController@showRegister');
    Route::post('register', 'UserController@postRegister');

    Route::get('admin/product', 'AdminController@productPage');
    Route::post('admin/product', 'AdminController@addProduct');	
    
    Route::post('addbasket', 'AjaxController@addBasket');   
    Route::post('rembasket', 'AjaxController@remBasket');   
    
    Route::post('loadbasket', 'AjaxController@loadbasket');	
});


Route::get('activate/{id}/{code}', function($id, $code) {
	$user = Sentinel::findById($id);
	if ( !Activation::complete($user, $code)) {
		return Redirect()->to("login")->withErrors('Invalid or expired activation code.');
	}
	return Redirect()->to('login')->withSuccess('Account activated.');
})->where('id', '\d+');