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

Route::get('/test', 'TestController@index')->name('test');

Auth::routes();

//Route::domain('im-bravo.com')->group(function () {
//    
//});

//Route::match(['get'], '/', 'Xiaoshuo\IndexController@index')->name('index');

function route_xiaoshuo() {
    Route::match(['get'], '/', 'Xiaoshuo\IndexController@index')->name('index');
    Route::match(['get'], '/search', 'Xiaoshuo\SearchController@search')->name('query');
    Route::match(['get'], '/book/{bookid}.html', 'Xiaoshuo\BookController@index')->name('book');
    Route::match(['get'], '/chapter/{bookid}.html', 'Xiaoshuo\ChapterController@index')->name('chapter');
    
    Route::match(['get'], '/chapter/{bookid}/', 'Xiaoshuo\ChapterController@index')->name('chapter');
    
    Route::match(['get'], '/chapter/{bookid}/{chapterid}.html', 'Xiaoshuo\ContentController@index')->name('content');
}

route_xiaoshuo();

