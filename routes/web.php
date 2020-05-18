<?php

Route::get('/', function (){
    return 'Home';
});


Route::get('/usuarios', function (){
    return 'Usuarios';
});

/*Route::get('/usuarios/{id}', function ($id){
    return "Mostrando detalles del usuario: {$id}";
})->where('id', '\d+');*/

Route::get('/usuarios/nuevo', function (){
    return "Creando nuevo usuario";
});

Route::get('/usuarios/{id}', function ($id){
    return "Mostrando detalles del usuario: {$id}";
});

Route::get('/saludo/{name}/{mickname?}', function ($name, $mickname = null){
    if ($mickname) {
        return "Bienvenido {$name}, tu apodo es {$mickname}";
    } else {
        return "Bienvenido {$name}, no tienes apodo";
    }
});
