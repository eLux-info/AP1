<?php
session_start();
include "connexion.php"; 

ini_set('display_errors', 0);
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<h2>Veuillez remplir tous les champs.</h2>";
        exit();
    }

    try {
        $sql = "SELECT * FROM Utilisateurs WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit();
        } else {
            echo "<h2>Nom d'utilisateur ou mot de passe incorrect.</h2>";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        echo "<h2>Une erreur est survenue. Veuillez réessayer plus tard.</h2>";
    }
}
?>
