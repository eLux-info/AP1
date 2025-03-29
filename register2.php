<?php
include 'connexion.php';  // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Hachage du mot de passe

    try {
        // Préparation de la requête SQL pour insérer un nouvel utilisateur
        $sql = "INSERT INTO Utilisateurs (username, email, mot_de_passe) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password
        ]);

        // Redirection vers la page de connexion après l'inscription
        header("Location: login.html");
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur : " . $e->getMessage();
    }
}
?>
