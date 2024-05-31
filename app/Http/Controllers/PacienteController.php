<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PacienteController extends Controller
{
    public function index(){
        return Inertia::render('Paciente');
    }

    public function agendar(Request $request) {
        //$paciente = auth()->user();
        $paciente = Paciente::find(1);
        
        if (!$paciente) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }
    
        $request->validate([
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);
    
        Agendamento::create([
            'paciente_id' => $paciente->id,
            'data' => $request->data,
            'hora' => $request->hora,
            //input nome da psico => $request-:nome_psicologo->findbyid();
        ]);
    
        return response()->json(['success' => 'Agendamento criado com sucesso'], 201);
    }

    public function cancelar(Request $request) {
        //$paciente = auth()->user();
        $paciente = Paciente::find(1);
        
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
