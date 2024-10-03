<?php
session_start();
session_unset(); // Supprimer toutes les variables de session
session_destroy(); // Détruire la session

// Rediriger l'utilisateur vers la page de connexion après déconnexion
header("Location: index.php");
exit();
?>
