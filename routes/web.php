<?php
 
 
Route::group(['middleware' => ['web']], function () { 
  Route::get('/', 'HomeController@index')->name('home');  
  Route::get('/tree', 'HomeController@list')->name('tree');
  Route::post('/store', 'AjaxController@store'); 
  Route::get('/list', 'AjaxController@list'); 
});
  