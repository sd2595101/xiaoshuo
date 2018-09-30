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

Route::match(['get'], '/', 'Xiaoshuo\IndexController@index')->name('index');

Route::match(['get'], '/xiaoshuo', 'Xiaoshuo\IndexController@index');

Route::match(['get'], '/query', 'Xiaoshuo\SearchController@search')->name('query');

Route::match(['get'], '/xiaoshuo/book/{bookid}.html', 'Xiaoshuo\BookController@index')->name('book');

Route::match(['get'], '/xiaoshuo/chapter/{bookid}.html', 'Xiaoshuo\ChapterController@index')->name('chapter');

Route::match(['get'], '/xiaoshuo/chapter/{bookid}/{chapterid}.html', 'Xiaoshuo\ContentController@index')->name('content');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'TestController@index')->name('test');
