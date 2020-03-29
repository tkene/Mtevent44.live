<?php

@$nom = urlencode($_GET['nom']);
@$prenom = urlencode($_GET['prenom']);
//@$message = $_POST['message'];
@$mail_visiteur = $_GET['mail'];
@$tel = urlencode($_GET['tel']);
//@$date_event = $_POST['date_event'];




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';



$mail = new PHPmailer(true);
$mail->CharSet = 'UTF-8';

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;  //(permet de voir le bug)

// $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
// $mail->Host = 'SMTP.gmail.com'; // Spécifier le serveur SMTP
// $mail->SMTPAuth = true; // Activer authentication SMTP
// $mail->Username = 'mtevenement44@gmail.com'; // Votre adresse email d'envoi
// $mail->Password = 'Maevatuan1404'; // Le mot de passe de cette adresse email
// $mail->SMTPSecure = 'ssl'; // Accepter SSL
// $mail->Port = 465;

$mail->setFrom('mtevenement44@gmail.com', 'MTevent44'); // Personnaliser l'envoyeur
$mail->addAddress($mail_visiteur, 'Utilisateur'); // Ajouter le destinataire
// $mail->addAddress('To2@example.com');
// $mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
//$mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = "Confirmation inscription";

//file_get_contents -> permet d'aller chercher les informations dans la page dédié
$mail->msgHTML(file_get_contents('https://www.mtevent44.fr/envoi_mail/mail_formulaire.php?prenom=' . $prenom . '&nom=' . $nom . '&mail_visiteur=' . $mail_visiteur . '&tel=' . $tel));


$mail->AltBody = 'A bientôt' . '<br>' . '<img class="logo" src="images/logo/redimensionne/logomt.jpg">';


if (!$mail->send()) {
    echo 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Le message a bien été envoyé !';
    header('location:../accueil_et_pages_reponse/reponse_inscription.php');
    exit();
}