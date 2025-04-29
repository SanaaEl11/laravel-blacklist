@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <ol class="breadcrumb mb-2 text-light p-3 rounded shadow-sm">
        <li class="breadcrumb-item text-warning">Welcome</li>
        <li class="breadcrumb-item active text-dark">
            {{ auth()->user()->name ?? 'Administrateur' }}
        </li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">{{ $total_posts }}</div>
                    <div class="cardName">Total réclamations</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="document-text-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">{{ $accepted_posts }}</div>
                    <div class="cardName">Réclamations Validée</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="checkmark-circle-outline"></ion-icon>
                </div>
            </div>
            
            <div class="card">
                <div>
                    <div class="numbers">{{ $rejected_posts }}</div>
                    <div class="cardName">Réclamations rejetées</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">{{ $total_products }}</div>
                    <div class="cardName">Total Produits</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cube-outline"></ion-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-body"><canvas id="areaChart" width="100%" height="20"></canvas></div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body"><canvas id="barChart" width="100%" height="50"></canvas></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body"><canvas id="statusPieChart" width="100%" height="50"></canvas></div>
                </div>
            </div>
        </div>
    </div>

  
    <!-- Table Modernisée -->
    <div class="container-fluid px-4">
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-semibold">Entreprises Blacklistées</h5>
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
                                <th class="py-3 px-4 text-uppercase small fw-semibold">Signalé par</th>
                                <th class="py-3 px-4 text-uppercase small fw-semibold">Entreprise frauduleuse</th>
                                <th class="py-3 px-4 text-uppercase small fw-semibold">Raison</th>
                                <th class="py-3 px-4 text-uppercase small fw-semibold">Preuve</th>
                                <th class="py-3 px-4 text-uppercase small fw-semibold">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blacklist->take(4) as $entry)
                            <tr class="border-top">
                                <td class="py-3 px-4">{{ $entry->id }}</td>
                                <td class="py-3 px-4">{{ $entry->nom_entreprise_post }}</td>
                                <td class="py-3 px-4 fw-semibold">{{ $entry->nom_entreprise_fraud }}</td>
                                <td class="py-3 px-4 text-muted">{{ $entry->raison }}</td>
                                <td class="py-3 px-4">
                                    @if ($entry->preuve_file)
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-comment-alt me-1"></i> Message
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted border">Aucune preuve</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-muted">{{ date('d/m/Y H:i', strtotime($entry->post_date)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                    <div class="text-muted small">
                        Affichage de 1 à 4 sur 4 entrées
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-secondary disabled me-2">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-primary active me-2">1</button>
                        <button class="btn btn-sm btn-outline-secondary disabled">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --warning-color: #f8961e;
        --danger-color: #f94144;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }

    .cardBox {
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        grid-gap: 20px;
    }

    .card {
        position: relative;
        background: white;
        padding: 25px;
        border-radius: 16px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: none;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-color);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .card .numbers {
        font-weight: 700;
        font-size: 2.2rem;
        color: var(--dark-color);
        margin-bottom: 5px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card .cardName {
        color: #6c757d;
        font-size: 1rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .iconBx {
        font-size: 2.8rem;
        color: rgba(67, 97, 238, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(67, 97, 238, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover .iconBx {
        background: rgba(67, 97, 238, 0.2);
        color: var(--primary-color);
    }

    /* Styles spécifiques pour chaque carte */
    .card:nth-child(1)::before { background: var(--primary-color); }
    .card:nth-child(2)::before { background: var(--success-color); }
    .card:nth-child(3)::before { background: var(--danger-color); }
    .card:nth-child(4)::before { background: var(--warning-color); }

    /* Styles pour les graphiques */
    .chart-container {
        position: relative;
        margin: auto;
        height: 100%;
        width: 100%;
    }

    .card.chart-card {
        padding: 15px;
        border-radius: 12px;
    }

    .card.chart-card .card-body {
        padding: 0;
        height: 100%;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .cardBox { grid-gap: 15px; }
    }

    @media (max-width: 768px) {
        .card {
            padding: 20px;
        }
        
        .card .numbers {
            font-size: 1.8rem;
        }
        
        .iconBx {
            font-size: 2.2rem;
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 576px) {
        .cardBox {
            grid-template-columns: 1fr;
        }
        
        .card {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .iconBx {
            margin-top: 15px;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card {
        animation: fadeIn 0.6s ease-out forwards;
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
    
    /* Style pour la pagination */
    .btn-outline-primary.active {
        background-color:rgb(244, 214, 91);
        color: white;
        border: none;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .cardBox { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 900px) {
        .cardBox { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .cardBox { grid-template-columns: 1fr; }
        
        .card {
            padding: 20px;
        }
        
        .card .numbers {
            font-size: 1.8rem;
        }
        
        .iconBx {
            font-size: 2.5rem;
        }
    }.card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }
</style>
@endsection


@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation de DataTables avec boutons d'export
        $('#datatablesSimple').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            },
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            responsive: true
        });

        // Initialisation des graphiques
        const statusData = {
            labels: @json($data['statuts']->pluck('status')),
            datasets: [{
                data: @json($data['statuts']->pluck('nombre')),
                backgroundColor: ['#ffc107', '#dc3545', '#28a745']
            }]
        };

        const barData = {
            labels: @json($data['top_entreprises']->pluck('nom_entreprise_fraud')),
            datasets: [{
                label: 'Nombre de signalements',
                data: @json($data['top_entreprises']->pluck('total')),
                backgroundColor: '#007bff'
            }]
        };

        const areaData = {
            labels: @json($data['inscriptions']->pluck('mois')),
            datasets: [{
                label: 'Signalements mensuels',
                data: @json($data['signalements']->pluck('total')),
                borderColor: 'rgba(255, 193, 7, 1)',
                backgroundColor: 'rgba(255, 193, 7, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 2
            }]
        };

        new Chart(document.getElementById('statusPieChart'), {
            type: 'pie',
            data: statusData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: barData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById('areaChart'), {
            type: 'line',
            data: areaData,
            options: {
                responsive: true,
                scales: {
                    y: { 
                        beginAtZero: true 
                    },
                    x: { 
                        grid: { 
                            color: 'rgba(0, 0, 0, 0.1)' 
                        } 
                    }
                }
            }
        });
    });
</script>
@endsection