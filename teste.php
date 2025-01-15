<?php
// config.php - Configuration de la connexion à la base de données
require 'config.php';

header('Content-Type: text/html; charset=UTF-8');

// Initialiser la requête SQL
$sql = "SELECT * FROM produits";
$params = [];

// Si un paramètre 'q' est passé via AJAX, renvoyer les résultats JSON
if (isset($_GET['q'])) {
    header('Content-Type: application/json');
    $query = '%' . $_GET['q'] . '%';
    $sql .= " WHERE nom LIKE :query";
    $params[':query'] = $query;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($produits);
    exit; // Arrêter l'exécution ici pour éviter d'afficher le HTML
}

// Requête par défaut pour afficher tous les produits au chargement initial
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche de Produits</title>
    <!-- Liens CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f8f9fa; }
        .search-container { margin: 20px auto; max-width: 600px; }
        .produit-image { max-width: 150px; border-radius: 5px; }
        .btn-acheter { background-color: #28a745; color: white; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Catalogue des Produits</h1>
        <div class="search-container">
            <!-- Barre de recherche -->
            <input type="text" id="searchInput" class="form-control" placeholder="Recherchez des produits...">
        </div>

        <!-- Résultats des produits -->
        <div class="swiper-container">
            <div class="swiper-wrapper" id="productResults">
                <?php foreach ($produits as $produit): ?>
                    <div class="swiper-slide">
                        <div class="produit text-center">
                            <img src="images/<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" class="produit-image">
                            <h5><?php echo htmlspecialchars($produit['nom']); ?></h5>
                            <p><?php echo htmlspecialchars($produit['description']); ?></p>
                            <p class="text-primary"><strong><?php echo number_format($produit['prix'], 2, ',', ' ') . ' €'; ?></strong></p>
                            <a href="ajouter_au_panier.php?id=<?php echo $produit['id']; ?>" class="btn btn-acheter">
                                <i class="fas fa-shopping-cart"></i> Acheter
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Liens JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Initialisation de Swiper
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 10,
            loop: true
        });

        // Recherche dynamique avec AJAX
        document.getElementById('searchInput').addEventListener('input', function () {
            const query = this.value.trim();
            fetch(`?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('productResults');
                    container.innerHTML = ''; // Vider le conteneur

                    if (data.length > 0) {
                        data.forEach(produit => {
                            const slide = document.createElement('div');
                            slide.className = 'swiper-slide';
                            slide.innerHTML = `
                                <div class="produit text-center">
                                    <img src="images/${produit.image}" alt="${produit.nom}" class="produit-image">
                                    <h5>${produit.nom}</h5>
                                    <p>${produit.description}</p>
                                    <p class="text-primary"><strong>${parseFloat(produit.prix).toFixed(2)} €</strong></p>
                                    <a href="ajouter_au_panier.php?id=${produit.id}" class="btn btn-acheter">
                                        <i class="fas fa-shopping-cart"></i> Acheter
                                    </a>
                                </div>
                            `;
                            container.appendChild(slide);
                        });
                        swiper.update(); // Mettre à jour Swiper
                    } else {
                        container.innerHTML = '<div class="text-center">Aucun produit trouvé.</div>';
                    }
                })
                .catch(error => console.error('Erreur :', error));
        });
    </script>
</body>
</html>
