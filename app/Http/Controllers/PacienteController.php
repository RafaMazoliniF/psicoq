<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Paciente;
use App\Models\Psicologo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PacienteController extends Controller
{
    public function index(){
        return Inertia::render('Paciente');
    }

    public function agendamentos_page(){
        return Inertia::render('Agendamentos');
    }
    public function agendar_page(){
        $psicologos = Psicologo::all();
        return Inertia::render('Agendar', ['psicologos' => $psicologos]);
    }

    public function agendar(Request $request) {
        //$paciente = auth()->user()->id; //pega o id do usuário logado
        $paciente = Paciente::where('user_id', 3)->first();  //pega o id do paciente logado
        $psicologo = Psicologo::where('user_id', 2)->first();
        
        if (!$paciente) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }
    
        $request->validate([
            #'data' => 'required|date',
            #'hora' => 'required|date_format:H:i',
            #'psicologo_id' => 'required|integer',
        ]);
    
        Agendamento::create([
            'paciente_id' => $paciente->id,
            'psicologo_id' => $psicologo->id,
            'data' => '2024-05-31',
            'hora' => '14:30',
        ]);
    
        return response()->json(['success' => 'Agendamento criado com sucesso'], 201);
    }

    public function teste(){
        //id_user = auth()->user()->id;  
        $psicologo = Psicologo::where('user_id', 2)->first();
        return $psicologo->id;
    }

    public function cancelar(Request $request) {
        //$paciente = auth()->user();
        $paciente = Paciente::find(3);
        
        if (!$paciente) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        $agendamento = Agendamento::where('paciente_id', $paciente->id)->where('id', $request->agendamento_id);

        if (!$agendamento) {
            return response()->json(['error' => 'Agendamento não encontrado'], 404);
        }

        $agendamento->delete();

        return response()->json(['success' => 'Agendamento cancelado com sucesso'], 200);
    }

    public function agendamentos() {
        //$paciente = auth()->user();
        $paciente = Paciente::find(1);
        
        if (!$paciente) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }
        $agendamentos = Agendamento::where('paciente_id', $paciente->id)->get();
        return response()->json($agendamentos);
    }
    
}
