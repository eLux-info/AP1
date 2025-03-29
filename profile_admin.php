<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "connexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Utilisateurs</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
    .table th, .table td {
        color: black !important;
    }

    .table a {
        color: black !important;
        text-decoration: none;
    }

    .table a:hover {
        color: #333 !important;
    }
</style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Gérer les Utilisateurs</h1>

        <div class="header-section">
            <a href="create_user_form.php" class="create-button">Créer</a>
        </div>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Utilisateurs";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>
                        <a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Modifier</a>
                        <a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\");'>Supprimer</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
