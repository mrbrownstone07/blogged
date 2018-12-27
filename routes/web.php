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
Route::get('/blog', 'PagesController@blog');
Route::get('/admin_log_in', 'AdminController@index');


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

    Route::get('/show_notifiaction/{noti_id}/{noti_type}', 'NotificationsController@showNotifications');

    Route::get('/like/{post_id}/{liked_by}/{path}', 'ReactsController@handleRequest');

    Route::post('/store_comment', 'CommentsController@store');
    Route::get('/delete_comment/{comment_id}/{location}', 'CommentsController@deleteComment');
    
    Route::get('/search', 'SearchController@search');
    Route::get('/s', 'SearchController@index');
    
    Route::get('/dicussion_rooms/{slug}', 'RoomsController@index');
    Route::post('/create_room', 'RoomsController@create');
    Route::get('/show_room/{id}', 'RoomsController@show');
    Route::get('/create_topic', 'RoomsController@createTopic');
    Route::post('/store_topic/comment', 'RoomsController@storeComment');
    Route::get('/join_room/{room_id}', 'RoomsController@joinRoom');
    Route::get('/delete_topic/{topic_id}', 'RoomsController@deletTopic');
    Route::get('/show_room_members/{room_id}', 'RoomsController@showRoomMembers');
    Route::get('/remove_member/{mem_id}/{room_id}', 'RoomsController@removeMember');
    
    Route::get('/talk', 'TalkController@index');
    Route::get('/show_conversation/{id}', 'TalkController@conversation');
    Route::post('/send_message', 'TalkController@sendMessage');
    Route::get('/get_messages', 'TalkController@fetchMessages');
    Route::get('/fetch_all', 'TalkController@fetchAll');
    Route::get('last_text', 'TalkController@fetchOnlineusers');
    Route::get('get_msg_noti', 'TalkController@fetchMsgNoti');
    Route::get('get_new_msg', 'TalkController@getNewMsg');
    Route::get('/delete_chat_history/{reciverid}', 'TalkController@deleteChatHistory');


    Route::get('/admin_log_in_request', 'AdminController@login');
    Route::get('/showAllPosts', 'AdminController@showAllPosts');
    Route::get('/deletePost/{id}', 'AdminController@deletePost');
    Route::get('/showAllUsers', 'AdminController@showAllUsers');


    
});









