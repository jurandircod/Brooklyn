<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Model\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {

        return view('site.register');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6|same:password',
        ], [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email é inválido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
            'password_confirmation.required' => 'a confirmação da senha é obrigatória',
            'password_confirmation.min' => 'A senha deve ter no mínimo 6 caracteres',
            'password_confirmation.same' => 'As senhas são divergentes',
            'password.confirmed' => 'As senhas são divergentes',
            'email.unique' => 'O email já está cadastrado',

        ]);

        $nome = strtolower($request->name);

        // 2. primeira letra maiúscula
        $nome = ucwords($nome);

        // 3. permitir só nome e sobrenome
        $partes = explode(" ", $nome);

        // remove entradas vazias (múltiplos espaços)
        $partes = array_filter($partes);

        // pega só as duas primeiras
        $nomeFormatado = implode(" ", array_slice($partes, 0, 2));

        $user = User::create([
            'name' => $nomeFormatado,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            // Retorne uma resposta adequada para seu front-end
            Alert::success('Verifique seu email para ativar sua conta', 'Verifique seu email para ativar sua conta');
            return redirect()->route('login');
        }
        Alert::success('Usuário cadastrado com sucesso', 'Usuário cadastrado com sucesso');
        return redirect()->route('login');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
