<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'motdepasse' => 'required|string'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->motdepasse // Laravel attend 'password' ici
        ];

       // Tentative de connexion admin
            if (Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->motdepasse // Laravel attend 'password' comme clé
            ])) {
                return redirect()->route('admin.dashboard');
            }

        // 🔹 Tentative de connexion en tant qu'ENTREPRISE
        if (Auth::guard('entreprise')->attempt($credentials)) {
            $entreprise = Auth::guard('entreprise')->user();

            switch ($entreprise->status) {
                case Entreprise::STATUS_ACCEPTED:
                    return redirect()->route('entreprise.dashboard');
                case Entreprise::STATUS_PENDING:
                    Auth::guard('entreprise')->logout();
                    return redirect()->route('status.page')->with('message', 'Votre compte est en attente de validation.');
                case Entreprise::STATUS_REJECTED:
                    Auth::guard('entreprise')->logout();
                    return redirect()->route('status.page')->with('error', 'Votre compte a été refusé.');
            }
        }

        // 🔹 Si aucune connexion ne fonctionne
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function logout(Request $request)
    {
        // Déconnexion pour Admin et Entreprise
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('entreprise')->check()) {
            Auth::guard('entreprise')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
