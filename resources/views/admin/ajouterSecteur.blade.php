@extends('layouts.app')

@section('title', 'Ajouter Secteur')

@section('content')
<div class="container-fluid px-4">
    <div class="page-content page-container" id="page-content">
        <div class="container-fluid px-4 my-3">
            @section('breadcrumb')
            <ol class="breadcrumb mb-2 text-light p-3 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active text-light-dark">Ajouter Secteur</li>
            </ol>
            @endsection

            <div class="card-body p-5">
                <!-- Formulaire de création de secteur -->
                <form method="POST" action="{{ route('admin.ajouterSecteur.store') }}" class="p-4 rounded shadow border border-light" style="background: transparent;">
                    @csrf
                    <h2 class="text-center text-light-dark fw-bold mb-4">Ajouter Secteur</h2>

                    <!-- Nom du secteur -->
                    <div class="mb-4">
                        <label for="nom" class="form-label text-light-dark fw-lighter">Nom du Secteur :</label>
                        <input type="text" class="form-control border-0 border-bottom shadow-none bg-transparent @error('nom') is-invalid @enderror" 
                                id="nom" name="nom" value="{{ old('nom') }}" required>
                        
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Messages d'erreur/succès -->
                    @if(session('error'))
                        <div class="alert alert-danger mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning fw-lighter shadow-lg px-5 py-2">Ajouter Secteur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    
    
    
    
    
    .btn-warning {
        background-color: #f1c40f;
        border-color: #f1c40f;
        transition: all 0.3s ease;
    }
    
    .btn-warning:hover {
        background-color: #f39c12;
        border-color: #f39c12;
        transform: translateY(-2px);
    }
    
    .border-light {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    .text-light-dark {
        color:rgb(160, 162, 163);
    }
</style>
@endsection