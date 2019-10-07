<?php

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

// Route::get('/', function () {
//     $lists = App\Lists::all()->where('owner_id', auth()->id());
//     return view('welcome', compact('lists'));
// });
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::post('/lists', 'ListsController@store')->name('lists.store');
Route::delete('/lists/{list}', 'ListsController@destroy')->name('lists.destroy');
Route::get('/lists/{list}', 'ListsController@show')->name('lists.show');
Route::get('/export', 'ListsController@export')->name('export');

// Route::put('lists/{list}', 'ListsController@update'); TODO
// Route::get('lists/{list}/edit', 'ListsController@edit'); TODO

// Route::resource('/lists', 'ListsController');
// POST      | lists                      | lists.store      | App\Http\Controllers\ListsController@store                             | web,auth                                        |
// |        | GET|HEAD  | lists                      | lists.index      | App\Http\Controllers\ListsController@index                             | web,auth                                        |
// |        | GET|HEAD  | lists/create               | lists.create     | App\Http\Controllers\ListsController@create                            | web,auth                                        |
// |        | DELETE    | lists/{list}               | lists.destroy    | App\Http\Controllers\ListsController@destroy                           | web,auth                                        |
// |        | PUT|PATCH | lists/{list}               | lists.update     | App\Http\Controllers\ListsController@update                            | web,auth                                        |
// |        | GET|HEAD  | lists/{list}               | lists.show       | App\Http\Controllers\ListsController@show                              | web,auth                                        |
// |        | GET|HEAD  | lists/{list}/edit          | lists.edit       | App\Http\Controllers\ListsController@edit                              | web,auth                                    

Route::get('/preferences', 'PrefsController@index')->name('pref.index');
Route::post('/preferences', 'PrefsController@update')->name('pref.update');