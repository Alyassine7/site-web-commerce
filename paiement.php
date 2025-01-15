<?php
session_start();
require 'stripe_config.php';

if (empty($_SESSION['panier'])) {
    header('Location: accueil.php');
    exit();
}

// Calcul du total du panier
$total = 0;
$line_items = []; // Initialisation du tableau des line_items

// Créer les line_items à partir du panier
foreach ($_SESSION['panier'] as $item) {
    $line_items[] = [
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => $item['nom'],
            ],
            'unit_amount' => $item['prix'] * 100, // Convertir en centimes
        ],
        'quantity' => $item['quantite'],
    ];
    $total += $item['prix'] * $item['quantite'];
}

// Créer une session de paiement Stripe
$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => $line_items, // Utiliser le tableau des line_items
    'mode' => 'payment',
    // Utiliser une URL absolue pour success_url et cancel_url
    'success_url' => 'http://localhost/site-web/success.php?session_id={CHECKOUT_SESSION_ID}',  // URL complète pour succès
    'cancel_url' => 'http://localhost/site-web/panier.php',  // URL complète pour annulation
]);

// Rediriger vers Stripe Checkout
header("Location: " . $session->url);
exit();
?>
