<?php
session_start();
include "connexion.php"; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: tournois.php');
    exit();
}

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur_id = $_POST['utilisateur_id'];
    $tournoi_id = $_POST['tournoi_id'];

    // Vérifier si l'utilisateur est déjà inscrit au tournoi
    $checkQuery = "SELECT COUNT(*) FROM Inscriptions WHERE utilisateur_id = :utilisateur_id AND tournoi_id = :tournoi_id";
    $checkStmt = $pdo->prepare($checkQuery);
    $checkStmt->execute(['utilisateur_id' => $utilisateur_id, 'tournoi_id' => $tournoi_id]);
    
    if ($checkStmt->fetchColumn() > 0) {
        $message = "L'utilisateur est déjà inscrit à ce tournoi.";
    } else {
        // Inscription de l'utilisateur
        $sql = "INSERT INTO Inscriptions (utilisateur_id, tournoi_id) VALUES (:utilisateur_id, :tournoi_id)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(['utilisateur_id' => $utilisateur_id, 'tournoi_id' => $tournoi_id])) {
            header('Location: tournois.php');
            exit();
        } else {
            $message = "Erreur lors de l'inscription.";
        }
    }
}

// Récupérer les utilisateurs
$users = $pdo->query("SELECT * FROM Utilisateurs")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les tournois
$tournaments = $pdo->query("SELECT * FROM Tournois")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Inscription</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Créer une Inscription</h1>
        <?php if (isset($message)) echo "<div class='alert alert-warning'>$message</div>"; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="utilisateur_id" class="form-label">Choisir un Utilisateur</label>
                <select name="utilisateur_id" id="utilisateur_id" class="form-select" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tournoi_id" class="form-label">Choisir un Tournoi</label>
                <select name="tournoi_id" id="tournoi_id" class="form-select" required>
                    <?php foreach ($tournaments as $tournament): ?>
                        <option value="<?= $tournament['id'] ?>"><?= htmlspecialchars($tournament['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
            <a href="tournois.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</body>
</html>
