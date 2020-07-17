<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

/*
        if (request()->has('empty')) {
           $users = [];
        }else {
            $users = [ 'Joel', 'Ellie', 'Tess', 'Tommy', 'Byll' ];
        }
*/
//        $users = DB::table('users')->get();
        $users = User::all();
//        dd($users);

        $title = 'Listado de usuarios';

//        return view('users.index')
//            ->with('users', User::all())
//            ->with('title','Listado de usuarios');
//        return view('users.index')->with('users', $users);
        return view('users.index', compact('title','users'));

    }

/*
    public function show($id)
    {
//        $user = User::find($id);
//        if ( $user== null) {
//            return response()->view('errors.404', [], 404);
//        }

        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }
*/

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
//        $data = request()->only(['name', 'email', 'password']);
//        $data = request()->all();
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'El campo nombre es obligatorio',
        ]);


//        if (empty($data['name'])) {
//             return redirect('usuarios/nuevo')->withErrors([
//                 'name' => 'El campo nombre es obligatorio'
//             ]);
//        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        //return redirect()->route('users.index');
        return redirect('usuarios');
    }

}


