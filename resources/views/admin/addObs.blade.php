@extends('layouts.app')

@section('title', 'Ajouter Observation')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
<link href="{{ asset('cssglobal/css/styles.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    /* All your CSS styles from the original file */
    /* ... [keep all your existing styles] ... */
</style>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4 my-3">
        <ol class="breadcrumb mb-2 text-light p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item active text-light-dark">Ajouter Observation</li>
        </ol>

        <div class="card-body p-2">
        <form action="{{ route('admin.publications.reject.store', $publication->id) }}" method="POST">
    @csrf
                <h2 class="text-center text-light-dark fw-lighter mb-4">Ajouter Observation</h2>
                
                <div class="mb-4">
                    <label for="publication_id" class="form-label text-light-dark fw-lighter">ID de la publication :</label>
                    <input type="text" id="publication_id" name="publication_id" class="form-control border-0 border-bottom shadow-none bg-transparent" 
                            value="{{ $publication->id }}" readonly>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nom_entreprise_post" class="form-label text-light-dark fw-lighter">Nom de l'entreprise réclamée :</label>
                        <input type="text" id="nom_entreprise_post" name="nom_entreprise_post" class="form-control border-0 border-bottom shadow-none bg-transparent" 
                            value="{{ $publication->nom_entreprise_post }}" readonly>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nom_entreprise_fraud" class="form-label text-light-dark fw-lighter">Entreprise fraudeuse :</label>
                        <input type="text" id="nom_entreprise_fraud" name="nom_entreprise_fraud" class="form-control border-0 border-bottom shadow-none bg-transparent" 
                            value="{{ $publication->nom_entreprise_fraud }}" readonly>
                    </div>
                    
                    <div class="mb-4">
                        <label for="reclamation" class="form-label text-light-dark fw-lighter">Réclamation :</label>
                        <textarea id="reclamation" name="reclamation" class="form-control border-0 border-bottom shadow-none bg-transparent" 
                                placeholder="Écrivez votre réclamation ici..." required></textarea>
                    </div>
                    
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-warning">Envoyer</button>
                    <a href="{{ route('admin.publications.check') }}" class="btn btn-secondary mx-3 fw-lighter shadow-lg px-5 py-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('javascript/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('javascript/js/datatables-simple-demo.js') }}"></script>
@endsection