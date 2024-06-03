<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PsicologoController extends Controller
{
    public function index(){
        return Inertia::render('Psicologo');
    }

    public function anotacao($id){
        $agendamento = Agendamento::find($id);

        return Inertia::render('Anotacao', ['agendamento' => $agendamento]);
    }

    public function novaAnotacao($id) {
        $agendamento = Agendamento::find($id);
       // $agendamento->anotacao = $text;
        $agendamento->save();

        dd($agendamento);

        return redirect()->route('agendamentos');
    }
}
