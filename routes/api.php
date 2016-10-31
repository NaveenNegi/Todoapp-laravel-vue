<?php

Route::get('/task','apiController@index');
Route::post('/addtask','apiController@store');
Route::put('/updatetask/{edit_id}','apiController@update');
Route::delete('/delete-task/{delete_id}','apiController@delete');
Route::get('complete-task/{complete_id}','apiController@complete');
Route::put('/uncomplete/{task_id}','apiController@unComplete');
Route::get('/clearcompleted','apiController@clearAll');