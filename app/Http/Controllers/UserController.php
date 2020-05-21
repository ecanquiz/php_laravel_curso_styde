<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        //request('data');

        if (request()->has('empty')) {
           $users = [];
        }else {
            $users = [ 'Joel', 'Ellie', 'Tess', 'Tommy', 'Byll', '<script>alert("Clicker")</script>' ];
        }

        $title = 'Listado de usuarios';

        return view('users', compact('title','users'));

    }

    public function show($id)
    {
        return "Mostrando detalles del usuario: {$id}";
    }

    public function create()
    {
        return "Creando nuevo usuario";
    }

}
