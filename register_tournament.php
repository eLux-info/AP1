<?php
session_start();
include "connexion.php"; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si non connecté
    exit();
}

$message = ""; // Variable pour stocker le message

// Traitement de l'inscription au tournoi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tournoi_id = $_POST['tournoi_id'];
    $utilisateur_id = $_SESSION['user_id'];

    // Vérification si l'utilisateur est déjà inscrit au tournoi
    $check_sql = "SELECT * FROM Inscriptions WHERE utilisateur_id = :utilisateur_id AND tournoi_id = :tournoi_id";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->execute(['utilisateur_id' => $utilisateur_id, 'tournoi_id' => $tournoi_id]);
    $existing_registration = $check_stmt->fetch();

    if ($existing_registration) {
        $message = "<div class='alert alert-warning text-center'>Vous êtes déjà inscrit à ce tournoi.</div>";
    } else {
        // Inscription à un tournoi
        $sql = "INSERT INTO Inscriptions (utilisateur_id, tournoi_id) VALUES (:utilisateur_id, :tournoi_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['utilisateur_id' => $utilisateur_id, 'tournoi_id' => $tournoi_id]);
        
        $message = "<div class='alert alert-success text-center'>Inscription réussie au tournoi !</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à un Tournoi</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Centrer le contenu verticalement */
        .centered-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #190e37;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
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

    <div class="container centered-container">
        <div class="form-container">
            <h1 class="text-center" style="color: #c7c1d9;">S'inscrire à un Tournoi</h1>

            <!-- Affichage du message ici -->
            <?= $message ?>

            <form method="POST">
                <div class="form-group">
                    <label for="tournoi_id">Sélectionnez un Tournoi :</label>
                    <select name="tournoi_id" id="tournoi_id" class="form-control" required>
                        <?php
                        // Récupérer la liste des tournois
                        $sql = "SELECT * FROM Tournois WHERE status = 'ouvert'";
                        $stmt = $pdo->query($sql);
                        while ($row = $stmt->fetch()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nom'] . " - " . $row['date_tournoi'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-block mt-3" style="background-color: #632477; border-color: #632477; color: #fff;">S'inscrire</button>
            </form>
        </div>
    </div>

</body>
</html>
