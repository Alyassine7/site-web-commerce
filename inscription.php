<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Hachage du mot de passe avec Bcrypt
    $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_BCRYPT);

    // Insertion dans la base de données
    $sql = "INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $email, $mot_de_passe_hache]);

    echo "Inscription réussie!";
}
?>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
    <button type="submit">S'inscrire</button>
</form>
