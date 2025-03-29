<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Tournoi</title>
</head>
<body>

<form action="inscription.php" method="post">
    <label for="utilisateur_id">Nom d'utilisateur:</label>
    <select name="utilisateur_id" required>
        <?php
        $host = 'localhost';
        $db = 'ArrasGame';
        $user = 'ton_utilisateur';
        $pass = 'ton_mot_de_passe';

        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, nom FROM Utilisateurs";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nom']) . "</option>";
            }
        } else {
            echo "<option value=''>Aucun utilisateur trouvé</option>";
        }
        ?>
    </select>
    
    <label for="tournoi_id">Sélectionner un tournoi:</label>
    <select name="tournoi_id" required>
        <?php
        $sql = "SELECT id, nom_tournoi FROM Tournois";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nom_tournoi']) . "</option>";
            }
        } else {
            echo "<option value=''>Aucun tournoi trouvé</option>";
        }
        ?>
    </select>

    <input type="submit" value="S'inscrire">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utilisateur_id = $_POST['utilisateur_id'];
    $tournoi_id = $_POST['tournoi_id'];

    $sql = "INSERT INTO Inscriptions (utilisateur_id, tournoi_id) VALUES ('$utilisateur_id', '$tournoi_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>
