<?php

// ----- Pages
Route::get('/', 'PageController@home')->name('home');

// ----- Groups
Route::get("/room", "RoomController@roomAdd")->name("room.main");
Route::match(['GET', 'POST'], "/join/{key?}", "RoomController@join")->name("room.join");
Route::post("/create", "RoomController@create")->name("room.create");

Route::get("{key}", "RoomController@room")->name("room"); // Needs to be last