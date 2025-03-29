<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Si l'utilisateur n'est pas un admin, rediriger vers la page de connexion
    header("Location: index.php");
    exit();
}

include "connexion.php"; // Inclure la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $date_tournoi = $_POST['date_tournoi'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO Tournois (nom, date_tournoi, description, status) VALUES (:nom, :date_tournoi, :description, :status)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        'nom' => $nom,
        'date_tournoi' => $date_tournoi,
        'description' => $description,
        'status' => $status,
    ]);

    // Rediriger vers la page des tournois après la création
    header("Location: tournois.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Tournoi</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Créer un Tournoi</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nom">Nom du Tournoi</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="date_tournoi">Date du Tournoi</label>
                <input type="date" class="form-control" id="date_tournoi" name="date_tournoi" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="ouvert">Ouvert</option>
                    <option value="fermé">Fermé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer le Tournoi</button>
            <a href="tournois.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
