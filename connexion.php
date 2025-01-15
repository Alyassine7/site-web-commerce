<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérification de l'existence de l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
        echo "Connexion réussie!";
        header('Location: accueil.php');
    } else {
        echo "Email ou mot de passe incorrect!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
    <button type="submit">Se connecter</button>
</form>
