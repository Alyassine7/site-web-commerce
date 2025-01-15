<?php
require 'config.php';

// Ajouter un produit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];

    // Déplacer l'image téléchargée dans le dossier "images"
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

    // Insérer dans la base de données
    $sql = "INSERT INTO produits (nom, description, prix, categorie, stock, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $prix, $categorie, $stock, $image]);
}

// Modifier un produit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
    } else {
        // Si aucune nouvelle image, on garde l'ancienne
        $image = $_POST['image_existante'];
    }

    $sql = "UPDATE produits SET nom = ?, description = ?, prix = ?, categorie = ?, stock = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $prix, $categorie, $stock, $image, $id]);
}

// Supprimer un produit
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $sql = "DELETE FROM produits WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

// Recherche d'un produit
$recherche = "";
if (isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $sql = "SELECT * FROM produits WHERE nom LIKE ? OR description LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $recherche . '%', '%' . $recherche . '%']);
} else {
    $sql = "SELECT * FROM produits";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Produits</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ajoute ton fichier CSS pour le style -->
</head>
<body>

<h1>Administration des Produits</h1>

<!-- Formulaire pour ajouter un produit -->
<h2>Ajouter un produit</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="Nom du produit" required><br>
    <textarea name="description" placeholder="Description du produit" required></textarea><br>
    <input type="number" name="prix" placeholder="Prix" step="0.01" required><br>
    <input type="text" name="categorie" placeholder="Catégorie" required><br>
    <input type="number" name="stock" placeholder="Quantité en stock" required><br>
    <input type="file" name="image" required><br>
    <button type="submit" name="ajouter">Ajouter le produit</button>
</form>

<!-- Recherche de produit -->
<h2>Rechercher un produit</h2>
<form method="GET">
    <input type="text" name="recherche" placeholder="Rechercher" value="<?php echo $recherche; ?>">
    <button type="submit">Rechercher</button>
</form>

<!-- Affichage des produits -->
<h2>Liste des produits</h2>
<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Catégorie</th>
        <th>Stock</th>
        <th>Action</th>
    </tr>
    <?php foreach ($produits as $produit): ?>
        <tr>
            <td><?php echo $produit['nom']; ?></td>
            <td><?php echo $produit['description']; ?></td>
            <td><?php echo number_format($produit['prix'], 2, ',', ' ') . ' €'; ?></td>
            <td><?php echo $produit['categorie']; ?></td>
            <td><?php echo $produit['stock']; ?></td>
            <td>
                <a href="admin.php?modifier=<?php echo $produit['id']; ?>">Modifier</a> | 
                <a href="admin.php?supprimer=<?php echo $produit['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
