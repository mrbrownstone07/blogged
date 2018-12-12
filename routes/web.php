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





Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile/{slug}','ProfilesController@index');
    //Route::get('changePhoto', 'ProfilesController@changePhoto');
    Route::post('/uploadPhoto', 'ProfilesController@uploadPhoto');
    Route::get('/editInfo', 'ProfilesController@editInfo');
    Route::post('/storeInfo', 'ProfilesController@storeInfo');
    Route::post('/updateInfo', 'ProfilesController@updateInfo');
    
    Route::get('/findPeople', 'FollowsController@index');
    Route::get('/follow/{followe}', 'FollowsController@followRequest');
    Route::get('/followFrompProfileView/{followe}', 'FollowsController@followFromProfileRequest');
    Route::get('/unfollowFrompProfileView/{followe}', 'FollowsController@unfollowFromProfileRequest');
    Route::get('/show_followers', 'FollowsController@showFollowers');
    Route::get('/show_followees', 'FollowsController@showFollowees');
    Route::get('/unfollow/{followe}', 'FollowsController@unfollowRequest');
    Route::get('/remove/{follower}', 'FollowsController@removeFollower');

    Route::get('/profilePicData', 'ProfilesController@getProfilePicSectionData');
    Route::get('/followerCount', 'ProfilesController@getFollowerCount');
    Route::get('/followeeCount', 'ProfilesController@getFolloweeCount');
    Route::resource('post', 'PostsController');
    //Route::get('/posts/{id}/edit', 'PostsController@edit');
    Route::get('/getUserPosts', 'PostsController@getUserPosts');
    Route::get('/fetchNoti/{user_id}', 'NotificationsController@fetchNotifications');
    Route::get('/posts/{id}', 'PostsController@show');

    Route::get('/show_notifiaction/{noti_id}', 'NotificationsController@showNotifications');
    
    
});









