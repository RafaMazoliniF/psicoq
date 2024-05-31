<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $fillable =[
        'paciente_id',
        //psicolgo_id
        'data',
        'hora'
    ];
}
