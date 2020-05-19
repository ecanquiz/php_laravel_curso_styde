<?php

Route::get('/', function (){
    return 'Home';
});

Route::get('/usuarios', 'UserController@index');

Route::get('/usuarios/{id}', 'UserController@show')
    ->where('id', '\d+');

Route::get('/usuarios/nuevo', 'UserController@create');

Route::get('/saludo/{name}/{mickname?}', 'WelcomeUserController');
