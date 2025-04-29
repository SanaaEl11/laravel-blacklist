<nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #343a40;">
    <!-- Brand Logo -->
    <a class="navbar-brand ps-3 fw-bold" href="{{ route('admin.dashboard') }}">
        Blacklist.en
    </a>

    <!-- Sidebar Toggle Button -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Search Form -->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group" style="width: 250px;">
            <input class="form-control border-end-0 py-2" 
                    type="text" 
                    placeholder="Search for..." 
                    aria-label="Search"
                    style="border-radius: 20px 0 0 20px;">
            <button class="btn btn-warning border-start-0 py-2" 
                    type="submit"
                    style="border-radius: 0 20px 20px 0;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <!-- User Dropdown -->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle fa-fw me-1"></i>
                    <span class="d-none d-lg-inline">{{ Auth::user()->username }}</span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>