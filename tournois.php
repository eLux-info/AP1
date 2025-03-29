<?php
session_start();
include "connexion.php";

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tournois</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .table th, .table td {
            padding: 12px;
            text-align: center;
            word-wrap: break-word;
        }

        .table thead {
            background-color: #36234b;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #0b0828;
        }

        .btn-custom {
            background-color: #632477;
            border-color: #632477;
            color: white;
        }

        .btn-custom:hover {
            background-color: #36234b;
        }

        .table tbody tr td {
            color: #e0d0e0;
        }

        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 14px;
            }
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
    <div class="container">
        <h1 class="mt-5">Liste des Tournois</h1>

        <?php if ($isAdmin): ?>
            <a href="create_tournament.php" class="btn btn-success mb-3">Créer un Tournoi</a>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <?php if ($isAdmin): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM Tournois";
                    $stmt = $pdo->query($sql);
                    while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date_tournoi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";

                        if ($isAdmin) {
                            echo "<td>
                                <a href='edit_tournament.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm btn-custom'>Modifier</a>
                                <a href='delete_tournament.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm btn-custom' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce tournoi ?\");'>Supprimer</a>
                            </td>";
                        }

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h2 class="mt-5">Utilisateurs Inscrits</h2>
        
        <?php if ($isAdmin): ?>
            <a href="create_inscription.php" class="btn btn-success mb-3">Créer une Inscription</a>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Nom d'Utilisateur</th>
                        <th>Nom du Tournoi</th>
                        <th>Date d'Inscription</th>
                        <?php if ($isAdmin): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                        <th>Désinscription</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT u.username, t.nom AS tournoi_nom, i.date_inscription, i.id AS inscription_id, i.utilisateur_id
                            FROM Inscriptions i
                            JOIN Utilisateurs u ON i.utilisateur_id = u.id
                            JOIN Tournois t ON i.tournoi_id = t.id
                            ORDER BY t.nom";
                    $stmt = $pdo->query($sql);
                    while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tournoi_nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date_inscription']) . "</td>";
            
                        if ($isAdmin) {
                            echo "<td>
                                <a href='edit_inscription.php?id=" . $row['inscription_id'] . "' class='btn btn-primary btn-sm btn-custom'>Modifier</a>
                                <a href='delete_inscription.php?id=" . $row['inscription_id'] . "' class='btn btn-danger btn-sm btn-custom' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette inscription ?\");'>Supprimer</a>
                            </td>";
                        }
            
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['utilisateur_id']) {
                            echo "<td>
                                <a href='delete_inscrit.php?id=" . $row['inscription_id'] . "' class='btn btn-warning btn-sm btn-custom' onclick='return confirm(\"Êtes-vous sûr de vouloir vous désinscrire de ce tournoi ?\");'>Désinscription</a>
                            </td>";
                        } else {
                            echo "<td></td>";
                        }
            
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>        
    </div>
</body>
</html>