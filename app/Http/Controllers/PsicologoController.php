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

    public function store($id, Request $request)
    {
        $agendamento = Agendamento::find($id);
        if ($agendamento) {
            $agendamento->anotacao = $request->get('anotacao');
            $agendamento->save();

            return redirect()->route('agendamentos')->with('success', 'Anotação salva com sucesso!');
        }

        return redirect()->back()->withErrors(['msg' => 'Agendamento não encontrado']);
    }
}

