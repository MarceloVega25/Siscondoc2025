<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Usuario;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    protected function credentials(\Illuminate\Http\Request $request)
{
    return [
        'email' => $request->get('email'),
        'password' => $request->get('password'),
        'estado' => 'activo' // 👈 solo permite login si está activo
    ];
}

protected function sendFailedLoginResponse(Request $request)
{
    // Buscar el usuario por email
    $usuario = Usuario::where('email', $request->email)->first();

    // Si existe y está inactivo
    if ($usuario && $usuario->estado !== 'activo') {
        throw ValidationException::withMessages([
            'email' => ['Su cuenta está inactiva. Comuníquese con el administrador.'],
        ]);
    }

    // Si no pasa la validación normal
    throw ValidationException::withMessages([
        'email' => [trans('auth.failed')], // "Estas credenciales no coinciden..."
    ]);
}
}
