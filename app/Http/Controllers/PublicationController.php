<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blacklist;
use App\Models\Observation;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{
    public function checkPosts()
    {
        $publications = Publication::all();
        return view('admin.verifierPub', compact('publications'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:validé,rejeté',
        ]);

        DB::beginTransaction();

        try {
            $publication = Publication::findOrFail($id);
            $publication->status = $request->status;
            $publication->save();

            if ($request->status === 'validé') {
                // Ajouter à la blacklist
                DB::table('blacklists')->insert([
                    'id_entreprise' => $publication->id_entreprise,
                    'nom_entreprise_post' => $publication->nom_entreprise_post,
                    'nom_entreprise_fraud' => $publication->nom_entreprise_fraud,
                    'raison' => $publication->raison,
                    'preuve_file' => $publication->preuve_file,
                    'post_date' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.publications.check')
                ->with('status_message', 'Publication mise à jour avec succès!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.publications.check')
                ->with('status_message', 'Erreur : ' . $e->getMessage());
        }
    }

    public function rejectForm($id)
    {
        $publication = Publication::findOrFail($id);
        return view('admin.addObs', compact('publication'));
    }
    
    public function rejectStore(Request $request, $id)
{
    $request->validate([
        'reclamation' => 'required|string|max:1000',
    ]);

    DB::beginTransaction();

    try {
        $publication = Publication::findOrFail($id);

        // 1. Créer l'observation
        Observation::create([
            'publication_id' => $publication->id,
            'reclamation' => $request->reclamation,
            'nom_entreprise_post' => $publication->nom_entreprise_post,
            'nom_entreprise_fraud' => $publication->nom_entreprise_fraud,
        ]);

        // 2. Mettre à jour le statut
        $publication->status = 'rejeté';
        $publication->save();

        // 3. Supprimer de la blacklist si existant
        Blacklist::where('id_entreprise', $publication->id_entreprise)->delete();

        DB::commit();

        // REDIRECTION CORRIGÉE ICI
        return redirect()->route('admin.publications.check')
                ->with('status_message', 'Publication rejetée avec observation ajoutée!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Erreur: '.$e->getMessage());
    }
}
}