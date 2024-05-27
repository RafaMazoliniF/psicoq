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
        $paciente = auth()->user();
        
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
        ]);
    
        return response()->json(['success' => 'Agendamento criado com sucesso'], 201);
    }
    
}
