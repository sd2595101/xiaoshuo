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
