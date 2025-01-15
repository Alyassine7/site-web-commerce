<?php
require 'stripe_config.php';
require 'config.php';
require 'vendor/autoload.php'; // Inclure Stripe et PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Récupérer l'ID de session depuis l'URL
$session_id = filter_input(INPUT_GET, 'session_id', FILTER_SANITIZE_STRING);

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
   // $nom = $session->nam; // Montant en euros
    $statut = $payment_intent->status; // Ex: "succeeded"

    // Insérer dans la base de données
    $sql = "INSERT INTO paiements (order_id, email, montant, statut) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$session_id, $email_client, $montant, $statut]);

    // Affichage du message avec style moderne
    echo "
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Confirmation de paiement</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f7fa;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                padding: 30px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .header {
                font-size: 28px;
                font-weight: bold;
                color: #2d87f0;
            }
            .message {
                font-size: 18px;
                margin: 20px 0;
                color: #555;
            }
            .highlight {
                color: #2d87f0;
                font-weight: bold;
            }
            .success-icon {
                font-size: 50px;
                color: #28a745;
                margin-bottom: 20px;
            }
            .footer {
                font-size: 14px;
                color: #777;
                margin-top: 20px;
            }
            .btn {
                display: inline-block;
                padding: 12px 30px;
                background-color: #2d87f0;
                color: white;
                border-radius: 5px;
                text-decoration: none;
                font-size: 16px;
                margin-top: 20px;
            }
            .btn:hover {
                background-color: #1f65c0;
            }
                h6 {
    font-size: 0.9rem; /* Ajustez la taille selon vos besoins */
    color:red; /* Couleur discrète */
    margin-top: 10px;
    margin-bottom: 10px;
    text-align: center; /* Centrer le texte */
}

        </style>
    </head>
    <body>
        <div class='container'>
            <div class='success-icon'>✔</div>
            <div class='header'>Merci pour votre achat !</div>
            <div class='message'>
                Votre paiement d'un montant de <span class='highlight'>{$montant} €</span> a été effectué avec succès.
            </div>
            <div class='message'>
               Numéro de commande : <br><h5><span class='highlight'>{$session_id}</span><h5>
            </div>
            <div class='footer'>
                <p>Nous avons envoyé un e-mail de confirmation à <strong>{$email_client}</strong>.</p>
                <p>Cordialement, <br>L'équipe Abiga</p>
                <a href='/' class='btn'>Retour à l'accueil</a>
            </div>
        </div>
    </body>
    </html>
    ";

    // Envoyer un e-mail de confirmation
    if ($statut === 'succeeded') {
        $mail = new PHPMailer(true);

        try {
            // Configuration SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Utilisez votre hôte SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'alyassian20@gmail.com'; // Votre adresse e-mail
            $mail->Password = 'qsmc zsgg sixl udzz'; // Votre mot de passe généré
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Expéditeur et destinataire
            $mail->setFrom('alyassian20@gmail.com', 'Abiga'); // Expéditeur
            $mail->addAddress($email_client); // Destinataire

            // Contenu de l'e-mail
            $mail->isHTML(true);

            $mail->Subject = 'Merci pour votre achat chez Abiga !';
            $mail->Body = "
                <div style=\"font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; color: #333;\">
                    <div style=\"max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);\">
                        <h2 style=\"color: #007BFF; text-align: center;\">Merci pour votre achat !</h2>
                        <p style=\"font-size: 16px; line-height: 1.6;\">Bonjour,</p>
                        <p style=\"font-size: 16px; line-height: 1.6;\">Merci pour votre achat sur <strong>Abiga.com</strong>.</p>
                        <p style=\"font-size: 16px; line-height: 1.6;\">
                            Votre commande d'un montant de 
                            <strong><span style=\"color: #007BFF; font-size: 18px;\">{$montant} €</span></strong> 
                            a été validée avec succès.
                        </p>
                        <p style=\"font-size: 16px; line-height: 1.6;\">Votre livraison est en cours.</p>
            
                        <div style=\"text-align: center; margin-top: 20px;\">
                            <img src=\"https://as2.ftcdn.net/v2/jpg/00/70/74/59/1000_F_70745926_5EoLxo3YhZWV7loNcSl8MVxib7SiNmHJ.jpg\" style=\"width: 150px; height: auto; margin-top: 10px; border-radius: 8px;\">
                        </div>
            
                        <div style=\"text-align: center; margin-top: 20px;\">
                            <img src=\"https://www.zarla.com/images/zarla-ergo-meubles-1x1-2400x2400-20211013-dmhrt34gmktw6fxj8vmw.png?crop=1:1,smart&width=250&dpr=2\" alt=\"Logo Abiga\" style=\"width: 75px; height: center; margin-top: 10px; border-radius: 8px;\">
                        </div>
            
                        <div style=\"margin-top: 30px; text-align: center;\">
                            <p style=\"font-size: 16px; line-height: 1.6; color: #4CAF50;\">
                                <span style=\"color: blue;\">Cordialement,</span><br>
                                <strong>L'équipe Abiga</strong>
                            </p>
                        </div>
                    </div>
                </div>
            ";
            
            
            
            
            

            // Envoyer l'e-mail
            if ($mail->send()) {
                echo "<h6>Un e-mail de confirmation a été envoyé à <strong>$email_client</strong>.</h6>";

            } else {
                echo "Erreur lors de l'envoi de l'e-mail.<br>";
            }
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}<br>";
        }
    }
} catch (\Exception $e) {
    echo "Erreur lors de la récupération des informations de paiement : " . $e->getMessage();
}
?>
