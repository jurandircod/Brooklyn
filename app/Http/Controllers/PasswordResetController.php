<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordResetController extends Controller
{
    // Mostrar formulário de redefinição
    public function showResetForm(Request $request, $token = null)
    {
        return view('site.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Processar a redefinição
    public function reset(Request $request)
    {
        // Validação personalizada para Laravel 7
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8', // Regra básica
            // Adicione outras regras conforme necessário
        ], [
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
            'password.confirmed' => 'As senhas não coincidem'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        Alert::success('Senha redefinida com sucesso!', 'Senha redefinida com sucesso!');
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', 'Senha redefinida com sucesso!')
                    : back()->withErrors(['email' => 'Link de redefinição inválido ou expirado']);
    }
}