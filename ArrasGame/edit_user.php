<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include "connexion.php";

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    try {
        $sql = "UPDATE Utilisateurs SET username = :username, email = :email, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':role' => $role,
            ':id' => $id
        ]);
        header("Location: profile_admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    $sql = "SELECT * FROM Utilisateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $user = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier Utilisateur</h2>
        <form action="edit_user.php?id=<?= $id ?>" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Rôle</label>
                <select class="form-control" id="role" name="role">
                    <option value="invité" <?= $user['role'] == 'invité' ? 'selected' : '' ?>>Invité</option>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Modifier</button>
        </form>
    </div>
</body>
</html>
