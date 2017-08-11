<?php

// ----- Pages
Route::get('/', 'PageController@home')->name('home');
Route::get('/login', 'AccountController@loginShow')->name('login.view');


// ----- Groups
Route::get("/room", "RoomController@roomShow")->name("room.view");
Route::post("/create", "RoomController@create")->name("room.create");
Route::match(['GET', 'POST'], "/join/{key?}", "RoomController@join")->name("room.join");


// ----- Account
Route::post('/join/new', 'AccountController@join')->name('join.new');
Route::post('/login/', 'AccountController@join')->name('join.new');


Route::get("/{key}", "RoomController@room")->name("room"); // Needs to be last