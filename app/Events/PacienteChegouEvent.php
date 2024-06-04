<?php

namespace App\Events;

use App\Models\Agendamento;
use App\Models\Paciente;
use App\Models\Psicologo;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PacienteChegouEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $paciente;
    public $psicologo;

    public function __construct($paciente_id, $psicologo_id)
    {
        $this->paciente = $paciente_id;
        $this->psicologo = $psicologo_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('psicologo.' . $this->psicologo);
    }
}
