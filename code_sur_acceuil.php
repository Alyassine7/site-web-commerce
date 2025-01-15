<?php

require 'config.php';

// Récupérer tous les produits depuis la base de données
$sql = "SELECT * FROM produits";
//$sql = "SELECT `nom` FROM `produits` WHERE `nom` = 'tété'";
//$sql = "SELECT image FROM produits WHERE nom = 'lit'";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
// recherche dynamique la partie php 
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
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Abega</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&family=Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Pour les icônes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">



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
            background: linear-gradient(90deg, goldenrod, #00C6FF);
            color: #fff;
           
            padding: 5px 10px;
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
            color: black;
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

 
        .produits {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .swiper-container {
    width: 100%;
    height: auto;
    padding: 10px 0;

    
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}

.swiper-container {
    overflow: hidden; /* Empêche les débordements pour la ligne en bas */
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
        
.produit-image{
           
            
            width: 100%;
            height: 220px; /* Hauteur ajustée pour une meilleure présentation */
            object-fit: cover;
            margin-bottom: 10px; /* Marge réduite entre l'image et le texte */
            border-radius: 8px;
        
        }


        /* Adaptation mobile */
        @media (max-width: 768px) {
            .produits-container {
                grid-template-columns: repeat(2, 1fr); /* 2 colonnes sur mobile */
            }
        }

        @media (max-width: 480px) {
            .produits-container {
                grid-template-columns: 1fr; /* 1 colonne sur petit écran */
            }
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
            color:brown;
        }

        .btn-acheter i {
    margin-right: 8px; /* Espace entre l'icône et le texte */
}



        
            .btn-acheter {
    background: linear-gradient(to right, #2575fc, #6a11cb);
    color: #fff;
    font-weight: bold;
    font-size: 1rem;
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 30px;
    margin: 15px 0;
    display: inline-block;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

        

        

            h1 {
                font-size: 2rem;
            }
        




        .btn-acheter:hover {
            background: #0056b3;
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
/* Blog glissant */
/* Section glissante */
/* Blog glissant */
/* Section glissante */
.content-glissant {
    max-height: 0; 
    /* Masqué par défaut */
    overflow: hidden;
    background-color: khaki;
    margin: 10px 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 0 20px;
    transition: max-height 0.5s ease-in-out, padding 0.5s ease-in-out;
    visibility: hidden; /* Complètement invisible */
    position: fixed;  /* Position fixe pour rester en haut de l'écran */
    top: 89px;  /* Positionner juste en dessous de la navbar (ajustez la valeur en fonction de la hauteur de la navbar) */
    left: 0;  /* Alignement sur la gauche */
    right: 0;  /* S'étendre sur toute la largeur */
    z-index: 1000;  /* Assure que l'élément reste au-dessus des autres éléments */
}

/* Lorsqu'il devient visible */
.content-glissant.visible {
    max-height: 1000px; /* Ajuster selon la taille totale du contenu */
    padding: 20px;
    visibility: visible; /* Visible après le clic */
}

/* Titre de la section */
.content-glissant h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

/* Texte de la section */
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

/* Marquee effect */
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
    animation: scroll-right 30s linear infinite; /* Animation de gauche à droite */
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
    
    /*image couverture */
        
        .cover-image {
            position: relative;
            display: inline-block;
            width: 100%; /* Largeur relative à l'écran */
            max-width: 1500px; /* Largeur maximale pour limiter la taille */
            height: 450px; /* Hauteur fixe pour réduire verticalement */
            overflow: hidden; /* Masque les parties débordantes */
        }

        .cover-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajuste l'image pour remplir le conteneur */
        }

        .cover-image .overlay {
            position: absolute;
            top: 0;
            left: 50;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Couche semi-transparente */
            z-index: 1;
        }

        .cover-image .text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 20px; /* Réduction de la taille du texte */
            font-weight: bold;
            text-align: center;
            z-index: 2;
        }

        .cover-image .text h1 {
            font-size: 36px; /* Taille du texte du titre */
            font-weight: bold;
            color: #FFD700; /* Couleur dorée pour le titre */
            
            margin: 10px 0;
            font-family: 'Georgia', serif; /* Police élégante pour le titre */
            text-transform: uppercase; /* Texte en majuscules */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Ombre pour effet 3D */
        }

        .cover-image .text p {
            font-size: 18px; /* Taille du texte secondaire */
            line-height: 1.6; /* Espacement pour la lisibilité */
            color: #f0f0f0; /* Couleur légèrement différente pour le contraste */
        }

    </style>
    
<style>
.logo {
    display: flex;
    align-items: center; /* Aligne le logo et le texte au centre verticalement */
    gap: 10px; /* Espace entre le logo et le texte */
    font-family: 'Arial', sans-serif;
    font-size: 20px; /* Taille du texte */
    font-weight: bold;
    color: #333; /* Couleur du texte */
}

.logo .logo-image {
    width: 70px; /* Largeur du logo */
    height: 70px; /* Hauteur du logo */
    object-fit: cover; /* Ajuste l'image au conteneur */
    border-radius: 50%; /* Donne une forme circulaire au logo */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre subtile pour un effet moderne */
}

</style>

<style>
/* Style de la navigation */

/* Style du popup */
.popup {
    position: fixed;
    top: 0;
    right: -100%;
    width: 250px;
    height: 100%;
    background-color:white;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    padding: 20px;
    transition: right 0.4s ease;
    z-index: 1000;
    overflow-y: auto;
}

.popup.active {
    left: 0; /* Fait glisser le popup dans l'écran */
}

/* Contenu du popup */
.popup-content {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.popup-content button {
    display: flex;
    align-items: center;
    background-color:darkorange;
    color: white;
    border: none;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.popup-content button:hover {
    background-color:#007BFF;
}

/* Boutons avec icônes */
.popup-content .button-icon {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 10px;
}

/* Bouton de fermeture */
.close-btn {
    position: absolute;
    top: -15px;
    color:black;
    right: 1px;
    background: none;
    border: none;
    font-size: 25px;
    cursor: pointer;
}


</style>
    
<style>

/* Conteneur de la photo de couverture */
.cover-photo {
    margin-top: -8px;
    position: relative;
    height: 300px;
    overflow: hidden;
    width: 100%; /* Largeur relative à l'écran */
    max-width: 1500px; /* Largeur maximale pour limiter la taille */
    height: 300px; /* Hauteur fixe pour réduire verticalement */
    overflow: hidden; /* Masque les parties débordantes */
}

/* Image de la couverture */
.cover-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ajuste l'image pour remplir tout le conteneur */
    filter: brightness(1.2); /* Augmente la luminosité de l'image */
    transition: all 0.3s ease; /* Transition douce pour un effet interactif */
}

/* Effet au survol de l'image */
.cover-photo img:hover {
    filter: brightness(1.3); /* Accentue encore plus la luminosité au survol */
}
.cover-photo .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Couche semi-transparente */
            z-index: 1;
        }
/* Texte sur l'image */
.cover-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white; /* Texte blanc */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Ombre pour rendre le texte lisible */
}

/* Titres et paragraphes */
.cover-text h1 {
    font-size: 36px;
    margin: 0;
}

.cover-text p {
    font-size: 18px;
    margin: 10px 0 0;
}


</style>

<style>

form {
            margin-bottom: 0px;
            background-color: transparent;
        }
        input[type="text"] {
          
            padding: 10px;
            
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: linear-gradient(to right, #2575fc, #6a11cb);
    color: #fff;
    font-weight: bold;
    font-size: 1rem;
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 100px;
    margin: 15px 0;
    display: inline-block;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;

        }
        button:hover {
            background-color:aqua;
        }
        .popup-popup {
            position: fixed;
            top: -100%;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            max-height: 300px;
            overflow-y: auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
            opacity: 0;
            transition: all 0.5s ease;
            z-index: 1000;
        }
        .popup-pupup.show {
            top: 10px;
            opacity: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;

        }

        
    </style>

<style>

/* Flèches de navigation */
.swiper-button-next, .swiper-button-prev {
    position: fixed; /* Positionnement fixe par rapport à l'écran */
    top: 60%; /* Centrer verticalement */
    transform: translateY(-50%); /* Ajuster la position pour un centrage parfait */
    background-color: transparent; /* Aucun fond */
    color: #007BFF; /* Couleur des flèches */
    font-size: 5px; /* Réduire la taille des flèches */
    cursor: pointer;
    z-index: 10;
    transition: color 0.3s ease, transform 0.3s ease;
}

/* Classe pour cacher les flèches */
.hide-arrow {
    visibility: hidden; /* Cache les flèches sans les retirer complètement */
    opacity: 0; /* Les rend invisibles */
    transition: visibility 0.3s, opacity 0.3s; /* Animation de transition */
}
    
</style>

<style>

    /* Style pour la galerie d'images */
    body {
    background-color: #f8f9fa; /* Couleur douce pour le fond */
    margin: 0;
    font-family: Arial, sans-serif;
}

.image-galerie {
    display: flex;
    justify-content: space-between;
    gap: 50px;
    margin-top: 30px;
}

.image-container {
    position: relative;
    width: 50%;
    max-width: 400px;
    border-radius: 10px;
    overflow: hidden;
    background-color: white; /* Fond blanc pour le conteneur */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Légère ombre pour séparer le conteneur du fond */
}

/* Image nette et centrée */
.image-container img {
    width: 100%;
    height: 300px;
    object-fit: cover; /* Garder l'image bien cadrée */
    object-position: center center; /* Centrer l'image pour éviter qu'elle soit coupée */
    transition: transform 0.3s ease-in-out; /* Animation au survol pour effet de recul */
}

/* Effet de survol pour reculer l'image */
.image-container:hover img {
    transform: scale(0.95); /* Réduire légèrement l'image au survol pour un effet de recul */
}

/* Style du texte sur les images */
.texte-texte {
    position: absolute;
    bottom: 10px; /* Position légèrement au-dessus du bas */
    left: 20px; /* Garde une petite marge à gauche */
    right: 5px; /* Décale tout le bloc de texte vers la droite */
    background: rgba(255, 255, 255, 0.9); /* Fond blanc semi-transparent pour le texte */
    color: black; /* Texte noir pour contraste */
    padding: 10px 15px; /* Ajuste le padding */
    border-radius: 10px;
    box-sizing: border-box;
    text-align: right; /* Aligne le contenu textuel du bloc à droite */
    font-size: 14px;
    z-index: 1; /* Assure que le texte soit au-dessus de l'image */
}

/* Style pour les titres dans le texte */
.texte-texte h1 {
    color: #FFD700;
    margin: 5px 0;
    font-size: 18px;
    font-weight: bold;
    text-align: right; /* Aligne le titre à droite */
}

/* Style du bouton "Voir plus" */
.btn-btn {
    background: linear-gradient(to right, #2575fc, #6a11cb);
    color: #fff;
    font-weight: bold;
    font-size: 1rem;
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 30px;
    margin: 15px 0;
    display: inline-block;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transition: background-color 0.3s ease, transform 0.3s ease;
}


.btn-btn i {
    margin-right: 8px; /* Espacement entre l'icône et le texte */
}




/* Effet au survol du bouton */
.btn-btn:hover {
    background-color: #0056b3;
}

</style>

<style>


        /* Style pour le conteneur de grille */
        .produits-container2 {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 colonnes */
            gap: 20px; /* Espacement augmenté entre les éléments */
            padding: 20px;
            background-color: #f9f9f9;
        }

        .produit-produit2 {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        

        .produit-image-image2 {
            width: 100%;
            height: 220px; /* Hauteur ajustée pour une meilleure présentation */
            object-fit: cover;
            margin-bottom: 10px; /* Marge réduite entre l'image et le texte */
            border-radius: 8px;
        }


        /* Adaptation mobile */
        @media (max-width: 768px) {
            .produits-container {
                grid-template-columns: repeat(2, 1fr); /* 2 colonnes sur mobile */
            }
        }

        @media (max-width: 480px) {
            .produits-container {
                grid-template-columns: 1fr; /* 1 colonne sur petit écran */
            }
        }
    </style>

<style>
        /* Conteneur des animations  fete feux artifices */
        #celebration-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none; /* Les animations ne bloqueront pas les interactions avec la page */
            z-index: 9999;
            overflow: hidden;
        }

        /* Style des confettis (flocons de neige, cadeaux ou autres objets de Noël) */
        .confetti {
            position: absolute;
            top: -10%;
            width: 30px;
            height: 30px;
            font-size: 30px;  /* Taille de l'icône */
            animation: fall 4s ease-in infinite;
            color: #ff0000; /* Couleur rouge de Noël */
        }

        /* Animation de chute des objets */
        @keyframes fall {
            0% {
                top: -10%;
                opacity: 1;
            }
            100% {
                top: 100%;
                opacity: 0;
            }
        }

        /* Variations pour chaque icône de confetti */
        .confetti:nth-child(1) {
            left: 10%;
            animation-duration: 3s;
            animation-delay: 0s;
            color: #008000; /* Vert pour un sapin de Noël */
        }

        .confetti:nth-child(2) {
            left: 20%;
            animation-duration: 3.5s;
            animation-delay: 1s;
            color: #ff0000; /* Rouge pour un cadeau */
        }

        .confetti:nth-child(3) {
            left: 30%;
            animation-duration: 4s;
            animation-delay: 2s;
            color: #ffff00; /* Or pour une étoile */
        }

        .confetti:nth-child(4) {
            left: 40%;
            animation-duration: 3.2s;
            animation-delay: 1.5s;
            color: #0000ff; /* Bleu pour des cloches */
        }
    </style>

<style>
        
        .icon-delivery {
            margin-left: 8px;
            color:yellowgreen; /* Couleur verte pour le symbole icon voiture livraison*/
        }
        .icon-delivery {
            margin-left: 8px;
            color: #28a745; /* Couleur verte pour le symbole  icon voiture livraison*/
        }
    </style>
<style>
        body { font-family: 'Roboto', sans-serif; background-color: #f8f9fa; }
        .search-container { margin: 20px auto; max-width: 600px; }
        .produit-image { max-width: 150px; border-radius: 5px; }
        .btn-acheter { background-color: #28a745; color: white; border-radius: 5px; }
    </style>

<style>

.search-container {
  position: relative;
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
}

#searchInput {
  width: 100%;
  padding-right: 40px; /* Pour éviter que le texte chevauche l'icône */
}

.search-icon {
  position: absolute;
  top: 50%;
  right: 15px;
  transform: translateY(-50%);
  color: #007BFF; /* Couleur bleue */
  font-size: 1.2em;
}

</style>

<style>

/*  Créer et afficher un message stylisé lorsque aucun produit n'est trouvé durant le recherche dynamique de produit */

.alert-warning {
    background-color:rgb(255, 223, 205); 
    border-color: #ffeeba; 
    color: #856404;
    padding: 15px;
    margin: 20px 0;
    border-radius: 5px;
    font-size: 18px;
    font-weight: bold;
}

</style>
</head>
<body>

<script src="site-web-commerce/code_sur_acceuil.js"></script>

    <!-- declancheemnt des feux artifices de fete -->
<div id="celebration-container"></div>

<header class="header">
    <div class="logo">
    <img src="image/logo meuble.png" alt="Logo de Abiga" class="logo-image"> <!-- Logo personnalisé -->
       </div>
        <div class="marquee">
        <span>Livraison gratuite pour toute commande supérieure à 200 € !<i class="fas fa-shipping-fast icon-delivery"></i></span>
    </div>
   
    <nav>
        <a href="#">Accueil</a>
        <a href="#" id="services-link">Services</a>
        <a href="#" id="boutique-link">Boutique</a>
        <a href="#" id="category-link">Category</a>
        <a href="connexion.php">Connexion</a> <!-- Lien vers la page de connexion -->
        
    </nav>
</header>


<!-- Texte animé de bienvenue -->
<div id="popup" class="popup">
    <button class="close-btn" id="close-popup">&times;</button>
    <div class="popup-content">
        <button onclick="alert('Bouton Cuisine sélectionné')">
            <img src="image/cuisine.jpg" alt="Icone Cuisine" class="button-icon">
         <h5 class="cuisine">Votre cuisine </h5>
        </button>
        <button onclick="alert('Salon sélectionné')">
            <img src="image/salonn.jpg" alt="Icone Salon" class="button-icon">
            <h5>Votre Salon</h5>
        </button>
        <button onclick="alert('Toilette sélectionnée')">
            <img src="image/toilette.jpg" alt="Icone Toilette" class="button-icon">
            <h5>Votre Toilette</h5>
        </button>
        <button onclick="alert('Jardin sélectionné')">
            <img src="image/jardin.jpg" alt="Icone Jardin" class="button-icon">
            <h5>Votre Jardin</h5>
        </button>
        <button onclick="alert('Chambre sélectionnée')">
            <img src="path/to/your-image6.jpg" alt="Icone Chambre" class="button-icon">
            <h5>Chambre</h5>
        </button>
    </div>
</div>


<div class="cover-image">
        <img src="image/font.png" alt="Image de couverture">
        <div class="overlay"></div>
        <div class="text">Votre Expert en Mobilier de Qualité

        <br><h1>Bienvenue chez Abiga</h1>

<p>Chez Abiga, nous vous offrons une sélection unique de meubles alliant </p> <p>design,confort et durabilité.</p>

<p>Des meubles conçus pour embellir chaque coin de votre maison.</p>
</div>

    </div>
        

    <h1 id="welcome-message" class="animated-text"></h1>
</header>



<div id="services" class="content-glissant" style="display: none;">
    <h2>Nos Services</h2>
    <p>Découvrez nos services exclusifs conçus pour répondre à tous vos besoins. Nous offrons une large gamme de solutions adaptées à vos exigences.</p>
    <div class="images-container">
   
        <img src="image/carte visa.jpg" alt="Service 1">
       
        <img src="image/livreur.jpg" alt="Service 1">
      
        <img src="image/monteur.jpg" alt="Service 3">
        <img src="image/allo.jpg" alt="Service 3">
       
    </div>
</div>

<!-- Section Boutique -->
<div id="boutique" class="content-glissant" style="display: none;">
    <h2>Notre Boutique</h2>
    <p>Explorez notre boutique avec des produits de qualité soigneusement sélectionnés pour vous.</p>
    <div class="images-container">
        <img src="image/product1.jpg" alt="Produit 1">
        <img src="image/product2.jpg" alt="Produit 2">
    </div>
</div>



<script>

     // les clics a coté du pupup ou conteneur pour quitter directement le pupup ou conteneur 

    // Sélection des éléments pour la section Services
    const services = document.getElementById('services');
    const servicesLink = document.getElementById('services-link');

    // Afficher ou cacher la section "Services" lorsque l'on clique sur le lien "Services"
    servicesLink.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        if (services.style.display === 'none' || services.style.display === '') {
            services.style.display = 'block'; // Affiche la section Services
        } else {
            services.style.display = 'none'; // Cache la section Services
        }
    });

    // Fermer la section "Services" en cliquant en dehors du conteneur, sans affecter les autres éléments
    document.addEventListener('click', (event) => {
        // Vérifie si le clic est à l'intérieur de la section Services ou sur le lien de la section Services
        const isClickInsideServices = services.contains(event.target) || servicesLink.contains(event.target);
        if (!isClickInsideServices) {
            services.style.display = 'none'; // Cache la section Services si le clic est en dehors
        }
    });

    // Sélection des éléments pour la boutique
    const boutique = document.getElementById('boutique');
    const boutiqueLink = document.getElementById('boutique-link');

    // Afficher ou cacher la section "Boutique" lorsque l'on clique sur le lien "Boutique"
    boutiqueLink.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        if (boutique.style.display === 'none' || boutique.style.display === '') {
            boutique.style.display = 'block'; // Affiche la boutique
        } else {
            boutique.style.display = 'none'; // Cache la boutique
        }
    });

    // Fermer la section "Boutique" en cliquant en dehors du conteneur, sans affecter les autres éléments
    document.addEventListener('click', (event) => {
        // Vérifie si le clic est à l'intérieur de la boutique ou sur le lien de la boutique
        const isClickInsideBoutique = boutique.contains(event.target) || boutiqueLink.contains(event.target);
        if (!isClickInsideBoutique) {
            boutique.style.display = 'none'; // Cache la boutique si le clic est en dehors
        }
    });

    // Sélection des éléments pour le popup
    const categoryLink = document.getElementById('category-link');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('close-popup');

    // Ouvrir le popup en cliquant sur le lien "category-link"
    categoryLink.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        popup.classList.add('active'); // Ajoute la classe active pour afficher le popup
    });

    // Fermer le popup avec le bouton
    closePopup.addEventListener('click', () => {
        popup.classList.remove('active'); // Supprime la classe active pour cacher le popup
    });

    // Fermer le popup en cliquant en dehors
    document.addEventListener('click', (e) => {
        // Vérifie si le clic est à l'extérieur du popup et de son lien
        const isClickInsidePopup = popup.contains(e.target) || categoryLink.contains(e.target);
        if (!isClickInsidePopup && popup.classList.contains('active')) {
            popup.classList.remove('active'); // Ferme le popup si on clique en dehors
        }
    });
