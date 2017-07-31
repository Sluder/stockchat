<?php

// ----- Pages
Route::get('/', 'PageController@home')->name('home');

// ----- Groups
Route::get("/group/view", "GroupController@groupView")->name("view.group");
Route::post("/join", "GroupController@join")->name("join.group");
Route::post("/create", "GroupController@create")->name("create.group");