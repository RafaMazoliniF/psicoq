<?php

namespace App\Http\Controllers;

use App\Events\PacienteChegouEvent;
use App\Models\Agendamento;
use App\Models\Paciente;
use App\Models\Psicologo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SecretariaController extends Controller
{
    public function index(){
        return Inertia::render('Secretaria');
    }

    public function notifica($agendamento_id)
    {
        $agendamento = Agendamento::find($agendamento_id);

        event(new PacienteChegouEvent($agendamento->paciente_id, $agendamento->psicologo_id));
    }
}
