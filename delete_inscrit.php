<?php
session_start();
include "connexion.php"; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit;
}

if (isset($_GET['id'])) {
    $inscriptionId = $_GET['id'];

    $sql = "SELECT utilisateur_id FROM Inscriptions WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $inscriptionId, PDO::PARAM_INT);
    $stmt->execute();
    
    $inscription = $stmt->fetch();

    if ($inscription && $inscription['utilisateur_id'] == $_SESSION['user_id']) {
        $sql = "DELETE FROM Inscriptions WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $inscriptionId, PDO::PARAM_INT);
        $stmt->execute();
        
        header("Location: tournois.php?success=1");
        exit();
    } else {
        header("Location: tournois.php?error=1");
        exit();
    }
} else {
    header("Location: tournois.php?error=1");
    exit();
}
?>
