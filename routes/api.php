<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PacienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisteredUserController::class, 'store'])->middleware('guest');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::post('agendar', [PacienteController::class, 'agendar'])->name('agendar');
Route::post('cancelar', [PacienteController::class, 'cancelar'])->name('cancelar');
Route::get('agendamentos', [PacienteController::class, 'agendamentos'])->name('agendamentos');
Route::get('agendamentos-futuros', [PacienteController::class, 'agendamentosFuturos'])->name('agendamentos-futuros');
