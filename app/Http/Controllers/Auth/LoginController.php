<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // Certifique-se de importar Hash
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;  // Certifique-se de importar o model User
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('site.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',

        ], [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email é inválido, por favor, informe um email válido',
            'email.max' => 'O email deve ter no máximo 255 caracteres',
            'password.required' => 'O senha é obrigatório',
            'password.min' => 'O senha deve ter pelo menos 6 caracteres',
            'password.max' => 'O senha deve ter no máximo 255 caracteres',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate(); // Mantém essa linha, é boa prática
            return redirect()->intended('/principal');
        } else {
            // Usuário ou senha incorretos
            Alert::error('Usuário ou senha incorretos');
            return redirect()->back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();  // Faz o logout do usuário autenticado
        return redirect('/login');  // Redireciona para a página de login
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
