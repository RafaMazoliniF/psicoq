<?php

namespace App\Http\Controllers;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request){
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Dados recebidos da requisição
        $details = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ];

        // Envio do e-mail
        Mail::to('creeperandre12@gmail.com')->send(new Contact($details));

        return "E-mail enviado com sucesso!";
    }
}
