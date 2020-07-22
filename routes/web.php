<?php

Route::get('/', function (){
    return 'Home';
});

Route::get('/usuarios', 'UserController@index')
    ->name('users.index');

/*Route::get('/usuarios/{id}', 'UserController@show')
    ->where('id', '\d+')
    ->name('users.show');*/

Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '\d+')
    ->name('users.show');

Route::get('/usuarios/{user}/editar', 'UserController@edit')
    ->name('users.edit');

Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');

//Route::post('/usuarios/crear', 'UserController@store');
Route::post('/usuarios', 'UserController@store');

Route::get('/saludo/{name}/{mickname?}', 'WelcomeUserController');
