<?php

Route::get('/task','apiController@index');
Route::post('/addtask','apiController@store');
Route::put('/updatetask/{edit_id}','apiController@update');
Route::delete('/delete-task/{delete_id}','apiController@delete');
