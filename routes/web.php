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
//     return view('welcome');
// });

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/test', 'TestController@index')->name('test');

Auth::routes();

Route::domain('im-bravo.com')->group(function () {
    require 'FrontEnd.php';
});

Route::domain('novel.im-bravo.com')->group(function () {
    require 'FrontEnd.php';
});

Route::domain('novel-manager.im-bravo.com')->group(function () {
    require 'BackEnd.php';
});
