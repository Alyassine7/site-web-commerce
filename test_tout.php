<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Fermeture</title>
  
      
</head>
<style>


body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
}

header nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}

header nav ul li a {
    color: white;
    text-decoration: none;
}

aside {
    padding: 20px;
    background-color: #f4f4f4;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
}

.product {
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    background-color: white;
    text-align: center;
    padding: 10px;
}

.product img {
    max-width: 100%;
    height: auto;
    display: block;
}

.product h3 {
    margin: 10px 0;
    font-size: 1.2rem;
}
.product img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

</style>

<style>
/* Bannière promotionnelle */
.promo-banner {
    background-color: #ff9800; /* Couleur d'arrière-plan (orange) */
    color: #fff; /* Texte blanc */
    padding: 10px 20px;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000; /* Toujours visible */
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Texte de la bannière */
.promo-banner p {
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    max-width: 1200px;
}

/* Bouton pour fermer la bannière */
.close-banner {
    background: none;
    border: none;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    margin-left: 20px;
}

.close-banner:hover {
    color: #000; /* Change la couleur au survol */
}


</style>
<style>/* Conteneur de recherche */
.search-container {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
}

/* Barre de recherche */
.search-bar {
    width: 100%;
    padding: 10px 15px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Bouton de recherche */
.search-button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #555;
}

/* Liste de suggestions */
.suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-height: 200px;
    overflow-y: auto;
}

.suggestions div {
    padding: 10px 15px;
    font-size: 16px;
    cursor: pointer;
}

.suggestions div:hover {
    background: #f0f0f0;
}
</style>
<body>


<header>
        <h1>Catalogue d'Ameublement</h1>
        <nav>
            <ul>
                <li><a href="#" data-category="all">Tous</a></li>
                <li><a href="#" data-category="chambres">Chambres</a></li>
                <li><a href="#" data-category="salons">Salons</a></li>
                <li><a href="#" data-category="bureaux">Bureaux</a></li>
            </ul>
        </nav>
    </header>

    <aside>
        <h2>Filtres</h2>
        <label for="price-filter">Prix :</label>
        <select id="price-filter">
            <option value="all">Tous</option>
            <option value="low">Moins de 500€</option>
            <option value="medium">500€ - 1000€</option>
            <option value="high">Plus de 1000€</option>
        </select>

        <label for="material-filter">Matériaux :</label>
        <select id="material-filter">
            <option value="all">Tousss</option>
            <option value="bois">Bois</option>
            <option value="métal">Métal</option>
            <option value="verre">Verre</option>
        </select>
    </aside>

    <main>
        <div id="product-list" class="product-grid">
            <!-- Produits générés dynamiquement -->
        </div>
    </main>

    <div id="promo-banner" class="promo-banner">
    <p>
        🎉 <span id="promo-message">Profitez de 20% de remise sur tous les articles !</span> 🎉
        <button id="close-banner" class="close-banner">×</button>
    </p>
</div>

<div class="search-container">
    <input 
        type="text" 
        id="search-bar" 
        class="search-bar" 
        placeholder="Recherchez des meubles (ex : table, canapé...)" 
    />
    <button id="search-button" class="search-button">🔍</button>
    <div id="suggestions" class="suggestions"></div>
</div>
    <script src="scripts.js"></script>


 <script>
// Produits simulés
const products = [
    { id: 1, name: "Lit en bois", category: "chambres", price: 800, material: "bois", image: "images/chaise1.jpg" },
    { id: 2, name: "Canapé moderne", category: "salons", price: 1200, material: "tissu", image: "images/tele.jpg" },
    { id: 3, name: "Bureau en verre", category: "bureaux", price: 600, material: "verre", image: "bureau.jpg" },
    { id: 4, name: "Armoire en métal", category: "chambres", price: 500, material: "métal", image: "armoire.jpg" },
];

// Fonction pour afficher les produits
const displayProducts = (filteredProducts) => {
    const productList = document.getElementById('product-list');
    productList.innerHTML = "";
    filteredProducts.forEach(product => {
        const productHTML = `
            <div class="product">
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>Prix : ${product.price}€</p>
                <p>Matériaux : ${product.material}</p>
            </div>
        `;
        productList.innerHTML += productHTML;
    });
};

// Filtres
const applyFilters = () => {
    const category = document.querySelector('nav a.active')?.dataset.category || "all";
    const price = document.getElementById('price-filter').value;
    const material = document.getElementById('material-filter').value;

    let filteredProducts = products;

    // Filtrage par catégorie
    if (category !== "all") {
        filteredProducts = filteredProducts.filter(product => product.category === category);
    }

    // Filtrage par prix
    if (price === "low") {
        filteredProducts = filteredProducts.filter(product => product.price < 500);
    } else if (price === "medium") {
        filteredProducts = filteredProducts.filter(product => product.price >= 500 && product.price <= 1000);
    } else if (price === "high") {
        filteredProducts = filteredProducts.filter(product => product.price > 1000);
    }

    // Filtrage par matériau
    if (material !== "all") {
        filteredProducts = filteredProducts.filter(product => product.material === material);
    }

    displayProducts(filteredProducts);
};

// Gestion des événements
document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelectorAll('nav a').forEach(link => link.classList.remove('active'));
        e.target.classList.add('active');
        applyFilters();
    });
});

document.getElementById('price-filter').addEventListener('change', applyFilters);
document.getElementById('material-filter').addEventListener('change', applyFilters);

// Affiche tous les produits par défaut
displayProducts(products);


 </script>  

 <script>// Sélectionner les éléments
const promoBanner = document.getElementById('promo-banner');
const closeBannerButton = document.getElementById('close-banner');

// Fonction pour fermer la bannière
closeBannerButton.addEventListener('click', () => {
    promoBanner.style.display = 'none'; // Cache la bannière
});

// Optionnel : Changer le message promotionnel dynamiquement
const promoMessage = document.getElementById('promo-message');
promoMessage.textContent = "Nouvelle collection disponible - Livraison gratuite dès 50€ !";
</script>

<script>// Base de données simulée
const products = [
    { id: 1, name: "Lit en bois", category: "chambres", price: 800 },
    { id: 2, name: "Canapé d'angle", category: "salons", price: 1500 },
    { id: 3, name: "Table en verre", category: "salles à manger", price: 600 },
    { id: 4, name: "Chaise de bureau", category: "bureaux", price: 200 },
    { id: 5, name: "Commode vintage", category: "chambres", price: 400 },
];

// Sélection des éléments
const searchBar = document.getElementById('search-bar');
const suggestionsBox = document.getElementById('suggestions');

// Écouteur d'événement pour la saisie dans la barre de recherche
searchBar.addEventListener('input', () => {
    const query = searchBar.value.toLowerCase();
    suggestionsBox.innerHTML = ''; // Vide les suggestions précédentes
    
    if (query) {
        // Filtrer les produits correspondant à la requête
        const filteredProducts = products.filter(product =>
            product.name.toLowerCase().includes(query)
        );

        // Afficher les suggestions
        filteredProducts.forEach(product => {
            const suggestion = document.createElement('div');
            suggestion.textContent = product.name;
            suggestion.addEventListener('click', () => {
                searchBar.value = product.name; // Remplit la barre de recherche
                suggestionsBox.innerHTML = ''; // Vide les suggestions
            });
            suggestionsBox.appendChild(suggestion);
        });
    }
});

// Écouteur pour cacher les suggestions lorsqu'on clique en dehors
document.addEventListener('click', (e) => {
    if (!e.target.closest('.search-container')) {
        suggestionsBox.innerHTML = '';
    }
});
</script>
</body>
</html>
