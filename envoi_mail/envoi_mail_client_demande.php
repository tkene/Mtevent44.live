<?php
ob_start();
require '../connect/connect.php';
require '../connect/crypt.php';


@$nom =  urlencode($_GET['nom']);
@$prenom = urlencode($_GET['prenom']);
@$nom_produit = urlencode($_GET['nom_produit']);
$id_user = $_GET['id_user'];
$var1 = aesEncrypt($id_user);
// @$pass_hash =  cryptage($recup_id);



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
$mail->addAddress('mtevenement44@gmail.com', 'Utilisateur'); // Ajouter le destinataire
// $mail->addAddress('To2@example.com');
// $mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
//$mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

//file_get_contents -> permet d'aller chercher les informations dans la page dédié
$mail->msgHTML(file_get_contents('https://www.mtevent44.fr/envoi_mail/mail_client_demande.php?pre=' . $prenom . '&nom=' . $nom . '&nomp=' . $nom_produit));



$mail->Subject = "Nouvelle Demande de location";
// $mail->Body = "Bonjour <br>Le client : " . $prenom . " " .  $nom . ",<br>Souhaite faire une location pour le produit : " . " " . $nom_produit  . "<br>Ne pas oublier de valider la demande client." . "<a>www.mtevenement44.fr</a>";
// $mail->AltBody = 'A bientôt' . '<br>' . '<img class="logo" src="images/logo/redimensionne/logomt.jpg">';


if (!$mail->send()) {
    echo 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Le message a bien été envoyé !';
    header("location:../clients/panier.php?var1=" . $var1);
    ob_end_flush();
    exit();
}