<?php

// ----- Pages
Route::get('/', 'PageController@home')->name('home');

// ----- Groups
Route::get("/room/main", "RoomController@roomAdd")->name("room.main");
Route::match(['GET', 'POST'], "/join/{key?}", "GroupController@join")->name("room.join");
Route::post("/create", "RoomController@create")->name("room.create");
Route::get("/room/{key}", "RoomController@group")->name("room");