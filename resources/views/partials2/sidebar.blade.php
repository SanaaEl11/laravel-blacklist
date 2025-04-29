<nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{ route('enterprise.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="bi bi-person-exclamation fs-5"></i></div>
                Réclamation
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('enterprise.posts.create') }}">Ajouter Réclamation</a>
                    <a class="nav-link" href="{{ route('enterprise.posts.index') }}"> Réclamations </a>
                    <a class="nav-link" href="{{ route('enterprise.posts.rejected') }}">Réclamations refuser</a>
                </nav>
            </div>
            
            <!-- Gestion des produits -->
            <div class="sb-sidenav-menu-heading">Produit</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduits" aria-expanded="false" aria-controls="collapseProduits">
                <div class="sb-nav-link-icon"><i class="bi bi-box fs-6"></i></div>
                Gestion produits
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProduits" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('enterprise.products.create') }}">Ajouter Produit</a>
                    <a class="nav-link" href="{{ route('enterprise.products.index') }}"> Liste des Produits </a>
                </nav>
            </div>
            
            <!-- Gestion techniciens -->
            <div class="sb-sidenav-menu-heading">techniciens</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTechniciens" aria-expanded="false" aria-controls="collapseTechniciens">
                <div class="sb-nav-link-icon"><i class="bi bi-person-down fs-5"></i></div>
                Gestion techniciens
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseTechniciens" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('enterprise.technicians.create') }}">Ajouter Techniciens</a>
                    <a class="nav-link" href="{{ route('enterprise.technicians.index') }}">List des techniciens </a>
                </nav>
            </div>
            
            <!-- Gestion des entreprises -->
            <div class="sb-sidenav-menu-heading">Entreprise</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEntreprises" aria-expanded="false" aria-controls="collapseEntreprises">
                <div class="sb-nav-link-icon"><i class="bi bi-person-gear fs-5"></i></div>
                Gestion entreprises
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseEntreprises" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('enterprise.companies.search') }}">Chercher Entreprise</a>
                </nav>
            </div>
            
            <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="{{ route('enterprise.statistics') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Statistics & Insights
            </a>
            
            <div class="sb-sidenav-menu-heading ">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlacklist" aria-expanded="false" aria-controls="collapseBlacklist">
                <div class="sb-nav-link-icon"><i class="fas fa-ban"></i></div>
                Blacklist
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseBlacklist" aria-labelledby="headingBlacklist" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('enterprise.blacklist.my') }}">My Blacklist</a>
                    <a class="nav-link" href="{{ route('enterprise.blacklist.directory') }}">Blacklist Directory</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer " style="background:rgba(255, 255, 255, 0.2);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link">
                <i class="bi bi-box-arrow-right" style="font-size: 21px;color:white;"></i>
            </button>
        </form>
    </div>
</nav>