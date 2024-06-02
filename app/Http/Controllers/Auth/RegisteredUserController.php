<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Psicologo;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'permissao' => 'required|integer'
        ]);

        $user = User::create([
            'name' => $request->name,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permissao' => $request->permissao #define que é usuário <- FUNCIONOU PRA CARALHO
        ]);

        if($request->permissao == 0){
        Paciente::create([
            'user_id' => $user->id
        ]);
        }
        if($request->permissao == 1){
            Psicologo::create([
                'user_id' => $user->id
            ]);
        }
        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
