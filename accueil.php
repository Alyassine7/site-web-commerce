<?php

require 'config.php';


// Récupérer tous les produits depuis la base de données
$sql = "SELECT * FROM produits";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Abega</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&family=Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Pour les icônes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            /* Ajout de l'image de fond */
        
            /*  background-image: 
            url('image/font.png');*/

            background-size: cover; /* L'image couvre toute la page */
            background-position: center; /* Centrer l'image */
            background-attachment: fixed; /* L'image reste fixe lors du défilement */
        }

        /* En-tête */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #007BFF, #00C6FF);
            color: #fff;
            padding: 15px 20px;
        }

        .header .logo {
            display: flex;
            align-items: center;
            font-size: 1.5em;
        }

        .header .logo i {
            margin-right: 10px;
            font-size: 1.8em;
        }

        .header nav {
            display: flex;
            gap: 15px;
        }

        .header nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1em;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .header nav a:hover {
            color: #00C6FF;
        }

        /* Texte défilant */
       /* Texte défilant pour la livraison gratuite */
.livraison-gratuite {
    background-color: #007BFF;
    color: #fff;
    font-size: 1em;
    text-align: center;
    padding: 10px 0;
    overflow: hidden;
    position: relative;
}

.livraison-gratuite p {
    position: absolute;
    white-space: nowrap;
    animation: slide-left 10s linear infinite, fade-out 10s linear forwards; /* Animation de déplacement et de disparition */
    left: 100%; /* Démarre hors de la vue */
}

/* Définir l'animation de défilement vers la gauche */
@keyframes slide-left {
    0% {
        transform: translateX(100%); /* Démarre à droite */
    }
    100% {
        transform: translateX(-100%); /* Termine à gauche */
    }
}

