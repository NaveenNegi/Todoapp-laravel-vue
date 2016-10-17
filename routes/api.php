<?php

Route::get('/task','apiController@index');
Route::post('/addtask','apiController@store');

