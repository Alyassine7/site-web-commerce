<?php
// Configuration de la connexion à la base de données
$host = '127.0.0.1';
$db = 'gestion_magasin';
$user = 'root'; // Utilisateur par défaut
$pass = ''; // Aucun mot de passe par défaut

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Configuration de l'option pour afficher les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
