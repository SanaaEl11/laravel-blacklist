<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Secteur;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $secteurs = Secteur::all();
        return view('register', compact('secteurs'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:entreprises',
            'motdepasse' => 'required|string|min:8',
            'rc' => 'required|string|unique:entreprises',
            'ice' => 'required|string',
            'id_secteur' => 'required|exists:secteurs,id',
            'address' => 'required|string',
            'iAgree' => 'required|accepted'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $entreprise = Entreprise::create([
            'username' => $request->username,
            'email' => $request->email,
            'motdepasse' => Hash::make($request->motdepasse),
            'rc' => $request->rc,
            'ice' => $request->ice,
            'id_secteur' => $request->id_secteur,
            'address' => $request->address,
            'status' => 'en attente',
            'date_creation' => now() // Ajout de la date de création
        ]);
    
        return redirect()->route('status.page')->with('success', 'Inscription réussie !');
    }
}