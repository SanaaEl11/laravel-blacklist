@extends('layouts.app')

@section('title', 'Liste des Produits')

@section('content')
<div class="container-fluid px-4">
    <div class="page-content page-container" id="page-content">
        <div class="container-fluid px-4 my-3">
            @section('breadcrumb')
            <ol class="breadcrumb mb-4 text-light p-3 rounded shadow-sm" >
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark">Liste des Produits</li>
            </ol>
            @endsection

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">Produits Enregistrés</h5>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <select class="form-select form-select-sm" id="entries-select">
                                <option value="10">10 entrées par page</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" class="form-control" placeholder="Rechercher...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4 text-uppercase small fw-semibold">ID</th>
                                    <th class="py-3 px-4 text-uppercase small fw-semibold">Nom</th>
                                    <th class="py-3 px-4 text-uppercase small fw-semibold">Description</th>
                                    <th class="py-3 px-4 text-uppercase small fw-semibold">Prix</th>
                                    <th class="py-3 px-4 text-uppercase small fw-semibold">Entreprise</th>
                                    <th class="py-3 px-4 text-uppercase small fw-semibold">Type</th>
                                    <th class="py-3 px-4 text-uppercase small fw-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr id="row-{{ $product->id }}" class="border-top">
                                    <td class="py-3 px-4">{{ $product->id }}</td>
                                    <td class="py-3 px-4">
                                        <span id="nom-{{ $product->id }}">{{ $product->nom }}</span>
                                        <input type="text" id="edit-nom-{{ $product->id }}" class="form-control form-control-sm edit-input" value="{{ $product->nom }}" style="display:none;">
                                    </td>
                                    <td class="py-3 px-4">
                                        <span id="description-{{ $product->id }}">{{ Str::limit($product->description, 50) }}</span>
                                        <textarea id="edit-description-{{ $product->id }}" class="form-control form-control-sm edit-input" style="display:none;">{{ $product->description }}</textarea>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span id="prix-{{ $product->id }}">{{ number_format($product->prix, 2) }} €</span>
                                        <input type="text" id="edit-prix-{{ $product->id }}" class="form-control form-control-sm edit-input" value="{{ $product->prix }}" style="display:none;">
                                    </td>
                                    <td class="py-3 px-4">{{ $product->entreprise->username ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-secondary">{{ $product->typeProduct->nom ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-primary edit-btn" data-id="{{ $product->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-success save-btn" data-id="{{ $product->id }}" style="display:none;">
                                                <i class="bi bi-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger delete-btn" data-id="{{ $product->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                    <div class="text-muted small">
                        Affichage de {{ $products->firstItem() }} à {{ $products->lastItem() }} sur {{ $products->total() }} entrées
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-warning me-2" {{ $products->onFirstPage() ? 'disabled' : '' }}>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <button class="btn btn-sm {{ $products->currentPage() == $i ? 'btn-warning' : 'btn-outline-warning' }} me-2">
                                {{ $i }}
                            </button>
                        @endfor
                        <button class="btn btn-sm btn-outline-warning" {{ $products->hasMorePages() ? '' : 'disabled' }}>
                            <i class="fas fa-chevron-right"></i>
                        </button>
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
        display: flex;
        justify-content: space-between;
        align-items: center;
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
    .btn-group .btn {
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        transition: all 0.2s ease;
    }
    
    .btn-outline-primary {
        color: #4e73df;
        border-color: #4e73df;
    }
    
    .btn-outline-primary:hover {
        background-color: #4e73df;
        color: white;
    }
    
    .btn-outline-success {
        color: #1cc88a;
        border-color: #1cc88a;
    }
    
    .btn-outline-success:hover {
        background-color: #1cc88a;
        color: white;
    }
    
    .btn-outline-danger {
        color: #e74a3b;
        border-color: #e74a3b;
    }
    
    .btn-outline-danger:hover {
        background-color: #e74a3b;
        color: white;
    }
    
    /* Style des champs d'édition */
    .edit-input {
        display: none;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    /* Pagination */
    .pagination {
        margin-bottom: 0;
    }
    
    .page-link {
        color: #495057;
        border: 1px solid #dee2e6;
        padding: 0.375rem 0.75rem;
    }
    
    .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
        color: white;
    }
    
    .page-item.disabled .page-link {
        color: #6c757d;
    }
    
    /* Style pour le select des entrées */
    #entries-select {
        width: 180px;
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 0.8rem;
    }
    
    /* Style pour la recherche */
    .input-group-sm input {
        border-radius: 20px 0 0 20px;
        padding-left: 15px;
    }
    
    .input-group-sm button {
        border-radius: 0 20px 20px 0;
        border-left: none;
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
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .card-header > div {
            width: 100%;
        }
        
        #entries-select {
            width: 100%;
        }
        
        .input-group {
            width: 100% !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Boutons d'édition/suppression
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            $('#nom-' + id).hide();
            $('#description-' + id).hide();
            $('#prix-' + id).hide();
            $('#edit-nom-' + id).show().focus();
            $('#edit-description-' + id).show();
            $('#edit-prix-' + id).show();
            $(this).hide();
            $('.save-btn[data-id="' + id + '"]').show();
        });

        // Sauvegarde des modifications
        $('.save-btn').click(function() {
            var id = $(this).data('id');
            var nom = $('#edit-nom-' + id).val();
            var description = $('#edit-description-' + id).val();
            var prix = $('#edit-prix-' + id).val();
            
            $.ajax({
                url: '/products/' + id,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    nom: nom,
                    description: description,
                    prix: prix
                },
                success: function(response) {
                    $('#nom-' + id).text(nom).show();
                    $('#description-' + id).text(description.length > 50 ? description.substring(0, 50) + '...' : description).show();
                    $('#prix-' + id).text(parseFloat(prix).toFixed(2) + ' €').show();
                    
                    $('#edit-nom-' + id).hide();
                    $('#edit-description-' + id).hide();
                    $('#edit-prix-' + id).hide();
                    
                    $('.save-btn[data-id="' + id + '"]').hide();
                    $('.edit-btn[data-id="' + id + '"]').show();
                    
                    toastr.success('Produit mis à jour avec succès');
                },
                error: function(xhr) {
                    toastr.error('Erreur lors de la mise à jour du produit');
                }
            });
        });

        // Suppression d'un produit
        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            
            if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
                $.ajax({
                    url: '/products/' + id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#row-' + id).fadeOut(300, function() {
                            $(this).remove();
                            toastr.success('Produit supprimé avec succès');
                        });
                    },
                    error: function(xhr) {
                        toastr.error('Erreur lors de la suppression du produit');
                    }
                });
            }
        });

      
    });
</script>
@endsection