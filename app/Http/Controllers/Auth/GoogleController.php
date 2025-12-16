<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(Str::random(16)),
                    'role_id' => 2,
                    'email_verified_at' => now(),
                ]);
            }


            Auth::login($user);

            toast('Bem vindo(a) ' . $user->name, 'success', 'bottom-right');
            return redirect()->intended('/');
        } catch (Exception $e) {
            Log::error('Full error: ' . $e->getMessage());
            Alert::error('Erro', 'Erro de autenticação.');
            return redirect('/login');
        }
    }
}
