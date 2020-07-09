<?php
@$nom = $_GET['nom'];
@$prenom = $_GET['prenom'];
@$mail_visiteur = $_GET['mail_visiteur'];
@$tel = $_GET['tel'];
@$message = $_GET['message'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Message envoyé par client non inscrit</h1>
    <p>Bonjour Maëva, </p>
    <br>
    <p>Coordonnées du client pour être recontacté :</p>
    <br>
    <p>Nom : <?php echo $nom ?></p>
    <br>
    <p>Prénom : <?php echo $prenom ?></p>
    <br>
    <p>Tel : <?php echo $tel ?></p>
    <br>
    <p>Mail : <?php echo $mail_visiteur ?></p>
    <br>
    <p>Message :</p>
    <br>
    <p> <?php echo $message ?></p>
    <br>
    <p>Lien du site d'inscription : <a href="www.mtevent44.fr">www.MTevent44.fr</a></p>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">

</body>

</html>