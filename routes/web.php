<?php

Auth::routes();

Route::get('admin', 'AdminController@index')->name('admin');
Route::get('/', 'HomeController@index')->name('home');
