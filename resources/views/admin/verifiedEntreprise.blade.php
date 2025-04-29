@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    @section('breadcrumb')
        <ol class="breadcrumb mb-4 bg-transparent p-0">
            <li class="breadcrumb-item text-warning fw-bold">Dashboard</li>
            <li class="breadcrumb-item active text-dark">/ Vérifier Entreprises</li>
        </ol>
    @endsection

    @if(session('status'))
    <div class="alert alert-info alert-dismissible fade show m-4 position-fixed top-0 start-50 translate-middle-x" style="z-index: 9999; width: auto; min-width: 300px;">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <div class="d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0 fw-bold text-dark">
                    Liste des Entreprises
                </h5>
                <span class="badge bg-dark text-white rounded-pill px-3 py-2">
                    {{ $entreprises->count() }} enregistrements
                </span>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="datatablesSimple">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>ICE</th>
                            <th>RC</th>
                            <th>Nom d'utilisateur</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Secteur</th>
                            <th class="text-center">Statut</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entreprises as $entreprise)
                        <tr>
                            <td class="text-center">{{ $entreprise->id }}</td>
                            <td>{{ $entreprise->ice ?? '-' }}</td>
                            <td>{{ $entreprise->rc ?? '-' }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle me-2 text-secondary border border-secondary rounded-circle p-1"></i>
                                    {{ $entreprise->username ?? $entreprise->name ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <i class="fas fa-envelope me-2 text-primary border border-primary rounded p-1"></i>
                                {{ $entreprise->email ?? '-' }}
                            </td>
                            <td>{{ $entreprise->address ?? '-' }}</td>
                            <td>{{ $entreprise->secteur->nom ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill py-2 px-3 
                                    @if($entreprise->status == 'accepté') bg-success
                                    @elseif($entreprise->status == 'refusé') bg-danger
                                    @elseif($entreprise->status == 'excepto') bg-info
                                    @else bg-transparent border border-warning text-warning @endif">
                                    {{ ucfirst($entreprise->status ?? 'en attente') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <i class="far fa-calendar-alt me-1 text-muted"></i>
                                {{ $entreprise->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-sm me-2 
                                        @if(in_array($entreprise->status, ['accepté', 'refusé'])) 
                                            border border-secondary text-secondary
                                        @else
                                            bg-transparent border border-success text-success accept-btn
                                        @endif" 
                                        title="Accepter" 
                                        data-id="{{ $entreprise->id }}"
                                        @if(in_array($entreprise->status, ['accepté', 'refusé'])) disabled @endif>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm 
                                        @if(in_array($entreprise->status, ['accepté', 'refusé'])) 
                                            border border-secondary text-secondary
                                        @else
                                            bg-transparent border border-danger text-danger reject-btn
                                        @endif" 
                                        title="Refuser" 
                                        data-id="{{ $entreprise->id }}"
                                        @if(in_array($entreprise->status, ['accepté', 'refusé'])) disabled @endif>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="fas fa-database fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Aucune entreprise à afficher</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation de la DataTable
        const dataTable = new simpleDatatables.DataTable("#datatablesSimple", {
            perPage: 10,
            perPageSelect: [5, 10, 15, 20],
            labels: {
                placeholder: "Rechercher...",
                searchTitle: "Recherche dans le tableau",
                perPage: "{select} entrées par page",
                noRows: "Aucune entreprise trouvée",
                info: "Affichage de {start} à {end} sur {rows} entreprises",
                noResults: "Aucun résultat correspondant à la recherche"
            },
            columns: [
                { select: [0, 7, 8, 9], sortable: true }
            ]
        });

        // Gestion des clics sur les boutons
        document.addEventListener('click', function(e) {
            const acceptBtn = e.target.closest('.accept-btn');
            const rejectBtn = e.target.closest('.reject-btn');
            
            if (acceptBtn && !acceptBtn.disabled) {
                handleStatusUpdate(acceptBtn, 'accepté');
            } else if (rejectBtn && !rejectBtn.disabled) {
                handleStatusUpdate(rejectBtn, 'refusé');
            }
        });

        function handleStatusUpdate(button, status) {
            const entrepriseId = button.getAttribute('data-id');
            
            if (confirm(`Voulez-vous vraiment ${status} cette entreprise?`)) {
                updateStatus(entrepriseId, status, button);
            }
        }

        function updateStatus(entrepriseId, status, button) {
            const url = `/entreprises/${entrepriseId}/update-status`;
            const token = document.querySelector('meta[name="csrf-token"]').content;
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const row = button.closest('tr');
                    const badge = row.querySelector('.badge');
                    const acceptBtn = row.querySelector('.accept-btn');
                    const rejectBtn = row.querySelector('.reject-btn');
                    
                    // Mise à jour du badge
                    badge.className = 'badge rounded-pill py-2 px-3 ' + 
                        (data.status === 'accepté' ? 'bg-success' : 
                         data.status === 'refusé' ? 'bg-danger' :
                         'bg-transparent border border-warning text-warning');
                    
                    badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                    
                    // Désactiver les boutons
                    if (data.status === 'accepté' || data.status === 'refusé') {
                        acceptBtn.classList.remove('border-success', 'text-success');
                        acceptBtn.classList.add('border-secondary', 'text-secondary');
                        acceptBtn.disabled = true;
                        
                        rejectBtn.classList.remove('border-danger', 'text-danger');
                        rejectBtn.classList.add('border-secondary', 'text-secondary');
                        rejectBtn.disabled = true;
                    }
                    
                    showAlert('Statut mis à jour avec succès', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Échec de la mise à jour du statut', 'danger');
            });
        }

        function showAlert(message, type) {
            // Supprimer les alertes existantes
            document.querySelectorAll('.custom-alert').forEach(el => el.remove());
            
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show custom-alert position-fixed top-0 start-50 translate-middle-x m-4`;
            alert.style.cssText = `
                z-index: 9999;
                min-width: 300px;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            `;
            
            alert.innerHTML = `
                <div class="d-flex align-items-center">
                    <strong>${message}</strong>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            document.body.appendChild(alert);
            
            // Fermeture automatique après 5 secondes
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }
    });
</script>
@endsection