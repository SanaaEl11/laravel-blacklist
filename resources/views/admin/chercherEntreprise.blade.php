@extends('layouts.app')

@section('title', 'Chercher Entreprise')

@section('content')
<div class="container-fluid px-4">
    <div class="page-content page-container" id="page-content">
        <div class="container-fluid px-4 my-3">
            @section('breadcrumb')
            <ol class="breadcrumb mb-4 text-light p-3 rounded shadow-sm" >
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark">Chercher Entreprise</li>
            </ol>
            @endsection

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-semibold">Recherche d'Entreprises</h5>
                </div>
                <div class="card-body">
                    <!-- Formulaire de recherche -->
                    <form action="{{ route('admin.entreprises.search') }}" method="GET">
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="search" 
                                           value="{{ $searchTerm }}" 
                                           class="form-control form-control-lg border-end-0" 
                                           placeholder="Rechercher par nom, adresse ou secteur">
                                    <span class="input-group-text bg-white border-start-0">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="filter" class="form-select form-select-lg">
                                    <option value="username" {{ $filterType == 'username' ? 'selected' : '' }}>Nom Entreprise</option>
                                    <option value="address" {{ $filterType == 'address' ? 'selected' : '' }}>Adresse</option>
                                    <option value="secteur.nom" {{ $filterType == 'secteur.nom' ? 'selected' : '' }}>Secteur</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-warning btn-lg w-100">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Résultats de recherche -->
                    <div class="search-results mt-4">
                        @if($searchTerm)
                        <h5 class="mb-4 text-dark">Résultats pour "{{ $searchTerm }}" ({{ $entreprises->total() }})</h5>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3 px-4 text-uppercase small fw-semibold">ID</th>
                                        <th class="py-3 px-4 text-uppercase small fw-semibold">ICE</th>
                                        <th class="py-3 px-4 text-uppercase small fw-semibold">RC</th>
                                        <th class="py-3 px-4 text-uppercase small fw-semibold">Nom Entreprise</th>
                                        <th class="py-3 px-4 text-uppercase small fw-semibold">Adresse</th>
                                        <th class="py-3 px-4 text-uppercase small fw-semibold">Secteur</th>
                                        <th class="py-3 px-4 text-uppercase small fw-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($entreprises as $entreprise)
                                    <tr class="border-top">
                                        <td class="py-3 px-4">{{ $entreprise->id }}</td>
                                        <td class="py-3 px-4">{{ $entreprise->ice ?? '-' }}</td>
                                        <td class="py-3 px-4">{{ $entreprise->rc ?? '-' }}</td>
                                        <td class="py-3 px-4">{{ $entreprise->username ?? '-' }}</td>
                                        <td class="py-3 px-4">{{ $entreprise->address ?? '-' }}</td>
                                        <td class="py-3 px-4">
                                            <span class="badge bg-secondary">{{ $entreprise->secteur->nom ?? '-' }}</span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('admin.entreprises.show', $entreprise->id) }}" 
                                                class="btn btn-sm btn-info" title="Voir détails">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="border-top">
                                        <td colspan="7" class="text-center py-4">
                                            <i class="fas fa-database fa-2x text-muted mb-2"></i>
                                            <p class="text-muted">Aucune entreprise trouvée</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($entreprises->hasPages())
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <div class="text-muted small">
                                Affichage de {{ $entreprises->firstItem() }} à {{ $entreprises->lastItem() }} sur {{ $entreprises->total() }} entrées
                            </div>
                            <div class="d-flex">
                                {{ $entreprises->withQueryString()->links('pagination::bootstrap-4', [
                                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                                    'next_text' => '<i class="fas fa-chevron-right"></i>'
                                ]) }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Style général de la carte */
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        border: none;
    }
    
    /* En-tête de la carte */
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
    }
    
    .card-header h5 {
        margin: 0;
        font-weight: 600;
        color: #2c3e50;
    }
    
    /* Style de la table */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        margin-bottom: 0;
    }
    
    .table thead th {
        background-color: #f8f9fa;
        border: none;
        font-weight: 500;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem 1.5rem;
        vertical-align: middle;
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .table tbody td {
        border-top: 1px solid #eceff1;
        vertical-align: middle;
        padding: 1rem 1.5rem;
        color: #495057;
    }
    
    /* Style des badges */
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }
    
    .badge.bg-secondary {
        background-color: #6c757d !important;
    }
    
    /* Style des boutons */
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
    
    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
        color: white;
    }
    
    /* Style du formulaire */
    .form-control-lg {
        height: calc(2.5rem + 2px);
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        border-radius: 0.25rem;
    }
    
    .btn-lg {
        padding: 0.5rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.25rem;
    }
    
    .input-group-text {
        background-color: #fff;
        border-left: none;
    }
    
    /* Pagination */
    .page-link {
        color: #495057;
        border: 1px solid #dee2e6;
        padding: 0.5rem 0.75rem;
        margin: 0 0.15rem;
    }
    
    .page-item.active .page-link {
        background-color:rgb(249, 218, 45);
        border-color:rgb(249, 218, 45);
        color: white;
    }
    
    .page-item.disabled .page-link {
        color: #6c757d;
    }
    
    /* Message vide */
    .text-muted {
        color: #6c757d !important;
    }
    
    /* Style responsive */
    @media (max-width: 768px) {
        .table-responsive {
            border: none;
        }
        
        .table thead {
            display: none;
        }
        
        .table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        
        .table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-top: none;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #495057;
            margin-right: 1rem;
        }
        
        .btn-group {
            width: 100%;
            justify-content: flex-end;
        }
        
        .form-control-lg, .form-select-lg {
            font-size: 1rem;
        }
        
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
    }
</style>
@endsection