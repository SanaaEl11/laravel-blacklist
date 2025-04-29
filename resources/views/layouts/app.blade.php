<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blacklist.en')</title>
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="{{ asset('cssglobal/css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    
    <style>
        body.sb-nav-fixed {
            padding-top: 56px; /* Hauteur de la navbar */
        }
        
        #layoutSidenav {
            display: flex;
        }
        
        #layoutSidenav #layoutSidenav_nav {
            width: 225px;
            height: calc(100vh - 56px);
            position: fixed;
            top: 56px;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }
        
        #layoutSidenav #layoutSidenav_content {
            /* margin-left: 225px; */
            width: calc(100% - 225px);
            min-height: calc(100vh - 56px);
            overflow-y: auto;
            transition: margin 0.3s ease-in-out, width 0.3s ease-in-out;
        }
        
        /* Quand la sidebar est masquée */
        #layoutSidenav.sb-sidenav-toggled #layoutSidenav_nav {
            transform: translateX(-225px);
        }
        
        #layoutSidenav.sb-sidenav-toggled #layoutSidenav_content {
            margin-left: 0;
            width: 100%;
        }
        
        /* Pour les écrans plus petits */
        @media (max-width: 992px) {
            #layoutSidenav #layoutSidenav_nav {
                transform: translateX(-225px);
            }
            
            #layoutSidenav #layoutSidenav_content {
                margin-left: 0;
                width: 100%;
            }
            
            #layoutSidenav.sb-sidenav-toggled #layoutSidenav_nav {
                transform: translateX(0);
            }
            
            #layoutSidenav.sb-sidenav-toggled #layoutSidenav_content {
                margin-left: 225px;
                width: calc(100% - 225px);
            }
        }
    </style>
    
    @yield('styles')
</head>
<body class="sb-nav-fixed">
    <!-- Navbar fixe en haut -->
    @include('partials.navbar')
    
    <div id="layoutSidenav">
        <!-- Sidebar fixe à gauche -->
        <nav id="layoutSidenav_nav">
            @include('partials.sidebar')
        </nav>
        
        <!-- Contenu principal scrollable -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-3">
                    @yield('breadcrumb')
                </div>
                
                @yield('content')
            </main>
            
            @include('partials.footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    
    <script>
        // Script pour gérer le toggle de la sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.getElementById('layoutSidenav').classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.getElementById('layoutSidenav').classList.contains('sb-sidenav-toggled'));
                });
            }
            
            // Restaurer l'état du toggle au chargement
            if (localStorage.getItem('sb|sidebar-toggle') {
                if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                    document.getElementById('layoutSidenav').classList.add('sb-sidenav-toggled');
                } else {
                    document.getElementById('layoutSidenav').classList.remove('sb-sidenav-toggled');
                }
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>