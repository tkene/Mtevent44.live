<?php
ob_start();
//include "fonction.php";

@$nom = urlencode($_GET['nom']);
@$prenom = urlencode($_GET['prenom']);
@$id_user = $_GET['id_user'];
@$num_facture = urlencode($_GET['num_facture']);
@$adresse_mail = $_GET['adresse_mail'];
// @$pass_hash =  cryptage($recup_id);
//var_dump($id_user);



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';



$mail = new PHPmailer(true);
$mail->CharSet = 'UTF-8';

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;  //(permet de voir le bug)

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

$mail->Subject = "Paiement confirmé";


//file_get_contents -> permet d'aller chercher les informations dans la page dédié
$mail->msgHTML(file_get_contents('https://www.mtevent44.fr/envoi_mail/mail_confirmation_paiement_administrateur.php?prenom=' . $prenom . '&nom=' . $nom . '&nomproduit=' . $nom_produit . '&adresse_mail=' . $adresse_mail . '&num_facture=' . $num_facture));

$mail->AltBody = 'Cordialement';


if (!$mail->send()) {
    echo 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Le message a bien été envoyé !';
    header('location:../accueil_et_pages_reponse/confirmation_paiement.php?id=' . $id_user . '&num_facture=' . $num_facture);
    ob_end_flush();
    exit();
}