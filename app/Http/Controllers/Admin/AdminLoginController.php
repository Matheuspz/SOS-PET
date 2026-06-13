<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    //
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'/*'admin.dashboard'*/))->with('success', 'Você está logado');
        }

        return back()
            ->withErrors(['email' => 'As credenciais enviadas não estão em nosso banco de dados.'])
            ->onlyInput('email');
    }


}
