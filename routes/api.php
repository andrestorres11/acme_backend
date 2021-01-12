<?php
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

Route::group( ['middleware' => 'validateUser'], function(){

	

	Route::get('/users', 'UserController@index')->name('user.index');
	Route::get('/user/{user_id}', 'UserController@show')->name('user.show');
	Route::post('/user/store', 'UserController@store')->name('user.store');
	Route::get('/user/close-session', 'UserController@Logout')->name('user.logout');

	Route::get('/owners', 'OwnerController@index')->name('owner.index');
	Route::post('/owner/store', 'OwnerController@store')->name('owner.store');
	Route::get('/owner/{owner_id}', 'OwnerController@show')->name('owner.show');
	Route::get('/owner-delete/{owner_id}', 'OwnerController@destroy')->name('owner.delete');
	Route::post('/owner-update/{owner_id}', 'OwnerController@update')->name('owner.update');

	Route::get('/drivers', 'DriverController@index')->name('driver.index');
	Route::post('/driver/store', 'DriverController@store')->name('driver.store');
	Route::get('/driver/{driver_id}', 'DriverController@show')->name('driver.show');
	Route::get('/driver-delete/{driver_id}', 'DriverController@destroy')->name('driver.delete');
	Route::post('/driver-update/{driver_id}', 'DriverController@update')->name('driver.update');

	Route::get('/cars', 'CarController@index')->name('car.index');
	Route::post('/car/store', 'CarController@store')->name('car.store');
	Route::get('/car/{car_id}', 'CarController@show')->name('car.show');
	Route::get('/car-delete/{car_id}', 'CarController@destroy')->name('car.delete');
	Route::post('/car-update/{car_id}', 'CarController@update')->name('car.update');

	Route::get('/lifes', 'LifeController@index')->name('life.index');
	Route::post('/life/store', 'LifeController@store')->name('life.store');
	Route::get('/life/{life_id}', 'LifeController@show')->name('life.show');
	Route::get('/life-delete/{life_id}', 'LifeController@destroy')->name('life.delete');
	Route::post('/life-update/{life_id}', 'LifeController@update')->name('life.update');
});


Route::post('/user', 'UserController@validateLogin')->name('user.login');