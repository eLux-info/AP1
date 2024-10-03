<?php
session_start();
include "connexion.php";

if (isset($_GET['id'])) {
    $tournoi_id = $_GET['id'];

    try {
        // Supprimer les inscriptions liées au tournoi
        $sql = "DELETE FROM Inscriptions WHERE tournoi_id = :tournoi_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['tournoi_id' => $tournoi_id]);

        // Ensuite, supprimer le tournoi
        $sql = "DELETE FROM Tournois WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $tournoi_id]);

        // Redirection après suppression
        header("Location: tournois.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "ID de tournoi non spécifié.";
}
?>
