<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SecretariaController extends Controller
{
    public function index(){
        return Inertia::render('Secretaria');
    }
}
