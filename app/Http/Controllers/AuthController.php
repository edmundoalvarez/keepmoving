<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            return redirect()
                ->route('auth.login.form')
                ->with('status.message', 'Las credenciales ingresadas no coinciden con nuestros registros.')
                ->with('status.type', 'danger')

                ->withInput();
        }

        if(Auth::user()->rol == 1){
            return redirect()
                ->route('admin.dashboard')
                ->with('status.message', 'Bienvenido de vuelta <b>' . Auth::user()->email . '</b>');
        } else if (Auth::user()->rol == 2){
            return redirect()
                ->route('products.index')
                ->with('status.message', 'Bienvenido de vuelta <b>' . Auth::user()->email . '</b>');
        }    
    }

    public function processLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.login.form')
            ->with('status.message', 'Esperamos que vuelvas pronto!');
    }
}
