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

    // Récupérer l'ID de l'utilisateur pour vérifier s'il a le droit de supprimer cette inscription
    $sql = "SELECT utilisateur_id FROM Inscriptions WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $inscriptionId, PDO::PARAM_INT); // Utiliser bindValue
    $stmt->execute();
    
    $inscription = $stmt->fetch();

    // Vérifier que l'utilisateur est le propriétaire de l'inscription
    if ($inscription && $inscription['utilisateur_id'] == $_SESSION['user_id']) {
        // Supprimer l'inscription
        $sql = "DELETE FROM Inscriptions WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $inscriptionId, PDO::PARAM_INT); // Utiliser bindValue ici aussi
        $stmt->execute();
        
        // Rediriger vers la page des tournois avec un message de succès
        header("Location: tournois.php?success=1");
        exit(); // Assurer que le script s'arrête ici après la redirection
    } else {
        // Rediriger vers la page des tournois avec un message d'erreur
        header("Location: tournois.php?error=1");
        exit(); // Ajouter exit après redirection
    }
} else {
    // Rediriger vers la page des tournois avec un message d'erreur
    header("Location: tournois.php?error=1");
    exit(); // Ajouter exit après redirection
}
?>
