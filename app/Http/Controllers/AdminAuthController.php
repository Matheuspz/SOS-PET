<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login
     * TODO: Replace with actual authentication when backend is ready
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres',
        ]);

        // TODO: Replace with actual authentication logic
        // For now, we'll accept any credentials as a placeholder
        $email = $request->email;
        $password = $request->password;

        // Placeholder authentication - replace with database check
        if ($email && $password) {
            session(['admin_authenticated' => true, 'admin_email' => $email]);
            return redirect()->route('admin.dashboard')->with('success', 'Login realizado com sucesso!');
        }

        return back()->with('error', 'Credenciais inválidas');
    }

    /**
     * Handle admin logout
     */
    public function logout()
    {
        session()->forget(['admin_authenticated', 'admin_email']);
        return redirect()->route('admin.login')->with('success', 'Logout realizado com sucesso!');
    }
}
