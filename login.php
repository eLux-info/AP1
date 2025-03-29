<?php
session_start(); // Démarrer la session
include "connexion.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des informations de connexion
    try {
        $sql = "SELECT * FROM Utilisateurs WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Stocker le rôle

            // Redirection vers une page protégée ou d'accueil
            header("Location: index.php");
            exit();
        } else {
            echo "<h2>Nom d'utilisateur ou mot de passe incorrect.</h2>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
