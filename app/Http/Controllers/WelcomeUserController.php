<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function __invoke($name, $mickname = null) {
        $name = ucfirst($name);
        if ($mickname) {
            return "Bienvenido {$name}, tu apodo es {$mickname}";
        } else {
            return "Bienvenido {$name}";
        }
    }
}
