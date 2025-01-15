<?php
// Le message que vous souhaitez afficher
$message = "Aucun produit trouvé avec ces critères.";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit Non Trouvé</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script>
        // Fonction de redirection après 5 secondes
        setTimeout(function() {
            window.location.href = 'code_sur_acceuil.php';
        }, 5000); // 5000 ms = 5 secondes
    </script>
</head>

<style>
/* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f1f5f8;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

.message-container {
    text-align: center;
    background-color: #ffffff;
    border-radius: 12px;
    padding: 40px 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 100%;
    transition: transform 0.3s ease, opacity 0.3s ease;
    opacity: 1;
    animation: fadeIn 1s ease-in-out; /* Animation d'apparition */
}

/* Animation d'apparition */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

.message-container i {
    font-size: 80px;
    color: #ff4747;
    margin-bottom: 20px;
    animation: bounce 1s ease infinite;
}

/* Animation de rebond pour l'icône */
@keyframes bounce {
    0%, 20%, 40%, 60%, 80%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-15px);
    }
}

.message-container h1 {
    font-size: 2rem;
    color: #ff4747; /* Couleur rouge pour attirer l'attention */
    margin-top: 15px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase; /* Mettre en majuscules pour accentuer l'importance */
    animation: highlight 1.5s alternate infinite; /* Animation de surbrillance */
}

/* Animation de surbrillance */
@keyframes highlight {
    0% { color: #ff4747; }
    50% { color: #ff8c00; }
    100% { color: #ff4747; }
}

.message-container p {
    color: #666;
    margin-top: 12px;
    font-size: 1.2rem;
    line-height: 1.6;
    letter-spacing: 0.5px;
    font-weight: 500;
    animation: fadeInText 2s ease-out; /* Animation du texte */
}

/* Animation du texte */
@keyframes fadeInText {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

/* Le bouton de retour est maintenant caché, il n'est plus nécessaire */
.btn-return {
    display: none;
}

</style>

<body>
    <div class="message-container">
        <i class="fas fa-sad-tear"></i> <!-- Icône triste -->
        <h1><?php echo htmlspecialchars($message); ?></h1>
        <p>Nous n'avons pas trouvé de produits correspondant à votre recherche. Vous serez redirigé automatiquement dans quelques secondes.</p>
        <!-- Le bouton de retour est supprimé, car la redirection est automatique -->
    </div>
</body>
</html>
