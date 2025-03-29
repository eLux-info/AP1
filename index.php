<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Métadonnées de base -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <!-- Métadonnées SEO -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Arras Game</title>

    <!-- Feuilles de style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>
    <div class="hero_area">
        <!-- En-tête -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container d-block">
                    <div class="main_nav_menu">
                        <div class="fk_width">
                            <!-- Menu mobile -->
                            <div class="custom_menu-btn">
                                <button onclick="openNav()">
                                    <span class="s-1"></span>
                                    <span class="s-2"></span>
                                    <span class="s-3"></span>
                                </button>
                            </div>
                            <!-- Overlay du menu -->
                            <div id="myNav" class="overlay">
                                <div class="overlay-content">
                                    <a href="index.php">Accueil</a>
                                    <?php if (isset($_SESSION['user_id'])) : ?>
                                        <a href="register_tournament.php">S'inscrire ici</a>
                                    <?php else : ?>
                                        <a href="login.html">S'inscrire ici</a>
                                    <?php endif; ?>
                                    <a href="tournois.php">Les Tournois</a>
                                </div>
                            </div>
                        </div>
                        <!-- Logo -->
                        <a class="navbar-brand" href="index.php">
                            <span>Arras Game</span>
                        </a>
                        <!-- Section utilisateur -->
                        <div class="user_option">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="<?= $_SESSION['role'] === 'admin' ? 'profile_admin.php' : 'index.php' ?>">
                                    <?= htmlspecialchars($_SESSION['username']) ?>
                                </a>
                                <a href="logout.php" class="btn btn-danger ml-2">Déconnexion</a>
                            <?php else : ?>
                                <a href="login.html">Connexion</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Section principale -->
        <section class="slider_section position-relative">
            <div class="container-fluid">
                <div class="row slider-row">
                    <!-- Carousel -->
                    <div class="col-lg-3 offset-lg-1">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Premier slide -->
                                <div class="carousel-item active">
                                    <div class="detail-box">
                                        <h1>S'inscrire à<br />un tournoi</h1>
                                        <p>Envie de participer à l'un de nos tournois ?</p>
                                        <div>
                                            <?php if (!isset($_SESSION['user_id'])) : ?>
                                                <a href="login.html" class="btn btn-warning">S'inscrire ici</a>
                                            <?php else : ?>
                                                <a href="register_tournament.php" class="btn btn-success">S'inscrire ici</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Deuxième slide -->
                                <div class="carousel-item">
                                    <div class="detail-box">
                                        <h1>Nos tournois<br />en cours</h1>
                                        <p>Découvrez les tournois en cours et les participants</p>
                                        <div>
                                            <a href="tournois.php" class="btn btn-primary">Les tournois</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Contrôles du carousel -->
                            <div class="carousel_control-box">
                                <div class="carousel_btn-container">
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="sr-only">Précédent</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="sr-only">Suivant</span>
                                    </a>
                                </div>
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active li_one">01</li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class="li_two">02</li>
                                    <li class="ol_design"></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- Image de la console -->
                    <div class="col-lg-8 px-0">
                        <div class="img-box">
                            <img src="images/console.png" alt="Console de jeu" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Pied de page -->
    <footer class="footer_section">
        <div class="container">
            <p>Phone : 03 59 80 45 80 | Mail : enzoluxinfo@gmail.com</p>
        </div>
    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>