<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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


Auth::routes();


Route::group([
    'middleware' => 'auth',
    'as' => 'admin.',
    'namespace' => '\App\Http\Controllers'
], function () {
//    Route::get('/', function () {
//        return redirect()->route('admin.shops.index');
//    });
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', 'UsersController')->except('show')->middleware('role:admin');
    Route::resource('lots', 'LotsController')->except('show');
    Route::resource('categories', 'CategoriesController')->except('show');

    Route::group([
        'as' => 'media.',
        'prefix' => 'media'
    ], function () {
        Route::get('browser', 'MediaController@all');
        Route::post('browser', 'MediaController@upload');
        Route::post('upload', 'UploadsController@store')->name('upload');
        Route::post('wysiwyg', 'MediaController@wysiwyg')->name('wysiwyg');
        Route::delete('{media}', 'UploadsController@destroy')->name('destroy');
    });

});

