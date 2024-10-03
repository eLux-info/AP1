<?php
// Paramètres de connexion
$host = '127.0.0.1';  // Adresse de l'hôte (ou '127.0.0.1')
$dbname = 'ArrasGame'; // Nom de la base de données
$username = 'root';    // Nom d'utilisateur MySQL
$password = 'root';        // Mot de passe MySQL (laisse vide si tu n'as pas de mot de passe)

try {
    // Crée une nouvelle instance de PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Définit le mode d'erreur de PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Affiche un message d'erreur si la connexion échoue
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
