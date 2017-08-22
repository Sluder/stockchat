<?php

// ---------- Pages
Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'PageController@home')->name('home');
Route::post('/login/view', 'PageController@loginShow')->name('login.view');


// ---------- Account
Route::post('/join', 'Auth\AuthController@join')->name('join');
Route::get('/check/{data}', 'AccountController@checkAvailability');
Route::post('/login', 'Auth\AuthController@login')->name('login');
Route::get('/login/google', 'Auth\AuthController@redirectToGoogle')->name('google.login');
Route::get('/login/callback', 'Auth\AuthController@googleCallback');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

Route::get('/profile/{username}', 'PageController@profile')->name('profile');
Route::post('/profile/update', 'AccountController@updateProfile')->name('profile.update');
Route::post('/password/update', 'AccountController@updatePassword')->name('password.update');
Route::get('/following/{page}', 'AccountController@getFollowing');

Route::get('/follow/{user}', 'AccountController@follow')->name('follow');
Route::get('/unfollow/{user}', 'AccountController@unfollow')->name('unfollow');


// ---------- Groups
Route::get("/room", "RoomController@roomShow")->name("room.view");
Route::get("/leave/{room_id}", "RoomController@leave")->name("room.leave");
Route::post("/create", "RoomController@create")->name("room.create");
Route::match(['GET', 'POST'], "/join/{key?}", "RoomController@join")->name("room.join");
Route::get("/{key}", "RoomController@room")->name("room"); // Last