<?php
@$recup_id = $_GET['id'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <h1>Modification mot de passe. </h1>
    <p>Bonjour, </p>

    <p>Nous avons bien reçu ta demande de changement de mot de passe.</p>
    <br>
    <p>Si le lien ne te concerne pas directement merci de ne pas prendre en compte ce mail et de le supprimer.</p>
    <br>
    <p>Si tu es bien à l'origine de cette demande, nous t'invitons à te connecter via le lien suivant :</p>

    <p><a href="https://www.mtevent44.fr/clients/mot_passe_oublie_partie2.php?id=<?php echo $recup_id ?>">ici </a> </p>
    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.MTevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">





</body>

</html>