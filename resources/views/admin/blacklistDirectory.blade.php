@extends('layouts.app')

@section('title', 'Blacklist Directory')

@section('styles')
<style>
    /* Style général du tableau */
    #datatablesSimple {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* En-tête du tableau */
    #datatablesSimple thead th {
        background-color: rgb(238, 198, 67);
        color: white;
        font-weight: 600;
        padding: 15px 20px;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    /* Cellules du tableau */
    #datatablesSimple tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
        transition: all 0.2s ease;
    }

    /* Lignes alternées */
    #datatablesSimple tbody tr:nth-child(even) {
        background-color: #f9fafc;
    }

    /* Effet hover sur les lignes */
    #datatablesSimple tbody tr:hover {
        background-color: #f0f4ff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
    }

    /* Style des icônes dans le tableau */
    #datatablesSimple tbody td i {
        font-size: 1.5rem;
        transition: transform 0.2s ease;
    }

    #datatablesSimple tbody td a:hover i {
        transform: scale(1.1);
    }

    /* Style pour les cellules vides */
    #datatablesSimple tbody td:empty::before {
        content: "-";
        color: #adb5bd;
    }

    /* Style pour la pagination */
    .dataTables_paginate .paginate_button {
        padding: 8px 15px;
        margin: 0 3px;
        border-radius: 6px;
        border: 1px solid #dee2e6;
        color: rgb(238, 198, 67);
        transition: all 0.2s ease;
    }

    .dataTables_paginate .paginate_button:hover {
        background-color: rgb(238, 198, 67);
        color: white !important;
        border-color: rgb(238, 198, 67);
    }

    .dataTables_paginate .paginate_button.current {
        background-color: rgb(238, 198, 67)361ee;
        color: white !important;
        border-color: rgb(238, 198, 67);
    }

    /* Style pour les boutons d'export */
    .dt-buttons .btn {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #495057;
        margin-right: 10px;
        border-radius: 6px;
        padding: 8px 15px;
        transition: all 0.2s ease;
    }

    .dt-buttons .btn:hover {
        background-color: rgb(255, 214, 79);
        color: white;
        border-color: rgb(238, 198, 67);
    }

    /* Style pour la recherche */
    .dataTables_filter input {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 8px 15px;
        transition: all 0.2s ease;
    }

    .dataTables_filter input:focus {
        border-color:rgb(238, 198, 67);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    /* Style responsive */
    @media (max-width: 768px) {
        #datatablesSimple thead th,
        #datatablesSimple tbody td {
            padding: 10px 12px;
            font-size: 0.9rem;
        }
        
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            text-align: center;
            margin-bottom: 10px;
        }
    }
</style>
@endsection

@section('breadcrumb')
            <ol class="breadcrumb mb-2 text-light p-3 rounded shadow-sm mt-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active text-light-dark">Blacklist Directory</li>
            </ol>
            @endsection
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Blacklist Directory</h1>
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Signalé par</th>
                        <th>Nom de l'entreprise frauduleuse</th>
                        <th>Raison</th>
                        <th>Preuve</th>
                        <th>Date de publication</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blacklist as $entry)
                    <tr>
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->nom_entreprise_post }}</td>
                        <td>{{ $entry->nom_entreprise_fraud }}</td>
                        <td>{!! nl2br(e($entry->raison)) !!}</td>
                        <td>
                            @if($entry->preuve_file)
                                @php
                                    $file_extension = strtolower(pathinfo($entry->preuve_file, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ route('admin.view.image', ['file' => $entry->preuve_file]) }}" target="_blank">
                                        <i class="bi bi-images text-dark fs-3"></i>
                                    </a>
                                @elseif($file_extension === 'pdf')
                                    <a href="{{ route('admin.view.file', ['file' => $entry->preuve_file]) }}" target="_blank">
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
                    @empty
                    <tr>
                        <td colspan="6">Aucune entreprise blacklistée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('javascript/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('javascript/js/datatables-simple-demo.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation de DataTables
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
    });
</script>
@endsection