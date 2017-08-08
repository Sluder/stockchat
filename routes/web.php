<?php

// ----- Pages
Route::get('/', 'PageController@home')->name('home');

// ----- Groups
Route::get("/group/main", "GroupController@groupMain")->name("group.main");
Route::match(['GET', 'POST'], "/join/{key?}", "GroupController@join")->name("group.join");
Route::post("/create", "GroupController@create")->name("group.create");