<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Psicologo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PsicologoController extends Controller
{
    public function index(){
        return Inertia::render('Psicologo');
    }

    public function anotacao($id){
        $agendamento = Agendamento::find($id);
        $paciente_id = Paciente::where('id',$agendamento->paciente_id)->first();
        $psicologo_id = Psicologo::where('id',$agendamento->psicologo_id)->first();
        $user_paciente = User::where('id',$paciente_id->user_id)->first();
        $user_psicologo = User::where('id',$psicologo_id->user_id)->first();
        


        return Inertia::render('Anotacao', ['agendamento' => $agendamento, 'user_paciente'=>$user_paciente, 'user_psicologo' => $user_psicologo]);
    }

    public function novaAnotacao($id) {
        $agendamento = Agendamento::find($id);
       // $agendamento->anotacao = $text;
        $agendamento->save();

        dd($agendamento);

        return redirect()->route('agendamentos');
    }
}
