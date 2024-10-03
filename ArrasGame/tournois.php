<?php
session_start();
include "connexion.php"; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est admin
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
        /* Personnalisation des couleurs et styles des tableaux */
        .table th, .table td {
            padding: 12px;
            text-align: center; /* Centre le texte dans les cellules */
        }

        .table thead {
            background-color: #36234b; /* Couleur de fond de l'en-tête */
            color: white; /* Couleur du texte de l'en-tête */
        }

        .table tbody tr:hover {
            background-color: #0b0828; /* Couleur de survol pour les lignes */
        }

        .btn-custom {
            background-color: #632477; /* Couleur personnalisée pour les boutons */
            border-color: #632477;
            color: white; /* Couleur du texte des boutons */
        }

        .btn-custom:hover {
            background-color: #36234b; /* Couleur au survol */
        }

        .table tbody tr td {
            color: #e0d0e0; /* Couleur de texte par défaut pour toutes les cellules */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Liste des Tournois</h1>

        <?php if ($isAdmin): ?>
            <a href="create_tournament.php" class="btn btn-success mb-3">Créer un Tournoi</a>
        <?php endif; ?>

        <!-- Table des tournois -->
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
                // Récupérer et afficher tous les tournois
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

        <!-- Table des utilisateurs inscrits -->
        <h2 class="mt-5">Utilisateurs Inscrits</h2>
        
        <?php if ($isAdmin): ?>
            <a href="create_inscription.php" class="btn btn-success mb-3">Créer une Inscription</a>
        <?php endif; ?>
        
        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nom d'Utilisateur</th>
                    <th>Nom du Tournoi</th>
                    <th>Date d'Inscription</th>
                    <?php if ($isAdmin): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                    <th>Désinscription</th> <!-- Nouvelle colonne pour le bouton de désinscription -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupérer et afficher les utilisateurs inscrits
                $sql = "SELECT u.username, t.nom AS tournoi_nom, i.date_inscription, i.id AS inscription_id, i.utilisateur_id
                        FROM Inscriptions i
                        JOIN Utilisateurs u ON i.utilisateur_id = u.id
                        JOIN Tournois t ON i.tournoi_id = t.id
                        ORDER BY t.nom"; // Trier par nom de tournoi
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
        
                    // Afficher le bouton de désinscription uniquement pour l'utilisateur connecté et uniquement pour son inscription
                    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['utilisateur_id']) {
                        echo "<td>
                            <a href='delete_inscrit.php?id=" . $row['inscription_id'] . "' class='btn btn-warning btn-sm btn-custom' onclick='return confirm(\"Êtes-vous sûr de vouloir vous désinscrire de ce tournoi ?\");'>Désinscription</a>
                        </td>";
                    } else {
                        echo "<td></td>"; // Cellule vide si l'utilisateur n'est pas le propriétaire de l'inscription
                    }
        
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>        
    </div>
</body>
</html>