/* Animation pour faire disparaître le texte à la fin */
@keyframes fade-out {
    0% {
        opacity: 1; /* Entièrement visible au début */
    }
    100% {
        opacity: 0; /* Disparaît à la fin de l'animation */
    }
}


        /* Animation du texte "Bienvenue chez Abega" */
        .animated-text {
            font-size: 2em;
            text-align: center;
            animation: fadeIn 2s ease-in-out, bounce 3s infinite alternate;
            opacity: 0;
        }

        /* Section produits */
        .produits {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .produit {
            color: #333; 
    background: rgba(255, 255, 255, 0.8); /* Fond blanc avec opacité de 0.8 */
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    width: 300px;
    transition: transform 0.3s ease;
}
.produits {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 colonnes égales */
    gap: 20px; /* Espacement entre les éléments */
    margin: 20px auto;
    max-width: 1200px;
}


        .produit:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .produit-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .produit h2 {
            font-size: 1.2em;
            margin: 10px 0;
        }

        .produit p {
            font-size: 0.9em;
            padding: 0 10px;
        }

        .prix {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn-acheter {
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: background-color 0.3s ease;
        }

        .btn-acheter:hover {
            background: #0056b3;
        }
        .livraison-gratuite p {
    animation: slide-left 10s linear infinite; /* Supprimer fade-out */
}

        /* Keyframes pour les animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-10px);
            }
        }

/* Barre de contact en bas de la page */
/* Barre de contact en bas de la page */
.footer {
    background-color: #007BFF; /* Couleur de fond */
    color: #fff;
    text-align: center;
    padding: 20px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 10;
    display: none; /* Cacher la barre au début */
}

.footer .contact-info {
    margin-bottom: 10px;
}

.footer p {
    font-size: 0.9em;
    margin: 5px 0;
}

.footer .social-icons {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.footer .social-icon {
    color: #fff;
    font-size: 1.5em;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer .social-icon:hover {
    color: #00C6FF; /* Changement de couleur au survol */
}

/* Icônes de contact */
.fas, .fab {
    margin-right: 10px;
}

@media (max-width: 768px) {
    .produits {
        grid-template-columns: repeat(2, 1fr); /* 2 colonnes sur petits écrans */
    }

    .header nav {
        flex-wrap: wrap;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .produits {
        grid-template-columns: 1fr; /* Une seule colonne sur très petits écrans */
    }
}




    </style>


 <style>
       /* Blog glissant */
/* Section glissante */
.content-glissant {
    max-height: 0; /* Masqué par défaut */
    overflow: hidden;
    background-color: #f9f9f9;
    margin: 10px 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 0 20px;
    transition: max-height 0.5s ease-in-out, padding 0.5s ease-in-out;
    visibility: hidden; /* Complètement invisible */
}

.content-glissant.visible {
    max-height: 1000px; /* Ajuster selon la taille totale du contenu */
    padding: 20px;
    visibility: visible; /* Visible après le clic */
}

.content-glissant h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.content-glissant p {
    font-size: 1em;
    line-height: 1.6;
}

/* Conteneur des images */
.images-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin: 20px 0;
}

.images-container img {
    width: calc(33.333% - 10px);
    max-width: 150px;
    height: auto;
    border-radius: 5px;
    object-fit: cover;
}


        .marquee {
    width: 100%; /* Largeur du conteneur */
    height: 40px; /* Hauteur ajustée au texte */
    overflow: hidden; /* Masque tout ce qui dépasse */
    white-space: nowrap; /* Empêche le texte de passer à la ligne */
    background-color: transparent; /* Conteneur transparent */
    position: relative; /* Pour un positionnement précis du texte */
}

.marquee span {
    display: inline-block;
    position: absolute;
    right: 100%; /* Commence complètement à gauche, hors écran */
    animation: scroll-right 10s linear infinite; /* Animation de gauche à droite */
    font-size: 20px; /* Taille du texte */
    color: right; /* Couleur du texte */
}

/* Animation de gauche à droite */
@keyframes scroll-right {
    10% {
        transform: translateX(-100%); /* Hors écran à gauche */
    }
    100% {
        transform: translateX(300%); /* Hors écran à droite */
    }
}


    </style>



<style>

/* Icône du panier */
#cart-icon {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #007BFF;
    color: white;
    padding: 10px 15px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 18px;
    z-index: 1000;
}

#cart-count {
    background-color: red;
    color: white;
    font-weight: bold;
    padding: 2px 8px;
    border-radius: 50%;
    margin-left: 5px;
}

/* Blog glissant pour le panier */
.cart-glissant {
    position: fixed;
    top: 0;
    right: -100%;
    width: 400px;
    height: 100%;
    background: #f9f9f9;
    border-left: 1px solid #ddd;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    padding: 20px;
    transition: right 0.5s ease-in-out;
    z-index: 999;
}

.cart-glissant.visible {
    right: 0;
}

.cart-glissant h2 {
    font-size: 1.5em;
    margin-bottom: 20px;
}

.cart-glissant .cart-total {
    margin-top: 20px;
    font-size: 1.2em;
    text-align: center;
}

.cart-glissant button {
    width: 100%;
    padding: 10px;
    background: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
}


</style>
    

</head>
<body>

<header class="header">
    <div class="logo">
        <i class="fas fa-user-circle"></i> <!-- Icône de compte utilisateur -->
        <span>Bienvenue chez Abiga</span></div>
        <div class="marquee">
        <span>Livraison gratuite pour toute commande supérieure à 200 € !</span>
    </div>
   
    <nav>
        <a href="#">Accueil</a>
        <a href="#" id="services-link">Services</a>
        <a href="#" id="boutique-link">Boutique</a>
        <a href="connexion.php">Connexion</a> <!-- Lien vers la page de connexion -->
    </nav>
</header>

<!-- Texte animé de bienvenue -->
<header>
    <h1 id="welcome-message" class="animated-text"></h1>
</header>



<div id="services" class="content-glissant">
    <h2>Nos Services</h2>
    <p>Découvrez nos services exclusifs conçus pour répondre à tous vos besoins. Nous offrons une large gamme de solutions adaptées à vos exigences.</p>
    <div class="images-container">
        <img src="image/tele.jpg" alt="Service 1">
        <img src="image/service2.jpg" alt="Service 2">
    </div>
</div>

<!-- Section Boutique -->
<div id="boutique" class="content-glissant">
    <h2>Notre Boutique</h2>
    <p>Explorez notre boutique avec des produits de qualité soigneusement sélectionnés pour vous.</p>
    <div class="images-container">
        <img src="image/product1.jpg" alt="Produit 1">
        <img src="image/product2.jpg" alt="Produit 2">
    </div>
</div>


    <!-- Scripts -->
    <script>
        // Basculer l'affichage du blog glissant
        
      // Sélectionnez tous les liens et leurs sections correspondantes
const links = document.querySelectorAll('a[id$="-link"]'); // Tous les liens se terminant par "-link"
const contents = document.querySelectorAll('.content-glissant');

links.forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        const targetId = link.id.replace('-link', ''); // Extrait l'ID cible (ex : "services" ou "boutique")
        const targetContent = document.getElementById(targetId);

        // Ferme toutes les sections avant d'ouvrir la cible
        contents.forEach(content => {
            if (content !== targetContent) {
                content.classList.remove('visible');
            }
        });

        // Bascule la visibilité de la section cible
        targetContent.classList.toggle('visible');
    });
});


    </script>   
<!-- Texte défilant pour la livraison gratuite -->

<!-- Scripts pour améliorer les animations -->
<script>
    // Fonction pour déclencher l'animation du texte de bienvenue avec un léger retard pour le rendre dynamique
    window.onload = function() {
        const welcomeMessage = document.getElementById('welcome-message');
        welcomeMessage.style.animation = 'fadeIn 2s ease-in-out forwards, bounce 3s infinite alternate';
    };
</script>

<script>
    document.getElementById('cart-icon').addEventListener('click', () => {
        document.querySelector('.cart-glissant').classList.toggle('visible');
    });
</script>

<?php
// Exemple de données simulées provenant d'une base de données
$produit = [
    'nom' => "<script>alert('XSS!');</script>Produit dangereux",
    'description' => "Description avec des <b>balises HTML</b> et 'guillemets'."
];
?>



   <!-- Icône du panier -->
