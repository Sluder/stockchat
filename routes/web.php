<?php

// ----- Pages
Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'PageController@home')->name('home');
Route::post('/login/view', 'AccountController@loginShow')->name('login.view');


// ----- Account
Route::post('/join/new', 'AccountController@join')->name('join.new');
Route::post('/login', 'AuthController@login')->name('login');


// ----- Groups
Route::get("/room", "RoomController@roomShow")->name("room.view");
Route::post("/create", "RoomController@create")->name("room.create");
Route::match(['GET', 'POST'], "/join/{key?}", "RoomController@join")->name("room.join");
Route::get("/{key}", "RoomController@room")->name("room"); // Needs to be last