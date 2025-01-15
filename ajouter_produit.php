<?php
require 'config.php';
require 'stripe_config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = (float)$_POST['prix'];

    // Gestion de l'image
    $image = $_FILES['image'];
    $chemin_image = 'uploads/' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $chemin_image);

    // Insertion dans la base
    $sql = "INSERT INTO produits (nom, description, prix, image_url) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$nom, $description, $prix, $chemin_image])) {
        header("Location: admin.php?message=Produit ajouté avec succès");
    } else {
        echo "Erreur lors de l'ajout.";
    }
}
?>
