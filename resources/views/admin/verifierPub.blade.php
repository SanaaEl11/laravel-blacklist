@extends('layouts.app')

@section('title', 'Vérifier Réclamations')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="{{ asset('cssglobal/css/styles.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/cssglobal/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Tous vos styles CSS ici (identique à votre fichier actuel) */
        .cardBox {
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 10px;
            animation: fadeIn 1s ease-out;
        }
        /* ... (le reste de vos styles) ... */
    </style>
@endsection

@section('content')
<main>
    <div class="page-content page-container" id="page-content">
        <div class="container-fluid px-4 my-3">
            <ol class="breadcrumb mb-2 text-light p-3 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active text-light-dark">Verifier Réclamtions</li>
            </ol>

            <div class="col-lg-90 grid-margin stretch-card my-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Entreprise</th>
                                        <th>Entreprise Frauduleuse</th>
                                        <th>Raison</th>
                                        <th>Preuve</th>
                                        <th>Status</th>
                                        <th>Date de Publication</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($publications as $publication)
                                        <tr>
                                            <td>{{ $publication->id_entreprise }}</td>
                                            <td>{{ $publication->nom_entreprise_post }}</td>
                                            <td>{{ $publication->nom_entreprise_fraud }}</td>
                                            <td>{{ $publication->raison }}</td>
                                            <td>
                                                @if(!empty($publication->preuve_file))
                                                    @php
                                                        $file_extension = strtolower(pathinfo($publication->preuve_file, PATHINFO_EXTENSION));
                                                    @endphp

                                                    @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <a href="{{ route('admin.view.image', ['file' => $publication->preuve_file]) }}" target="_blank">
                                                            <i class="bi bi-images text-dark fs-3"></i>
                                                        </a>
                                                    @elseif($file_extension === 'pdf')
                                                        <a href="{{ route('admin.view.file', ['file' => $publication->preuve_file]) }}" target="_blank">
                                                            <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('uploads/' . $publication->preuve_file) }}" download>
                                                            <i class="bi bi-download text-dark fs-3"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    Aucune preuve
                                                @endif
                                            </td>

                                            <td>
                                                @php
                                                    $badgeClass = 'bg-secondary';
                                                    if ($publication->status == 'en attente') {
                                                        $badgeClass = 'bg-warning text-dark';
                                                    } elseif ($publication->status == 'rejected') {
                                                        $badgeClass = 'bg-danger';
                                                    } elseif ($publication->status == 'validé') {
                                                        $badgeClass = 'bg-success';
                                                    }
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">
                                                    {{ $publication->status }}
                                                </span>
                                            </td>
                                            <td>{{ $publication->date_publication }}</td>

                                            <td class="d-flex flex-column align-items-center">
                                            <!-- Accepter Form -->
                                                <!-- Accepter Form (should use update route, not reject) -->
                                                <form action="{{ route('admin.publications.update', $publication->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="validé">
                                                    <button type="submit" class="btn" title="Accepter">
                                                        <i class="bi bi-check2-circle fs-3"></i>
                                                    </button>
                                                </form>

                                                <!-- Bouton Rejeter -->
<form action="{{ route('admin.publications.reject.form', $publication->id) }}" method="GET">
    <button type="submit" class="btn" title="Rejeter">
        <i class="bi bi-x-circle fs-3"></i>
    </button>
</form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if(session('status_message'))
                                <div class="alert alert-info">{{ session('status_message') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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