<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolaController extends Controller
{
    public function index () {
        return view('hola');
    }

    public function conNombre($nombre, $edad) {
        return view("saludo", ["nombre" => $nombre, "edad"=>$edad]);
    }

}
