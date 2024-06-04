<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Psicologo;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PacienteController extends Controller
{
    public function index(){
        return Inertia::render('Paciente');
    }

    public function agendamentos_page(){
        $id_user = auth()->user()->id;
        $agendamentos_futuros = [];
        $agendamentos_passados = [];
        
        $psicologos = Psicologo::all();
        $pacientes = Paciente::all();
        $users = User::all();

        if(auth()->user()->permissao == 0){
            $paciente = Paciente::where('user_id',$id_user)->first();
            $agendamentos_futuros = Agendamento::where('paciente_id',$paciente->id)
                                                ->where('data', '>=', Carbon::today())
                                                ->orderBy('data', 'asc')
                                                ->get();
            $agendamentos_passados = Agendamento::where('paciente_id',$paciente->id)
                                                 ->where('data', '<', Carbon::today())
                                                 ->orderBy('data', 'desc')
                                                 ->get();
        }
        
    
        if(auth()->user()->permissao == 1){
            $psicologo = Psicologo::where('user_id',$id_user)->first();
            $agendamentos_futuros = Agendamento::where('psicologo_id',$psicologo->id)
                                                ->where('data', '>=', Carbon::today())
                                                ->orderBy('data', 'asc')
                                                ->get();
            $agendamentos_passados = Agendamento::where('psicologo_id',$psicologo->id)
                                                 ->where('data', '<', Carbon::today())
                                                 ->orderBy('data', 'desc')
                                                 ->get();
        }
        
        return Inertia::render('Agendamentos', [
            'agendamentos_futuros' => $agendamentos_futuros,
            'agendamentos_passados' => $agendamentos_passados,
            'psicologos' => $psicologos,
            'pacientes' => $pacientes,
            'users' => $users,
        ]);
    }
 
    public function agendar_page(){ 
        $psicologos = Psicologo::all();
        $agendamentos = Agendamento::all();
        $users = User::all();
        return Inertia::render('Agendar', ['psicologos' => $psicologos, 'agendamentos' => $agendamentos, 'users' => $users]);
    }
    public function agendar(Request $request) {
        $paciente_user = auth()->user()->id; //pega o id do usuário logado
        $paciente = Paciente::where('user_id',$paciente_user)->first();
    
        $request->validate([
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'psicologo_id' => 'required|integer',
        ]);
    
        if (Carbon::today()->toDateString() <= $request->data && 
            Agendamento::where([
                'data' => $request->data,
                'hora' => $request->hora,
                'psicologo_id' => $request->psicologo_id,
                'paciente_id' => $request->paciente_id,
            ])->get()->count() == 0) 
        { 
            Agendamento::create([
                'paciente_id' => $paciente->id,
                'psicologo_id' => $request->psicologo_id,
                'data' => $request->data,
                'hora' => $request->hora,
            ]);
        }
    
        return redirect()->route('agendamentos');
    }
    
}
