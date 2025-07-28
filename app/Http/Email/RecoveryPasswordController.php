<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RecoveryPasswordController extends Controller
{
    public function showRecoveryForm()
    {
        return view('email.recovery-password');
    }

    public function recoveryPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->sendPasswordResetNotification();
            return redirect()->route('login')->with('status', 'Email enviado com sucesso!');
        } else {
            return redirect()->route('login')->with('status', 'Usuário não encontrado!');
        }
    }
}
