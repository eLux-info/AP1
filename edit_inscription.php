<?php
session_start();
include "connexion.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: tournois.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: tournois.php');
    exit();
}

$inscription_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur_id = $_POST['utilisateur_id'];
    $tournoi_id = $_POST['tournoi_id'];

    $sql = "UPDATE Inscriptions SET utilisateur_id = :utilisateur_id, tournoi_id = :tournoi_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(['utilisateur_id' => $utilisateur_id, 'tournoi_id' => $tournoi_id, 'id' => $inscription_id])) {
        header('Location: tournois.php');
        exit();
    } else {
        $message = "Erreur lors de la mise à jour de l'inscription.";
    }
}

$currentInscription = $pdo->prepare("SELECT * FROM Inscriptions WHERE id = :id");
$currentInscription->execute(['id' => $inscription_id]);
$inscription = $currentInscription->fetch(PDO::FETCH_ASSOC);

$users = $pdo->query("SELECT * FROM Utilisateurs")->fetchAll(PDO::FETCH_ASSOC);
$tournaments = $pdo->query("SELECT * FROM Tournois")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Inscription</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Modifier une Inscription</h1>
        <?php if (isset($message)) echo "<div class='alert alert-warning'>$message</div>"; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="utilisateur_id" class="form-label">Choisir un Utilisateur</label>
                <select name="utilisateur_id" id="utilisateur_id" class="form-select" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>" <?= $user['id'] == $inscription['utilisateur_id'] ? 'selected' : '' ?>><?= htmlspecialchars($user['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tournoi_id" class="form-label">Choisir un Tournoi</label>
                <select name="tournoi_id" id="tournoi_id" class="form-select" required>
                    <?php foreach ($tournaments as $tournament): ?>
                        <option value="<?= $tournament['id'] ?>" <?= $tournament['id'] == $inscription['tournoi_id'] ? 'selected' : '' ?>><?= htmlspecialchars($tournament['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier l'Inscription</button>
            <a href="tournois.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</body>
</html>
