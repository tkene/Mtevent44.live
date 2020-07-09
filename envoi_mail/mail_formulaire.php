<?php
@$nom = $_GET['nom'];
@$prenom = $_GET['prenom'];
@$mail_visiteur = urldecode($_GET['mail_visiteur']);
@$tel = urldecode($_GET['tel']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Validation inscription </h1>
    <p>Bonjour <?php echo  @$prenom . " " . @$nom ?></p>

    <p>Merci pour ton inscription.</p>
    <p>Nous te souhaitons la bienvenue sur notre site.<br>
        Tu trouveras ci-dessous tes différentes informations :</p>
    <br>
    <p>Nom : <?php echo $nom ?></p>
    <br>
    <p>Prénom : <?php echo $prenom ?></p>
    <br>
    <p>Tel : <?php echo $tel ?></p>
    <br>
    <p>Mail_visiteur : <?php echo $mail_visiteur ?></p>
    <br>
    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.MTevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">





</body>

</html>