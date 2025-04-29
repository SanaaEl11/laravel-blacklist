<?php

namespace App\Http\Controllers;

use App\Models\Secteur;
use Illuminate\Http\Request;

class SecteurController extends Controller
{
    public function create()
    {
        return view('admin.ajouterSecteur');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:secteurs,nom|max:255'
        ]);

        Secteur::create([
            'nom' => $request->nom
        ]);

        return redirect()->route('admin.ajouterSecteur')
                        ->with('success', 'Secteur ajouté avec succès');
    }
}