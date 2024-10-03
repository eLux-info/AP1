<?php
session_start();
include "connexion.php"; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: tournois.php');
    exit();
}

// Récupérer l'inscription à supprimer
if (!isset($_GET['id'])) {
    header('Location: tournois.php');
    exit();
}

$inscription_id = $_GET['id'];

// Supprimer l'inscription
$sql = "DELETE FROM Inscriptions WHERE id = :id";
$stmt = $pdo->prepare($sql);
if ($stmt->execute(['id' => $inscription_id])) {
    header('Location: tournois.php');
    exit();
} else {
    $message = "Erreur lors de la suppression de l'inscription.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une Inscription</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Supprimer une Inscription</h1>
        <?php if (isset($message)) echo "<div class='alert alert-warning'>$message</div>"; ?>
        <p>Inscription supprimée avec succès.</p>
        <a href="tournois.php" class="btn btn-secondary">Retour</a>
    </div>
