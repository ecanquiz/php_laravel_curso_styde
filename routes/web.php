<?php

Route::get('/', function (){
    return 'Home';
});

Route::get('/usuarios', 'UserController@index')
    ->name('users.index');

Route::get('/usuarios/{id}', 'UserController@show')
    ->where('id', '\d+')
    ->name('users.show');

Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');

Route::get('/saludo/{name}/{mickname?}', 'WelcomeUserController');
