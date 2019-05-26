<?php
use App\Drink;
use App\UnitType;
use App\User;
use App\Place;
use App\DrinkType;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $drinks = Drink::all();
    $units = UnitType::all();
    return view('homepage', compact('drinks','units'));
});

Auth::routes();

Route::resource('/me/drinks', 'UserDrinkController');

Route::get('/map', function() {
    $places = Place::all();
    $units = UnitType::all();
    return view('map', compact('places','units'));
})->name('map');

Route::post('/drinksOfPlace', 'Controller@drinksOfPlaceAjax');
//Route::get('/home', 'HomeController@index')->name('home');
