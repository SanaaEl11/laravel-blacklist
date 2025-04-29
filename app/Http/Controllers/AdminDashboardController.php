<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {

          // Vérification de l'authentification et des droits
    if (!auth()->check()) {
        return redirect()->route('login');
    }
        // Récupération des statistiques
        $data = [];
        
        // 1. Évolution des inscriptions
        $data['inscriptions'] = DB::table('entreprises')
            ->select(DB::raw("DATE_FORMAT(date_creation, '%Y-%m') AS mois"), DB::raw('COUNT(*) AS total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
            
        // 2. Évolution des signalements
        $data['signalements'] = DB::table('publications')
            ->select(DB::raw("DATE_FORMAT(date_publication, '%Y-%m') AS mois"), DB::raw('COUNT(*) AS total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
            
        // 3. Top entreprises signalées
        $data['top_entreprises'] = DB::table('publications')
            ->select('nom_entreprise_fraud', DB::raw('COUNT(*) AS total'))
            ->groupBy('nom_entreprise_fraud')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->get();
            
        // 4. Répartition des statuts
        $data['statuts'] = DB::table('publications')
            ->select('status', DB::raw('COUNT(*) AS nombre'))
            ->groupBy('status')
            ->get();
            
        // Totaux
        $total_posts = DB::table('publications')->count();
        $accepted_posts = DB::table('publications')->where('status', 'validé')->count();
        $rejected_posts = DB::table('publications')->where('status', 'rejeté')->count();
        $total_products = DB::table('products')->count();
        
        // Blacklist
        $blacklist = DB::table('blacklists')->get();
        
        return view('admin.dashboard', compact( // Changez 'dashboard' en 'admin.dashboard'
            'data',
            'total_posts',
            'accepted_posts',
            'rejected_posts',
            'total_products',
            'blacklist'
        ));
    }
    public function indexCharts()
    {

          // Vérification de l'authentification et des droits
    if (!auth()->check()) {
        return redirect()->route('login');
    }
        // Récupération des statistiques
        $data = [];
        
        // 1. Évolution des inscriptions
        $data['inscriptions'] = DB::table('entreprises')
            ->select(DB::raw("DATE_FORMAT(date_creation, '%Y-%m') AS mois"), DB::raw('COUNT(*) AS total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
            
        // 2. Évolution des signalements
        $data['signalements'] = DB::table('publications')
            ->select(DB::raw("DATE_FORMAT(date_publication, '%Y-%m') AS mois"), DB::raw('COUNT(*) AS total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
            
        // 3. Top entreprises signalées
        $data['top_entreprises'] = DB::table('publications')
            ->select('nom_entreprise_fraud', DB::raw('COUNT(*) AS total'))
            ->groupBy('nom_entreprise_fraud')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->get();
            
        // 4. Répartition des statuts
        $data['statuts'] = DB::table('publications')
            ->select('status', DB::raw('COUNT(*) AS nombre'))
            ->groupBy('status')
            ->get();
            
        // Totaux
        $total_posts = DB::table('publications')->count();
        $accepted_posts = DB::table('publications')->where('status', 'validé')->count();
        $rejected_posts = DB::table('publications')->where('status', 'rejeté')->count();
        $total_products = DB::table('products')->count();
        
        // Blacklist
        $blacklist = DB::table('blacklists')->get();
        
        return view('admin.Charts', compact( // Changez 'dashboard' en 'admin.dashboard'
            'data',
            'total_posts',
            'accepted_posts',
            'rejected_posts',
            'total_products',
            'blacklist'
        ));
    }
}