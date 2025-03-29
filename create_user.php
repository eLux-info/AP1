<?php
include 'connexion.php'; // Assurez-vous que la connexion à la base de données fonctionne

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hasher le mot de passe
    $role = $_POST['role'];

    try {
        // Insertion des données dans la table Utilisateurs
        $sql = "INSERT INTO Utilisateurs (username, email, mot_de_passe, role) VALUES (:username, :email, :mot_de_passe, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'mot_de_passe' => $password,
            'role' => $role
        ]);

        echo "<h2>Utilisateur créé avec succès</h2>";
        header("Location: profile_admin.php"); // Rediriger vers la gestion des utilisateurs
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
