<?php
require 'config.php';
require 'vendor/autoload.php'; // Charger Stripe
require 'stripe_config.php';

// Récupérer l'ID du produit
$product_id = $_GET['id'];

// Récupérer les détails du produit depuis la base de données
$sql = "SELECT * FROM produits WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Créer la session de paiement avec Stripe
$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'product_data' => [
        'name' => $product['nom'],
        'description' => $product['description'],
        
      ],
      'unit_amount' => $product['prix'] * 100, // Montant en centimes
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost/site-web-commerce/success_test.php?session_id={CHECKOUT_SESSION_ID}', // URL après paiement réussi
  'cancel_url' => 'http://votresite.com/cancel.php', // URL après annulation
]);

// Rediriger vers Stripe
header("Location: " . $session->url);
exit();
?>