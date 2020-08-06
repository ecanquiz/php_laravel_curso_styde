<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\User;

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

//        return redirect('usuarios/nuevo')->withInput();
//        return redirect('usuarios/nuevo');
          
//        $data = request()->only(['name', 'email', 'password']);
//        $data = request()->all();

//        Unlike request()->all(), request()->validate([]) returns only the fields that are in the validation array,
//        so they do not include any rules.
        $data = request()->validate([
            'name' => 'required',
            //'email' => 'required|email',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo correo eletrónico es obligatorio',
            'email.email' => 'El campo correo eletrónico debe ser válido',
            'email.unique' => 'Ya existe un usuario con ese email',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'La clave debe ser mínimo de 6 caracteres',
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
//        return redirect()->route('users.index');
        return redirect('usuarios');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
//        $user->update(request()->all());
//        $data = request()->all();
        $data = request()->validate([
            'name' => 'required',
//            'email' => ['required', 'email', 'unique:users,email'],
            'email' => 'required|email',
            'password' => ''
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
	} else {
	    unset($data['password']);
	}

	$user->update($data);
	
//	  return redirect("usuarios/{$user->id}");
//        return redirect()->router('users.show', ['user' => $user->id]);
        return redirect()->route('users.show', ['user' => $user]);
        
    }

}


