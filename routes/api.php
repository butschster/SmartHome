<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Bot\Controllers', 'prefix' => 'voice'], function() {
    Route::post('command', 'VoiceCommandController@handle')->name('voice.command.handle');
    Route::get('commands', 'VoiceCommandController@commands')->name('voice.commands');
});

Route::get('/weather/current', 'Weather\Controllers\WeatherController@show')->name('weather.current');


Route::get('/mqtt/logs', 'Mqtt\Controllers\LogsController@index')->name('mqtt.logs');

Route::group(['namespace' => 'Rooms\Controllers'], function() {
    /**
     * Room
     */
    Route::post('/room/{room}/property', 'RoomDevicePropertyController@store')->name('room.property.attach');
    Route::delete('/room/{room}/property', 'RoomDevicePropertyController@destroy')->name('room.property.attach');

    Route::get('/room/{room}/properties', 'RoomDevicePropertyController@properties')->name('room.properties');
    Route::get('/room/{room}', 'RoomController@show')->name('room.show');
    Route::post('/room/{room}', 'RoomController@update')->name('room.update');
    Route::get('/rooms', 'RoomController@index')->name('rooms');
    Route::post('/room', 'RoomController@store')->name('room.store');
    Route::delete('/room/{room}', 'RoomController@destroy')->name('room.destroy');

    Route::get('/device/property/{property}/rooms', 'RoomDevicePropertyController@rooms')->name('device.property.rooms');
});

Route::group(['namespace' => 'Devices\Controllers'], function() {
    /**
     * Device
     */
    Route::get('/device/properties', 'DevicePropertyController@all')->name('device.properties.all');
    Route::get('/device/property/{property}/logs', 'DevicePropertyLogsController@index')->name('device.property.logs');
    Route::get('/device/property/{property}', 'DevicePropertyController@show')->name('device.property.show');
    Route::get('/device/{device}/properties', 'DevicePropertyController@index')->name('device.properties');
    Route::get('/device/{device}/logs', 'DeviceController@logs')->name('device.logs');
    Route::get('/device/{device}', 'DeviceController@show')->name('device.show');
    Route::get('/devices', 'DeviceController@index')->name('devices');
    Route::post('/device/{device}', 'DeviceController@update')->name('device.update');
    Route::delete('/device/{device}', 'DeviceController@destroy')->name('device.destroy');

    /**
     * DeviceProperty
     */
    Route::post('/device/property/{property}', 'DevicePropertyController@update')->name('device.property.update');
    Route::post('/device/handle/{property}/{command}', 'DevicePropertyCommandController@invoke')->name('command.invoke');
});


Route::get('settings', ['uses' => 'Settings\Controllers\SettingsController@show']);
