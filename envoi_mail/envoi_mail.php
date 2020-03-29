<?php
require "../recaptcha/autoload.php";
@$nom = urlencode($_POST['nom']);
@$prenom = urlencode($_POST['prenom']);
@$message = urlencode($_POST['message']);
@$mail_visiteur = $_POST['mail'];
@$tel = urlencode($_POST['tel']);
@$date_event = urlencode($_POST['date_event']);




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

$mail->setFrom('mtevenement44@gmail.com', 'MTevent44'); // Personnaliser l'envoyeur
$mail->addAddress('mtevenement44@gmail.com', 'User'); // Ajouter le destinataire
// $mail->addAddress('To2@example.com');
// $mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
//$mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = "Date du mariage :" . $date_event;

$mail->msgHTML(file_get_contents('https://www.mtevent44.fr/envoi_mail/mail.php?prenom=' . $prenom . '&nom=' . $nom . '&mail_visiteur=' . $mail_visiteur  . '&tel=' . $tel . '&message=' . $message));

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';






if (isset($_POST['g-recaptcha-response'])) {
    $recaptcha = new \ReCaptcha\ReCaptcha('6LeNlNgUAAAAAKrIS6hmF-CCDsXeIAYLbE8OaPuQ');
    $resp = $recaptcha->verify($_POST['g-recaptcha-response']);

    if ($resp->isSuccess()) {

        if (!$mail->send()) {
            $erreur = 'Erreur, message non envoyé.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $retour_mail = 'Le message a bien été envoyé !';
            header('location:https://www.mtevent44.fr/accueil_et_pages_reponse/reponse_mail.php');
            exit();
        }
    } else {
        $errors = $resp->getErrorCodes();

        //$erreur = 'Captcha non rempli ou incorrect';
        header('location:https://www.mtevent44.fr/accueil_et_pages_reponse/reponse_mail_negative.php');
        exit();
        //var_dump($errors);
    }
} else {

    //$erreur =  'Captcha non rempli';
    //var_dump($erreur);
    header('location:https://www.mtevent44.fr/accueil_et_pages_reponse/reponse_mail_negative.php');
    exit();
}