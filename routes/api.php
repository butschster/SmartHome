<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/invoke/spech', 'SpechCommandController@invoke')->name('command.spech.invoke');

/**
 * Room
 */
Route::get('/rooms', 'RoomController@index')->name('rooms');
Route::get('/room/{room}', 'RoomController@show')->name('room.show');
Route::post('/room/{room}', 'RoomController@update')->name('room.update');
Route::post('/room', 'RoomController@store')->name('room.store');
Route::delete('/room/{room}', 'RoomController@destroy')->name('room.destroy');

/**
 * Device
 */
Route::get('/devices', 'DeviceController@index')->name('devices');
Route::get('/device/{device}', 'DeviceController@show')->name('device.show');
Route::post('/device/{device}', 'DeviceController@update')->name('device.update');
Route::delete('/device/{device}', 'DeviceController@destroy')->name('device.destroy');

/**
 * DeviceProperty
 */
Route::get('/device/{device}/properties', 'DevicePropertyController@index')->name('device.properties');
Route::get('/device/property/{property}', 'DevicePropertyController@show')->name('device.property.show');
Route::post('/invoke/{property}/{command}', 'DevicePropertyCommandController@invoke')->name('command.invoke');


Route::get('settings', ['uses' => 'AppController@settings']);
