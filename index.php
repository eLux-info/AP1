<?php
session_start(); // Démarrer la session
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Arras Game</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- Custom styles for this template -->
  <link href=" css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container d-block">
                <div class="main_nav_menu">
                    <div class="fk_width">
                        <div class="custom_menu-btn">
                            <button onclick="openNav()">
                                <span class="s-1"> </span>
                                <span class="s-2"> </span>
                                <span class="s-3"> </span>
                            </button>
                        </div>
                        <div id="myNav" class="overlay">
                            <div class="overlay-content">
                                <a class="" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <a class="" href="register_tournament.php">S'inscrire ici</a>
                                <?php else: ?>
                                    <a class="" href="login.html">S'inscrire ici</a>
                                <?php endif; ?>
                                <a class="" href="tournois.php">Les Tournois</a>
                            </div>
                        </div>
                    </div>
                    <a class="navbar-brand" href="index.php">
                        <span>
                            Arras Game
                        </span>
                    </a>
                    <div class="user_option">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?= $_SESSION['role'] === 'admin' ? 'profile_admin.php' : 'index.php' ?>">
                                <?= htmlspecialchars($_SESSION['username']) ?>
                            </a>
                            <a href="logout.php" class="btn btn-danger" style="margin-left: 10px;">Déconnexion</a>
                        <?php else: ?>
                            <a class="" href="login.html">
                                Connexion
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->
    </header>
    <!-- end header section -->

    <!-- slider section -->
    <section class="slider_section position-relative">
        <div class="container-fluid">
            <div class="row slider-row">
                <div class="col-lg-3 offset-lg-1">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="detail-box">
                                    <h1>
                                        S'inscrire à <br />
                                        un tournoi.
                                    </h1>
                                    <p>
                                        Envie de participer à l'un de nos tournois ? Inscrivez-vous ci-dessous.
                                    </p>
                                    <div>
                                        <?php
                                        // Vérifie si l'utilisateur est connecté
                                        if (!isset($_SESSION['user_id'])): ?>
                                            <a href="login.html" class="btn btn-warning">
                                                S'inscrire ici.
                                            </a>
                                        <?php else: ?>
                                            <a href="register_tournament.php" class="btn btn-success">
                                                S'inscrire ici.
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h1>
                    Nos tournois <br />
                    en cours.
                  </h1>
                  <p>
                   Vous voulez voir les tournois en cours et les participants ? C'est ici.
                  </p>
                  <div>
                    <a href="tournois.php">  <!-- Lien vers la page des tournois -->
                      Les tournois
                   </a>
                  </div>
               </div>
             </div>
            </div>
            <div class="carousel_control-box">
              <div class="carousel_btn-container">
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="sr-only">Next</span>
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
        <div class="col-lg-8 px-0">
          <div class="img-box">
            <img src="images/console.png" alt="" />
         </div>
       </div>
      </div>
    </div>
  </section>
  <!-- end slider section -->

  <!-- footer section -->
  <footer class="footer_section ">
    <div class="container">
      <p>
        Phone : 03 59 80 45 80 | Mail : enzoluxinfo@gmail.com
      </p>
    </div>
  </footer>
  <!-- footer section -->

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>