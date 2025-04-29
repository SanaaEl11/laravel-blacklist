<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <!-- Core Section -->
            <div class="sb-sidenav-menu-heading">CORE</div>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <!-- Entreprise Section -->
            <div class="sb-sidenav-menu-heading">ENTREPRISE</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEntreprises" 
               aria-expanded="false" aria-controls="collapseEntreprises">
                <div class="sb-nav-link-icon"><i class="bi bi-person-gear"></i></div>
                Gestion des entreprises
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseEntreprises" aria-labelledby="headingTwo" 
                 data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a href="{{ route('admin.verifiedEntreprise') }}" class="nav-link">Vérifier Entreprise</a>
                    <a href="{{ route('admin.entreprises.search') }}" class="nav-link">Chercher Entreprise</a>
                    <a href="{{ route('admin.ajouterSecteur') }}" class="nav-link">Ajouter Secteur</a>
                </nav>
            </div>

            <!-- Produit Section -->
            <div class="sb-sidenav-menu-heading">PRODUIT</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduits" 
               aria-expanded="false" aria-controls="collapseProduits">
                <div class="sb-nav-link-icon"><i class="bi bi-box"></i></div>
                Gestion des produits
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProduits" aria-labelledby="headingOne" 
                 data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a href="{{ route('admin.listProducts') }}" class="nav-link">Liste des Produits</a>
                    <a href="{{ route('admin.ajouterType') }}" class="nav-link">Ajouter Type</a>
                </nav>
            </div>

            <!-- Réclamations Section -->
            <div class="sb-sidenav-menu-heading">RÉCLAMATIONS</div>
            <a class="nav-link" href="{{ route('admin.publications.check') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-person-exclamation"></i></div>
                Vérifier réclamations
            </a>

            <!-- Statistiques Section -->
            <div class="sb-sidenav-menu-heading">STATISTIQUES</div>
            <a class="nav-link" href="{{ route('admin.Charts') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Statistiques
            </a>

            <!-- Blacklist Section -->
            <div class="sb-sidenav-menu-heading">BLACKLIST</div>
            <a class="nav-link" href="{{ route('admin.blacklist.directory') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-ban"></i></div>
                Blacklist Directory
            </a>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="sb-sidenav-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0" title="Déconnexion">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</nav>

<style>
    /* Variables de couleur */
    :root {
        --sidebar-bg: #343a40;
        --sidebar-heading-color: #adb5bd;
        --sidebar-link-color: #dee2e6;
        --sidebar-link-hover-bg: rgba(255, 255, 255, 0.05);
        --sidebar-link-active-bg: rgba(255, 255, 255, 0.1);
        --sidebar-border-color: rgba(255, 255, 255, 0.1);
        --sidebar-icon-color: #f8f9fa;
        --sidebar-footer-bg: rgba(0, 0, 0, 0.2);
    }

    /* Style général de la sidebar */
    .sb-sidenav {
        background-color: var(--sidebar-bg);
        width: 250px;
        height: 100vh;
        overflow-y: auto;
        position: fixed;
    }

    /* Empêcher le double scroll */
    .sb-sidenav-menu {
        height: calc(100vh - 60px);
        overflow-y: hidden;
        overflow-x: hidden;
    }

    /* En-têtes des sections */
    .sb-sidenav-menu-heading {
        color: var(--sidebar-heading-color);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1rem 1.5rem 0.5rem;
        margin-top: 1rem;
    }

    /* Liens */
    .nav-link {
        color: var(--sidebar-link-color);
        padding: 0.75rem 1.5rem;
        margin: 0.1rem 0;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        border-left: 3px solid transparent;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .nav-link:hover {
        color: white;
        background-color: var(--sidebar-link-hover-bg);
        border-left-color: var(--sidebar-icon-color);
    }

    .nav-link.active {
        color: white;
        background-color: var(--sidebar-link-active-bg);
        border-left-color: var(--sidebar-icon-color);
    }

    /* Icônes */
    .sb-nav-link-icon {
        color: var(--sidebar-icon-color);
        margin-right: 0.75rem;
        font-size: 1rem;
        width: 1.25em;
        text-align: center;
    }

    /* Sous-menu */
    .sb-sidenav-menu-nested {
        padding-left: 0.5rem;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .show > .sb-sidenav-menu-nested {
        max-height: 500px; /* Valeur suffisamment grande */
    }

    .sb-sidenav-menu-nested .nav-link {
        padding-left: 2.5rem;
        font-size: 0.85rem;
    }

    /* Flèche des menus dépliants */
    .sb-sidenav-collapse-arrow {
        margin-left: auto;
        color: var(--sidebar-link-color);
        transition: transform 0.2s ease;
    }

    .collapsed .sb-sidenav-collapse-arrow {
        transform: rotate(-90deg);
    }

    /* Pied de page */
    .sb-sidenav-footer {
        background-color: var(--sidebar-footer-bg);
        padding: 0.75rem;
        border-top: 1px solid var(--sidebar-border-color);
        display: flex;
        justify-content: center;
        height: 60px;
    }

    /* Bouton de déconnexion */
    .sb-sidenav-footer .btn-link {
        color: white;
        transition: transform 0.2s ease;
    }

    .sb-sidenav-footer .btn-link:hover {
        transform: scale(1.1);
    }

    /* Scrollbar personnalisée */
    .sb-sidenav-menu::-webkit-scrollbar {
        width: 6px;
    }

    .sb-sidenav-menu::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .sb-sidenav-menu::-webkit-scrollbar-track {
        background-color: transparent;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fermer les autres sections quand une nouvelle s'ouvre
    const accordionButtons = document.querySelectorAll('[data-bs-toggle="collapse"]');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-bs-target');
            const targetCollapse = document.querySelector(targetId);
            
            // Si on clique sur une section fermée
            if (this.classList.contains('collapsed')) {
                // Fermer toutes les autres sections
                document.querySelectorAll('.collapse.show').forEach(openCollapse => {
                    if (openCollapse.id !== targetCollapse.id) {
                        const bsCollapse = new bootstrap.Collapse(openCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                        
                        // Mettre à jour l'état du bouton
                        const btn = document.querySelector(`[data-bs-target="#${openCollapse.id}"]`);
                        btn.classList.add('collapsed');
                    }
                });
            }
        });
    });
});
</script>