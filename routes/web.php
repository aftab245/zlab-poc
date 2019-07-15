<?php





Auth::routes();

Route::get('/', 'ClientController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('client','ClientController');