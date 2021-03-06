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


Route::get('/', 'HomeController@welcome')->name('home');
Route::get('images/{disk}/{filename}', 'HomeController@retrieveImages');
// Route::get('product/{product}', 'HomeController@productInfo')->name('product.info');

# No Authenticated User Section
Route::group(['middleware' => ['authno']], function () {
    Route::get('login', 'UserController@showLogin')->name('login');
    Route::post('login', 'UserController@postLogin')->name('login.post');
    Route::get('register', 'UserController@showRegister')->name('register');
    Route::post('register', 'UserController@postRegister')->name('register.post');
});

# Admin User Section
Route::group(['middleware' => ['admin']], function () {
    Route::get('admin/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::post('showunits', 'AdminController@showUnits')->name('units.show');
    Route::resource('product', 'ProductController');
    // Route::get('admin/product', 'AdminController@productPage')->name('product');
    // Route::post('admin/product', 'AdminController@addProduct')->name('product.post');
});

# Authenticated User Section
Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', 'UserController@logout')->name('logout');
    Route::post('cart/drop', 'HomeController@cartDrop')->name('cart.drop'); 
    Route::post('address', 'HomeController@addAddress')->name('address.add');	

    Route::group([ 'namespace' => 'user' ], function () {
        Route::resource('basket', 'BasketController');
        Route::resource('order', 'OrderController');
    });
});


Route::get('activate/{id}/{code}', function($id, $code) {
	$user = Sentinel::findById($id);
	if ( !Activation::complete($user, $code)) {
		return Redirect()->to("login")->withErrors('Invalid or expired activation code.');
	}
	return Redirect()->to('login')->withSuccess('Account activated.');
});