<div id="cart-icon">
    🛒 <span id="cart-count">0</span>
</div>

<!-- Blog glissant pour le panier -->
<div id="cart" class="cart-glissant">
    <h2>Votre Panier</h2>
    <div id="cart-items"></div> <!-- Liste des articles -->
    <div class="cart-total">
        <p><strong>Total :</strong> <span id="cart-total">0,00 €</span></p>
    </div>
    <form action="ajouter_au_panier.php" method="POST">
        <button type="submit" id="checkout-btn">Passer au paiement</button>
    </form>
</div>


<!-- Produits -->
<div class="produits">
    <?php foreach ($produits as $produit): ?>
        <div class="produit">
            <img src="images/<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" class="produit-image" loading="lazy">
            <h2><?php echo htmlspecialchars($produit['nom'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?php echo htmlspecialchars($produit['description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="prix"><strong>Prix :</strong> <?php echo number_format($produit['prix'], 2, ',', ' ') . ' €'; ?></p>
            <button class="btn-acheter" data-id="<?php echo $produit['id']; ?>" data-nom="<?php echo htmlspecialchars($produit['nom'], ENT_QUOTES, 'UTF-8'); ?>" data-prix="<?php echo $produit['prix']; ?>">Acheter directement</button>
        </div>
    <?php endforeach; ?>
</div>

<!-- Navbar de contact en bas de la page -->
<!-- Navbar de contact en bas de la page -->
<footer id="footer" class="footer">
    <div class="contact-info">
        <p><i class="fas fa-map-marker-alt"></i> Rue de la Grande Traversée - Immeuble Archipel Kaweni 97600 Mamoudzou</p>
        <p><i class="fas fa-phone-alt"></i> ​0269 60 18 80 / 0639 39 26 59</p>
        <p><i class="fas fa-envelope"></i> decorama110@gmail.com</p>
    </div>
    <div class="social-icons">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <a href="https://www.facebook.com/yourfacebookpage" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="https://wa.me/2618298447?text=Bonjour,%20je%20souhaite%20plus%20d'informations." target="_blank" class="social-icon">
    <i class="fab fa-whatsapp"></i>
</a>

        <a href="mailto:decorama110@gmail.com" class="social-icon"><i class="fas fa-envelope"></i></a>
    </div>
</footer>


<script>
    // Fonction pour afficher la barre de contact quand l'utilisateur atteint le bas de la page
    window.onscroll = function() {
        // Détecter la position de défilement
        var footer = document.getElementById('footer');
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            // L'utilisateur est en bas de la page
            footer.style.display = 'block';  // Afficher la barre de contact
        } else {
            // L'utilisateur n'est pas encore en bas
            footer.style.display = 'none';  // Cacher la barre de contact
        }
    };
</script>

<script>
// Sélection des éléments
const cartIcon = document.getElementById('cart-icon');
const cart = document.getElementById('cart');
const cartItemsContainer = document.getElementById('cart-items');
const cartCount = document.getElementById('cart-count');
const cartTotal = document.getElementById('cart-total');

// Tableau pour stocker les articles du panier
let cartItems = [];

// Afficher ou masquer le panier
cartIcon.addEventListener('click', () => {
    cart.classList.toggle('visible');
});

// Ajouter un produit au panier
document.querySelectorAll('.btn-acheter').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        const nom = button.getAttribute('data-nom');
        const prix = parseFloat(button.getAttribute('data-prix'));

        // Vérifier si l'article existe déjà
        const existingItem = cartItems.find(item => item.id === id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cartItems.push({ id, nom, prix, quantity: 1 });
        }

        updateCart();
    });
});

// Mettre à jour l'affichage du panier
function updateCart() {
    // Réinitialiser le contenu
    cartItemsContainer.innerHTML = '';

    // Ajouter chaque article
    cartItems.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'cart-item';
        itemDiv.innerHTML = `
            <p>${item.nom} - ${item.prix.toFixed(2)} €</p>
            <div>
                <button class="quantity-btn" data-id="${item.id}" data-action="decrease">-</button>
                <span>${item.quantity}</span>
                <button class="quantity-btn" data-id="${item.id}" data-action="increase">+</button>
            </div>
        `;
        cartItemsContainer.appendChild(itemDiv);
    });

    // Calculer le total
    const total = cartItems.reduce((sum, item) => sum + item.prix * item.quantity, 0);
    cartTotal.textContent = total.toFixed(2) + ' €';

    // Mettre à jour le compteur d'articles
    cartCount.textContent = cartItems.length;

    // Gestion des boutons d'ajustement
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const id = button.getAttribute('data-id');
            const action = button.getAttribute('data-action');
            const item = cartItems.find(item => item.id === id);

            if (item) {
                if (action === 'increase') {
                    item.quantity++;
                } else if (action === 'decrease') {
                    item.quantity--;
                    if (item.quantity <= 0) {
                        cartItems = cartItems.filter(item => item.id !== id);
                    }
                }
                updateCart();
            }
        });
    });
}


</script>

</body>
</html>
