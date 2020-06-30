<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

        /*if (request()->has('empty')) {
           $users = [];
        }else {
            $users = [ 'Joel', 'Ellie', 'Tess', 'Tommy', 'Byll' ];
        }*/
        //$users = DB::table('users')->get();
        $users = User::all();
        //dd($users);

        $title = 'Listado de usuarios';

        //return view('users.index')
        //    ->with('users', User::all())
        //    ->with('title','Listado de usuarios');
        //return view('users.index')->with('users', $users);
        return view('users.index', compact('title','users'));

    }

    public function show($id)
    {
        return view('users.show', compact('id'));
    }

    public function create()
    {
        return "Creando nuevo usuario";
    }

}


