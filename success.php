
<?php
require 'stripe_config.php';


require 'config.php';
require 'vendor/autoload.php';



// Récupérer l'ID de session depuis l'URL
$session_id = $_GET['session_id'];

if (!$session_id) {
    die("Session ID manquant !");
}

// Récupérer les informations de la session Stripe
try {
    $session = \Stripe\Checkout\Session::retrieve($session_id);
    $payment_intent_id = $session->payment_intent;

    // Récupérer les détails du paiement
    $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
    $email_client = $session->customer_details->email;
    $montant = $session->amount_total / 100; // Montant en euros
    $statut = $payment_intent->status; // Ex: "succeeded"

    // Insérer dans la base de données
    $sql = "INSERT INTO paiements (order_id, email, montant, statut) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$session_id, $email_client, $montant, $statut]);

    echo "Merci pour votre achat !<br>";
    echo "Votre paiement a été effectué avec succès.<br>";
    echo "Numéro de commande : <strong>$session_id</strong><br>";
} catch (\Exception $e) {
    echo "Erreur lors de la récupération des informations de paiement : " . $e->getMessage();
}
?>

