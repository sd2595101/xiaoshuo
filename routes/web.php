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

Route::match(['get'], '/', 'Xiaoshuo\IndexController@index');

Route::match(['get'], '/xiaoshuo', 'Xiaoshuo\IndexController@index');

Route::match(['get'], '/query', 'Xiaoshuo\SearchController@search');

Route::match(['get'], '/xiaoshuo/book/{bookid}.html', 'Xiaoshuo\BookController@index');

Route::match(['get'], '/xiaoshuo/chapter/{bookid}.html', 'Xiaoshuo\ChapterController@index');

Route::match(['get'], '/xiaoshuo/chapter/{bookid}/{chapterid}.html', 'Xiaoshuo\ContentController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'TestController@index')->name('home');
https://www.google.co.jp/search?q=%E7%83%BD%E7%81%AB%E6%88%8F%E8%AF%B8%E4%BE%AF+%E5%89%91%E6%9D%A5
