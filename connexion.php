<?php
$host = '127.0.0.1';  // Adresse de l'hôte (ou '127.0.0.1')
$dbname = 'ArrasGame'; // Nom de la base de données
$username = 'root';    // Nom d'utilisateur MySQL
$password = 'root';        // Mot de passe MySQL (laisse vide si tu n'as pas de mot de passe)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
