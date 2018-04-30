<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministracionController extends Controller
{
    public function index(){

        return view('apps.administracion.index');
    }
}
