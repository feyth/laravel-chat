<?php


Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', 'HomeController@index');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');


Route::group(['prefix' => 'chat', 'namespace' => 'Chat'], function()
{
    Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');
    Route::post('/send', 'MessagesController@postSendMessage');
    Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');
});



