<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blacklist Platform</title>
    <!-- Liens externes (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Liens locaux (utilisation de asset()) -->
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('cssglobal/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cssglobal/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cssglobal/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('cssglobal/css2/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cssglobal/css2/style.css') }}">

    <style>
        /* Styles généraux pour le corps de la page */
        body {
            background-color: #ffffff;
            /* Fond blanc */
            color: #000000;
            /* Texte noir */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Police de caractères */
        }

        /* Styles pour les sections avec un dégradé de gris à blanc */
        .blackpink {
            background: linear-gradient(45deg, grey, white);
            color: black;
        }

        /* Styles pour les boutons  */
        .btn-pink {
            background-color: grey;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        /* Effet de survol pour les boutons  */
        .btn-pink:hover {
            background-color: rgb(102, 96, 97);
            color: white;
        }

        /* Styles pour les icônes d'information de contact */
        .contact-info i {
            font-size: 1.5rem;
            color: black;
            margin-right: 10px;
        }

        /* Styles pour les champs de formulaire */
        .form-control {
            background-color: #222;
            color: black;
            border: 1px solid pink;
        }

        /* Styles pour le texte de placeholder dans les champs de formulaire */
        .form-control::placeholder {
            color: #bbb;
        }

        /* Styles pour les cartes de contact */
        .contact-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }

        /* Styles pour les icônes d'information de contact */
        .contact-info i {
            font-size: 1.5rem;
            color: black;
            margin-right: 10px;
        }

        /* Styles pour les cartes */
        .card {
            border: 1px solid rgb(245, 180, 0);
            /* Bordure dorée */
            transition: transform 0.3s, box-shadow 0.3s;
            /* Animation au survol */
        }

        /* Effet de survol pour les cartes */
        .card:hover {
            transform: translateY(-5px);
            /* Légère élévation au survol */
            box-shadow: 0 4px 8px rgba(143, 133, 135, 0.3);
            /* Ombre rose au survol */
            cursor: pointer;
            /* Curseur en pointeur */
        }

        /* Styles pour les titres de section */
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #000000;
            /* Texte noir */
        }

        /* Styles pour les champs de formulaire */
        .form-control {
            background-color: #ffffff;
            /* Fond blanc */
            color: #000000;
            /* Texte noir */
            border: 1px solid #cccccc;
            /* Bordure grise claire */
            padding: 10px;
        }

        /* Effet de survol pour les champs de formulaire */
        .form-control:hover {
            color: #000000;
            /* Texte noir */
            border-color: rgb(245, 180, 0);
            /* Bordure dorée au survol */
            box-shadow: 0 0 0 0.2rem rgb(245, 231, 194);
            /* Ombre dorée */
        }

        /* Styles pour les sections avec un dégradé de gris */
        .blackgrey {
            background: linear-gradient(45deg, #3a3a3a, #6e6e6e);
            color: white;
        }

        /* Styles pour les boutons gris */
        .btn-grey {
            background-color: #6e6e6e;
            color: white;
            border: none;
        }

        /* Effet de survol pour les boutons gris */
        .btn-grey:hover {
            background-color: #4f4f4f;
        }

        /* Styles pour la section des statistiques */
        .stats-section {
            padding: 50px 20px;
            text-align: center;
        }

        /* Styles pour chaque statistique */
        .stat {
            margin-bottom: 20px;
        }

        /* Styles pour les nombres dans les statistiques */
        .number {
            font-size: 60px;
            font-weight: bold;
            color: rgb(245, 180, 0);
            /* Couleur dorée */
        }

        /* Styles pour les labels dans les statistiques */
        .label {
            font-size: 22px;
            color: rgb(56, 53, 53);
            /* Couleur grise */
        }

        /* Style pour les cartes de témoignages */
        .testimonial-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            height: 350px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .testimonial-card:hover {
            box-shadow: 0 8px 16px rgba(255, 255, 255, 0.8);
            transform: scale(1.1);
            border: 2px solid #fff;
        }

        .testimonial-card img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .testimonial-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: black;
        }

        /* Carousel styling */
        #introCarousel,
        .carousel-inner,
        .carousel-item,
        .carousel-item.active {
            height: 100vh;
        }

        .carousel-item:nth-child(1) {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }

        .carousel-item:nth-child(2) {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }

        .carousel-item:nth-child(3) {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }

        /* Height for devices larger than 576px */
        @media (min-width: 992px) {
            #introCarousel {
                margin-top: -58.59px;
            }
        }

        .navbar .nav-link {
            color: #fff !important;
        }

        /*services */
        /* Styles personnalisés pour les cartes de services */
        .services-section {
            padding: 80px 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .services-title {
            font-weight: bold;
            color: #2c3e50;
            position: relative;
            display: inline-block;
            font-size: 28px;
        }

        .services-title::after {
            content: "";
            display: block;
            width: 60px;
            height: 4px;
            background-color: #f1c40f;
            /* Couleur d'accent */
            margin: 8px auto 0;
        }

        .services-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 1200px;
            /* Limite la largeur du conteneur */
            margin: 0 auto;
            /* Centre le conteneur */
        }

        .service-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(25% - 20px);
            /* 4 cartes par ligne avec un espace de 20px entre elles */
            max-width: calc(25% - 20px);
            /* Largeur maximale pour 4 cartes */
        }

        .service-card:hover {
            transform: translateY(-8px);
        }

        .service-icon {
            font-size: 48px;
            /* Taille des icônes */
            color: #f1c40f;
            /* Couleur des icônes */
            margin-bottom: 20px;
        }

        .service-title {
            font-weight: bold;
            color: #2c3e50;
            font-size: 20px;
        }

        /* Couleur d'accent pour les éléments interactifs */
        .service-card:hover .service-title {
            color: #f1c40f;
            /* Couleur d'accent au survol */
        }

        /* Hero section */
        .hero {
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        /* Navbar styles */
        .site-navbar-wrap {
            background-color: #343a40;
            color: white;
        }

        .site-navbar-top {
            padding: 10px 0;
            background-color: #212529;
        }

        .site-navbar-top a {
            color: white;
            text-decoration: none;
        }

        .site-navbar {
            padding: 15px 0;
        }

        .site-logo a {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .site-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .site-menu li {
            display: inline-block;
            margin-left: 20px;
        }

        .site-menu li a {
            color: white;
            text-decoration: none;
        }

        /* Footer styles */
        .footer-04 {
            background-color: #343a40;
            color: white;
            padding: 50px 0 0;
        }

        .footer-04 a {
            color: #adb5bd;
            text-decoration: none;
        }

        .footer-04 a:hover {
            color: white;
        }

        .subscribe-form .form-control {
            background-color: #495057;
            border-color: #495057;
            color: white;
        }

        .ftco-footer-social li {
            display: inline-block;
            margin-right: 10px;
        }

        .ftco-footer-social a {
            color: white;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="site-navbar-wrap">
        <div class="site-navbar-top">
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="d-flex mr-auto">
                            <a href="#" class="d-flex align-items-center mr-4">
                                <i class="fas fa-envelope mr-2"></i>
                                <span class="d-none d-md-inline-block">info@domain.com</span>
                            </a>
                            <a href="#" class="d-flex align-items-center mr-auto">
                                <i class="fas fa-phone mr-2"></i>
                                <span class="d-none d-md-inline-block">+1 234 4567 8910</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div class="mr-auto">
                            <a href="#" class="p-2 pl-0"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="p-2 pl-0"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="p-2 pl-0"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="p-2 pl-0"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-navbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-2">
                        <h1 class="my-0 site-logo"><a href="Home.php">Blacklist</a></h1>
                    </div>
                    <div class="col-10">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">
                                <ul class="site-menu main-menu">
                                    <li class="active"><a href="#home-section" class="nav-link">Accueil</a></li>
                                    <li class="has-children">
                                        <a href="#" class="nav-link">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="#" class="nav-link">Team</a></li>
                                            <li><a href="#" class="nav-link">Pricing</a></li>
                                            <li><a href="#" class="nav-link">FAQ</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#service" class="nav-link">Services</a></li>
                                    <li><a href="#contact" class="nav-link">Contact</a></li>
                                    <li><a href="{{ route('register') }}" class="nav-link">S'inscrire</a></li>
                                    <li><a href="{{ route('login') }}" class="nav-link">Se connecter</a></li>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero" style="background-image: url('images/2.jpg');">
        <div class="hero-content">
            <h1 class="display-5">Plateforme de Signalement des Entreprises Frauduleuses</h1>
            <p class="lead text-white">Signalez une entreprise frauduleuse et aidez à protéger les autres</p>
            <div class="text-white text-center">
                <a class="btn btn-outline-light btn-lg m-2" href="#service" role="button">Voir les détails</a>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section class="services-section" id="service">
        <div class="container">
            <h2 class="services-title">SERVICES</h2>
            <p>Des solutions intelligentes pour une détection et une analyse avancées.</p>

            <div class="services-container">
                <!-- Carte 1 -->
                <div class="service-card">
                    <i class="fas fa-shield-alt service-icon"></i>
                    <h5 class="service-title">Fraud Detection</h5>
                    <p class="card-text">Real-time analysis of suspicious behaviors and fraudulent transactions.</p>
                </div>

                <!-- Carte 2 -->
                <div class="service-card">
                    <i class="fas fa-chart-line service-icon"></i>
                    <h5 class="service-title">Advanced Analytics</h5>
                    <p class="card-text">Tracking and visualization of suspicious activities through interactive dashboards.</p>
                </div>

                <!-- Carte 3 -->
                <div class="service-card">
                    <i class="fas fa-code service-icon"></i>
                    <h5 class="service-title">Verification API</h5>
                    <p class="card-text">A flexible API to integrate our tools with your existing systems.</p>
                </div>

                <!-- Carte 4 -->
                <div class="service-card">
                    <i class="fas fa-user-shield service-icon"></i>
                    <h5 class="service-title">User Protection</h5>
                    <p class="card-text">Ensuring user safety with advanced security measures.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section des Statistiques -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 stat">
                    <div class="number">5000</div>
                    <div class="label">Avis Publiés</div>
                </div>
                <div class="col-md-4 stat">
                    <div class="number">200</div>
                    <div class="label">Entreprises sur Liste Noire</div>
                </div>
                <div class="col-md-4 stat">
                    <div class="number">10000</div>
                    <div class="label">Clients Satisfaits</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section de Contact -->
    <section class="py-5" id="contact">
        <div class="container">
            <h2 class="fw-bold text-center mb-4">Contactez-nous</h2>
            <p class="text-center">Nous sommes disponibles pour répondre à toutes vos questions.</p>
            <div class="row g-4">
                <!-- Informations de Contact -->
                <div class="col-md-6">
                    <div class="contact-card">
                        <h4 class="fw-bold">Nos Coordonnées</h4>
                        <div class="contact-info">
                            <p><i class="fas fa-map-marker-alt"></i> 123 Rue de la Sécurité, Paris, France</p>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:contact@blacklist.com" class="text-black">contact@blacklist.com</a></p>
                            <p class="text-black"><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                        </div>
                        <div class="mt-4">
                            <iframe width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=fr&amp;q=maroc,khemisset+(blacklist)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de Contact -->
                <div class="col-md-6">
                    <div class="contact-card">
                        <h4 class="fw-bold">Envoyez-nous un Message</h4>
                        <form action="contact.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label"><i class="fas fa-user"></i> Nom</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label"><i class="fas fa-comment"></i> Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning w-100 h-50"><i class="fas fa-paper-plane"></i> Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 col-xl-8 text-center">
                    <h3 class="mb-4">Des Avis</h3>
                    <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                        Découvrez ce que nos clients disent de notre plateforme. Leurs retours nous aident à nous améliorer continuellement.
                    </p>
                </div>
            </div>

            <div class="row text-center">
                <!-- Témoignage 1 -->
                <div class="col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="images/IMG1.jpg" class="rounded-circle shadow-1-strong" width="150" height="150" alt="Maria Smantha" />
                    </div>
                    <h5 class="mb-3">Maria Smantha</h5>
                    <h6 class="text-secondary mb-3">Développeuse Web</h6>
                    <p class="px-xl-3">
                        <i class="fas fa-quote-left pe-2"></i>
                        La plateforme Blacklist est un outil indispensable pour sécuriser nos transactions. Les analyses en temps réel sont très précises.
                    </p>
                    <ul class="list-unstyled d-flex justify-content-center mb-0">
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star-half-alt fa-sm text-warning"></i></li>
                    </ul>
                </div>

                <!-- Témoignage 2 -->
                <div class="col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="images/IMG3.jpg" class="rounded-circle shadow-1-strong" width="150" height="150" alt="Lisa Cudrow" />
                    </div>
                    <h5 class="mb-3">Lisa Cudrow</h5>
                    <h6 class="text-secondary mb-3">Designer Graphique</h6>
                    <p class="px-xl-3">
                        <i class="fas fa-quote-left pe-2"></i>
                        Grâce à Blacklist, nous avons pu identifier et bloquer plusieurs tentatives de fraude. L'interface est intuitive et facile à utiliser.
                    </p>
                    <ul class="list-unstyled d-flex justify-content-center mb-0">
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                    </ul>
                </div>

                <!-- Témoignage 3 -->
                <div class="col-md-4 mb-0">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="images/IMG4.jpg" class="rounded-circle shadow-1-strong" width="150" height="150" alt="John Smith" />
                    </div>
                    <h5 class="mb-3">John Smith</h5>
                    <h6 class="text-secondary mb-3">Spécialiste en Marketing</h6>
                    <p class="px-xl-3">
                        <i class="fas fa-quote-left pe-2"></i>
                        Une solution robuste et fiable pour protéger notre entreprise. Les rapports détaillés nous aident à prendre des décisions éclairées.
                    </p>
                    <ul class="list-unstyled d-flex justify-content-center mb-0">
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="fas fa-star fa-sm text-warning"></i></li>
                        <li><i class="far fa-star fa-sm text-warning"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer class="footer-04">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading"><a href="#" class="logo">Blacklist</a></h2>
                    <p>Une petite rivière nommée Duden traverse leur lieu et leur fournit le nécessaire en regelialia.</p>
                    <a href="#">Lire la suite</a>
                </div>
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading">Catégories</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-1 d-block">Achat &amp; Vente</a></li>
                        <li><a href="#" class="py-1 d-block">Commerçants</a></li>
                        <li><a href="#" class="py-1 d-block">Engagement social</a></li>
                        <li><a href="#" class="py-1 d-block">Aide &amp; Support</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading">Pages</h2>
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">Équipe</a>
                        <a href="#" class="tag-cloud-link">Tarification</a>
                        <a href="#" class="tag-cloud-link">FAQ</a>
                        <a href="#" class="tag-cloud-link">Contact</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading">S'abonner</h2>
                    <form action="#" class="subscribe-form">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control rounded-left" placeholder="Entrez votre adresse e-mail">
                            <button type="submit" class="form-control submit rounded-right"><span class="sr-only">Envoyer</span><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                    <h2 class="footer-heading mt-5">Suivez-nous</h2>
                    <ul class="ftco-footer-social p-0">
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-100 mt-5 border-top py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-8">
                        <p class="copyright">
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> Tous droits réservés | Ce modèle a été conçu avec <i class="fas fa-heart" aria-hidden="true"></i> par <a href="https://colorlib.com" target="_blank">Blacklist.com</a>
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-4 text-md-right">
                        <p class="mb-0 list-unstyled">
                            <a class="mr-md-3" href="#">Conditions</a>
                            <a class="mr-md-3" href="#">Confidentialité</a>
                            <a class="mr-md-3" href="#">Conformité</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Liens externes (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Liens locaux (utilisation de asset()) -->
<script src="{{ asset('javascript/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('javascript/js/popper.min.js') }}"></script>
<script src="{{ asset('javascript/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('javascript/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('javascript/js/main.js') }}"></script>

<!-- Liens locaux (utilisation de asset()) pour la deuxième série de scripts -->
<script src="{{ asset('javascript/js2/jquery.min.js') }}"></script>
<script src="{{ asset('javascript/js2/popper.js') }}"></script>
<script src="{{ asset('javascript/js2/bootstrap.min.js') }}"></script>
<script src="{{ asset('javascript/js2/main.js') }}"></script>


    <script>
        // Simple dropdown functionality
        $(document).ready(function() {
            $('.has-children').hover(function() {
                $(this).find('.dropdown').stop(true, true).slideDown(200);
            }, function() {
                $(this).find('.dropdown').stop(true, true).slideUp(200);
            });
        });
    </script>
</body>

</html>