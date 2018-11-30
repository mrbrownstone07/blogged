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

Route::get('/', 'PagesController@index');
Route::get('/about_us', 'PagesController@about_us');
Route::get('/contact_us', 'PagesController@contact_us');
Route::get('/faq', 'PagesController@faq');


Route::resource('post', 'PostsController');



// Route::get('/about', function(){
//     return view('pages.about');
// });
