<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include "connexion.php"; // Inclure la connexion à la base de données

// Vérifier si l'ID du tournoi est passé
if (!isset($_GET['id'])) {
    header("Location: tournois.php");
    exit();
}

// Récupérer le tournoi à modifier
$id = $_GET['id'];
$sql = "SELECT * FROM Tournois WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$tournament = $stmt->fetch();

if (!$tournament) {
    header("Location: tournois.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $date_tournoi = $_POST['date_tournoi'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Préparer et exécuter la requête de mise à jour
    $sql = "UPDATE Tournois SET nom = :nom, date_tournoi = :date_tournoi, description = :description, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        'nom' => $nom,
        'date_tournoi' => $date_tournoi,
        'description' => $description,
        'status' => $status,
        'id' => $id,
    ]);

    // Rediriger vers la page des tournois après la modification
    header("Location: tournois.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Tournoi</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Modifier un Tournoi</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nom">Nom du Tournoi</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($tournament['nom']); ?>" required>
            </div>
            <div class="form-group">
                <label for="date_tournoi">Date du Tournoi</label>
                <input type="date" class="form-control" id="date_tournoi" name="date_tournoi" value="<?php echo htmlspecialchars($tournament['date_tournoi']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($tournament['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="ouvert" <?php if ($tournament['status'] == 'ouvert') echo 'selected'; ?>>Ouvert</option>
                    <option value="fermé" <?php if ($tournament['status'] == 'fermé') echo 'selected'; ?>>Fermé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier le Tournoi</button>
            <a href="tournois.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
