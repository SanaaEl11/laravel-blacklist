@extends('layouts2.app')

@section('content')
<div class="container-fluid px-4 mt-3">
    <ol class="breadcrumb mb-2 text-light p-3 rounded shadow-sm">
        <li class="breadcrumb-item text-warning">welcome</a></li>
        <li class="breadcrumb-item active text-dark">{{ auth()->user()->username }}
        (RC:{{ auth()->user()->rc ?? 'RC not available' }})</li>
    </ol>
</div>

<div class="row mx-3">
    <div class="cardBox ">
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

<!-- chart  -->
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

<!--table-->
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Signalé par</th>
                        <th>Entreprise fraud</th>
                        <th>Raison</th>
                        <th>Preuve</th>
                        <th>Date de publication</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blacklist as $entry)
                    <tr>
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->nom_entreprise_post }}</td>
                        <td>{{ $entry->nom_entreprise_fraud }}</td>
                        <td>{{ $entry->raison }}</td>
                        <td>
                            @if ($entry->preuve_file)
                                @php
                                    $file_extension = strtolower(pathinfo($entry->preuve_file, PATHINFO_EXTENSION));
                                @endphp
                                
                                @if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ route('enterprise.blacklist.view-image', ['file' => $entry->preuve_file]) }}" target="_blank">
                                        <i class="bi bi-images text-dark fs-3"></i>
                                    </a>
                                @elseif ($file_extension === 'pdf')
                                    <a href="{{ route('enterprise.blacklist.view-file', ['file' => $entry->preuve_file]) }}" target="_blank">
                                        <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>
                                    </a>
                                @else
                                    <a href="{{ asset('uploads/' . $entry->preuve_file) }}" download>
                                        <i class="bi bi-download text-dark fs-3"></i>
                                    </a>
                                @endif
                            @else
                                Aucune preuve
                            @endif
                        </td>
                        <td>{{ $entry->post_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .cardBox {
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 10px;
        animation: fadeIn 1s ease-out;
    }

    .card {
        position: relative;
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        cursor: pointer;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    }

    .card .numbers {
        font-weight: 500;
        font-size: 2.5rem;
        transition: color 0.3s ease;
    }

    .card .cardName {
        color: #212529;
        font-size: 1.1rem;
        margin-top: 5px;
        transition: color 0.3s ease;
    }

    .iconBx {
        font-size: 3.5rem;
        color: #212529;
        transition: color 0.3s ease;
    }

    .card:nth-child(1) .numbers {
        color: #f1c40f;
    }

    .card:nth-child(2) .numbers {
        color: #95a5a6;
    }

    .card:nth-child(3) .numbers {
        color: #e74c3c;
    }

    .card:nth-child(4) .numbers {
        color: #f39c12;
    }

    .card:nth-child(1) .iconBx {
        color: #f1c40f;
    }

    .card:nth-child(2) .iconBx {
        color: rgb(77, 119, 122);
    }

    .card:nth-child(3) .iconBx {
        color: #e74c3c;
    }

    .card:nth-child(4) .iconBx {
        color: #f39c12;
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    .card:hover .iconBx {
        color: #212529;
    }

    .card:hover .cardName {
        color: #212529;
    }

    @media (max-width: 1200px) {
        .cardBox {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .cardBox {
            grid-template-columns: repeat(2, 1fr);
        }
        .card {
            height: 200px;
        }
    }

    @media (max-width: 600px) {
        .cardBox {
            grid-template-columns: 1fr;
            padding: 10px;
        }
        .card {
            height: auto;
            padding: 20px;
        }
        .card .numbers {
            font-size: 2rem;
        }
        .card .cardName {
            font-size: 1rem;
        }
        .iconBx {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('javascript/js/datatables-simple-demo.js') }}"></script>
<script>
    // Inject PHP data into JavaScript
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
            borderColor: 'rgba(255, 225, 0, 1)',
            backgroundColor: 'rgba(255, 225, 0, 0.2)',
            fill: true,
            tension: 0.4,
            borderWidth: 2
        }]
    };

    new Chart(document.getElementById('statusPieChart'), {
        type: 'pie',
        data: statusData
    });

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: barData
    });

    new Chart(document.getElementById('areaChart'), {
        type: 'line',
        data: areaData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            }
        }
    });
</script>
@endpush