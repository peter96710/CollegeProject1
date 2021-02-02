<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//
//        return view('home');
//});

Auth::routes();

Route::group(['middleware'=>'web'],function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/homepage', 'HomeController@homepage')->name('homepage');
    Route::get('/kapcsolat', 'HomeController@contact')->name('contact');
});

Route::group(['middleware'=>'auth'],function() {
    Route::get('/profile', 'HomeController@profile')->name('profile');
});

Route::group(['middleware' => 'role:tanar', 'prefix' => 'tanar'], function () {
    Route::get('home', 'TanarController@home')->name('tanarhome');
    Route::get('newcourse', 'TanarController@newcourse')->name('newcourse');
    Route::get('newcoursefunction', 'TanarController@newcoursefunction')->name('newcoursefunction');
    Route::get('publish/{published}', 'TanarController@publish')->name('publish');
    Route::get('unpublish/{published}', 'TanarController@unpublish')->name('unpublish');
    Route::get('destroy/{subjects}', 'TanarController@destroy')->name('destroy');
    Route::get('update/{subjects}', 'TanarController@update')->name('update');
    Route::get('updateing/{id}', 'TanarController@updateing')->name('updateing');

});
Route::get('list/{subjects}', 'TanarController@list')->name('subjlist')->middleware('role:tanar');


Route::group(['middleware' => 'role:diak', 'prefix' => 'diak'], function () {
    Route::get('home', 'DiakController@home')->name('diakhome');
    Route::get('newcourses', 'DiakController@newcourses')->name('diaknew');
    Route::get('pickup/{id}', 'DiakController@pickup')->name('pickup');
    Route::get('destroy/{id}', 'DiakController@destroy')->name('delete');
});

Route::get('diak/subjlist/{subjects}', 'DiakController@list')->name('subjlistdiak')->middleware('role:diak');
