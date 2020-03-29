<?php

@$nom = $_GET['nom'];
@$prenom = $_GET['prenom'];
@$adresse_mail = $_GET['mail'];
@$text_message_client = $_GET['text_message_client'];
@$id_user1 = $_GET['id_user1'];




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';



$mail = new PHPmailer(true);
$mail->CharSet = 'UTF-8';

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // (permet de voir le bug)

// $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
// $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
// $mail->SMTPAuth = true; // Activer authentication SMTP
// $mail->Username = 'mtevenement44@gmail.com'; // Votre adresse email d'envoi
// $mail->Password = 'Maevatuan1404'; // Le mot de passe de cette adresse email
// $mail->SMTPSecure = 'ssl'; // Accepter SSL
// $mail->Port = 465;

$mail->setFrom('mtevenement44@gmail.com', 'Mailer'); // Personnaliser l'envoyeur
$mail->addAddress($adresse_mail, 'User'); // Ajouter le destinataire
// $mail->addAddress('To2@example.com');
// $mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
//$mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = "Message de Mtevenement";
$mail->Body = $text_message_client;
$mail->AltBody = 'Cordialement.';







if (!$mail->send()) {
    $erreur = 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $retour_mail = 'Le message a bien été envoyé !';
    header('location:../admin/admin_compte_client.php?id_user1=' . $id_user1 . '&msg=true');
    exit();
}