</script>


 
<script>


    
</script>



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



<?php
// Exemple de données simulées provenant d'une base de données
$produit = [
    'nom' => "<script>alert('XSS!');</script>Produit dangereux",
    'description' => "Description avec des <b>balises HTML</b> et 'guillemets'."
];

?>

<!-- Flèches de navigation -->
<div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <!-- Pagination -->
    <div class="swiper-pagination"></div>


   <!-- contenaire swiper et code de recherche dynamique des produits -->

    <div class="swiper-container">
    <img src="image/couvertur2.webp" alt="Meuble 2" style="filter: brightness(1.2) contrast(1.1);">

    <h2 style="font-family: 'Arial', sans-serif; color: #007BFF; 
    font-size: 36px; font-weight: bold; text-align: center;
    margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px;">
        Accédez à une large gamme de produits.
    </h2>

    <h6 style="font-family: 'Arial', sans-serif; color: #555;
     font-size: 18px; font-weight: normal; text-align: center;
      margin-top: 10px; font-style: italic; letter-spacing: 1px;">
        Articles de qualité de notre boutique. </h6>
        <form method="GET" action="">

        <!-- recherche dynamique pour produits dans html et php -->

        <br><div class="search-container">
  <input type="text" id="searchInput" class="form-control pl-4" placeholder="Recherchez des produits..." />
  <i class="fas fa-search search-icon"></i>
