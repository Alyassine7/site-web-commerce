<?php
session_start();
require 'stripe_config.php';
require 'vendor/autoload.php';

if (empty($_SESSION['panier'])) {
    die("Votre panier est vide !");
}

$total = 0;
$line_items = [];

// Construire les articles pour Stripe
foreach ($_SESSION['panier'] as $id => $produit) {
    $line_items[] = [
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => $produit['nom'],
            ],
            'unit_amount' => $produit['prix'] * 100, // Montant en centimes
        ],
        'quantity' => $produit['quantite'],
    ];
    $total += $produit['prix'] * $produit['quantite'];
}

// Créer la session Stripe
$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => $line_items,
    'mode' => 'payment',
    'success_url' => 'http://localhost/site-web/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost/site-web/panier.php',
]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Récapitulatif du Panier</title>
</head>
<body>
    <h1>Récapitulatif de votre Panier</h1>
    <ul>
        <?php foreach ($_SESSION['panier'] as $produit): ?>
            <li>
                <?php echo htmlspecialchars($produit['nom']); ?> -
                <?php echo htmlspecialchars($produit['quantite']); ?> x 
                <?php echo number_format($produit['prix'], 2, ',', ' '); ?> €
            </li>
        <?php endforeach; ?>
    </ul>
    <p><strong>Total :</strong> <?php echo number_format($total, 2, ',', ' '); ?> €</p>
    <a href="<?php echo $session->url; ?>">Passer au Paiement</a>
</body>
</html>
