<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::with('secteur')->get();
        // Your controller logic here
        return view('entreprise.dashboard'); // Make sure this view exists
    }
    // app/Http/Controllers/Admin/EntrepriseController.php
    public function verifiedEntreprise()
    {
        $entreprises = Entreprise::with('secteur')
            ->whereIn('status', ['en attente', 'pending', 'accepté', 'refusé'])
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('admin.verifiedEntreprise', compact('entreprises'));
    }
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'sometimes|string',
            'filter' => 'sometimes|in:username,address,secteur.nom'
        ]);
    
        $query = Entreprise::with('secteur');
    
        if ($request->filled('search') && $request->filled('filter')) {
            if ($request->filter === 'secteur.nom') {
                $query->whereHas('secteur', function($q) use ($request) {
                    $q->where('nom', 'like', '%'.$request->search.'%');
                });
            } else {
                $query->where($request->filter, 'like', '%'.$request->search.'%');
            }
        } else {
            // Si pas de recherche, retourne toutes les entreprises
            $query->where('id', '>', 0); // Condition toujours vraie
        }
    
        $entreprises = $query->paginate(10);
    
        return view('admin.chercherEntreprise', [
            'entreprises' => $entreprises,
            'searchTerm' => $request->search ?? '',
            'filterType' => $request->filter ?? 'username'
        ]);
    }
public function show(Entreprise $entreprise)
{
    return view('admin.chercherEntreprise', compact('entreprise'));
}
public function updateStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:accepté,refusé'
    ]);

    $entreprise = Entreprise::findOrFail($id);
    $entreprise->status = $validated['status'];
    $entreprise->save();

    return response()->json([
        'success' => true,
        'message' => 'Statut mis à jour avec succès',
        'status' => $entreprise->status
    ]);
}
   // Dans EntrepriseController.php
public function __construct()
{
    $this->middleware('auth:admin')->only(['verifiedEntreprise', 'updateStatus']);
    $this->middleware('entreprise')->only(['index']);
}
}
