<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include "connexion.php";

$id = $_GET['id'];

try {
    $sql = "DELETE FROM Utilisateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    header("Location: profile_admin.php");
    exit();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