</div><br>
        </form>
   

    <div class="swiper-wrapper" id="productResults">
        <?php
        $produits = $produits ?? []; // Si $produits est indéfini, le remplacer par un tableau vide.
        foreach ($produits as $produit): ?>
            <div class="swiper-slide">

                <div class="produit">
                    <img src="images/<?php echo htmlspecialchars($produit['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($produit['nom'], ENT_QUOTES, 'UTF-8'); ?>" class="produit-image" loading="lazy">
                    <h2><?php echo htmlspecialchars($produit['nom'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p><?php echo htmlspecialchars($produit['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="prix"><strong>Prix :</strong> <?php echo number_format($produit['prix'], 2, ',', ' ') . ' €'; ?></p>
                    <a href="ajouter_au_panier.php?id=<?php echo $produit['id']; ?>" class="btn-acheter">
                        <i class="fas fa-shopping-cart"></i> Acheter directement
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
// javascript pour le recheche dynamique des produits avec saisi uniquement au texte dans un imput
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 40,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

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
                            <div class="produit">
                                <img src="images/${produit.image}" alt="${produit.nom}" class="produit-image">
                                <h5>${produit.nom}</h5>
                                <p>${produit.description}</p>
                                <p class="text-primary"><strong>${parseFloat(produit.prix).toFixed(2)} €</strong></p>
                                <a href="ajouter_au_panier.php?id=${produit.id}" class="btn btn-acheter">
                                    <i class="fas fa-shopping-cart"></i> Acheter directement
                                </a>
                            </div>
                        `;
                        container.appendChild(slide);
                    });
                    swiper.update(); // Mettre à jour Swiper
                } else {
              // Créer et afficher un message stylisé lorsque aucun produit n'est trouvé
              const noProductMessage = document.createElement('div');
                noProductMessage.className = 'alert alert-warning text-center';
                noProductMessage.innerHTML = '<strong>Aucun produit trouvé.</strong>';
                
                container.appendChild(noProductMessage); // Ajouter le message au conteneur
            }
            })
            .catch(error => console.error('Erreur :', error));
    });
</script>
  

 
  <!--  // produit non trouver fermer ici  pour recherche
    ?>
        -->
     

<!-- Section avec 3 images affichées horizontalement -->
<div class="image-galerie">

<div class="image-container">
    <img src="image/canape1.jpg" alt="Meuble 2" style="filter: brightness(1.2) contrast(1.1);">

        <div class="texte-texte-image">
        <h3>Abiga</h3>
           <p>Le Confort à l'Honneur avec Nos Salons</p>
            
            <a href="#" class="btn-btn"><i class="fas fa-arrow-right"></i>Voir plus</a>
        </div>
    </div>

    <div class="image-container">
    <img src="image/salle manger.jpg" alt="Meuble 2" style="filter: brightness(1.2) contrast(1.1);">

        <div class="texte-texte-image">
        <h3>Abiga</h3>
            <p>   Salle à Manger, Élégance et Convivialité</p>
          
            <a href="#" class="btn-btn"><i class="fas fa-arrow-right"></i>Voir plus </a>
        </div>
    </div>
    <div class="image-container">
    <img src="image/lit chambre.jpg" alt="Meuble 2" style="filter: brightness(1.2) contrast(1.1);">

        <div class="texte-texte-image">
        <h3>Abiga</h3>
            <p>Mobilier de Chambre Élégance et Confort</p>
    
            
            <a href="#" class="btn-btn"><i class="fas fa-arrow-right"></i>Voir plus</a>
        </div>
    </div>


</div>
   <!-- image deux en bas prouits -->
   <div class="produits-container2">
        <?php foreach ($produits as $produit): ?>
            <div class="produit-produit2">
                <img src="images/<?php echo htmlspecialchars($produit['image'], ENT_QUOTES, 'UTF-8'); ?>" 
                     alt="<?php echo htmlspecialchars($produit['nom'], ENT_QUOTES, 'UTF-8'); ?>" 
                     class="produit-image-image2" 
                     loading="lazy">
                <h2><?php echo htmlspecialchars($produit['nom'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p><?php echo htmlspecialchars($produit['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="prix"><?php echo number_format($produit['prix'], 2, ',', ' ') . ' €'; ?></p>
                <a href="ajouter_au_panier.php?id=<?php echo $produit['id']; ?>" class="btn-acheter" ><i class="fas fa-shopping-cart"></i>Acheter directement</a>
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
        // Affiche la popup si elle existe
        window.onload = function() {
            const popup-pupup = document.getElementById('resultPopup');
            if (popup-pupup) {
                popup-pupup.classList.add('show');
            }
        };
    </script>

<script>

document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 1, // Nombre de produits affichés simultanément
        spaceBetween: 20, // Espace entre les slides
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        breakpoints: {
            480: {
                slidesPerView: 1, // Un produit visible pour les petits écrans
            },
            768: {
                slidesPerView: 2, // Deux produits visibles pour les écrans moyens
            },
            1024: {
                slidesPerView: 4, // Quatre produits visibles pour les écrans larges
            }
        }
        // La pagination n'est pas activée ici.
    });
});


/*document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 1, // Nombre de produits affichés simultanément
        spaceBetween: 20, // Espace entre les slides
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        breakpoints: {
            480: {
                slidesPerView: 1, // Un produit visible pour les petits écrans
                pagination: false, // Désactive complètement la pagination
            },
            768: {
                slidesPerView: 2, // Deux produits visibles pour les écrans moyens
                pagination: false, // Désactive complètement la pagination
            },
            1024: {
                slidesPerView: 4, // Quatre produits visibles pour les écrans larges
                pagination: false, // Désactive complètement la pagination
            }
        },
        pagination: false, // Désactive complètement la pagination
    });
});*/


</script>


<script>

let lastScrollTop = 0; // Dernière position du scroll
const arrows = document.querySelectorAll('.swiper-button-next, .swiper-button-prev'); // Sélection des flèches

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop; // Position actuelle du scroll

    if (scrollTop > lastScrollTop) {
        // Si on défile vers le bas, cacher les flèches
        arrows.forEach(arrow => {
            arrow.classList.add('hide-arrow');
        });
    } else {
        // Si on défile vers le haut, afficher les flèches
        arrows.forEach(arrow => {
            arrow.classList.remove('hide-arrow');
        });
    }
    
    // Mise à jour de la dernière position de scroll
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});



</script>


<script>
    // Générer des confettis de façon aléatoire pour la fete de fin année
    function createConfetti() {
        const container = document.getElementById('celebration-container');
        const confetti = document.createElement('div');
        confetti.classList.add('confetti');

        // Choisir une icône aléatoire pour chaque confetti
        const icons = ['<i class="fas fa-tree"></i>', '<i class="fas fa-gift"></i>', '<i class="fas fa-star"></i>', '<i class="fas fa-bell"></i>'];
        const randomIcon = icons[Math.floor(Math.random() * icons.length)];
        confetti.innerHTML = randomIcon;

        // Position aléatoire de départ
        confetti.style.left = `${Math.random() * 100}%`;

        // Ajouter le confetti au conteneur
        container.appendChild(confetti);

        // Supprimer le confetti après l'animation
        setTimeout(() => {
            confetti.remove();
        }, 4000);  // Correspond à la durée de l'animation
    }

    // Créer des confettis toutes les 200ms
    setInterval(createConfetti, 200);
</script>




</body>
</html>
