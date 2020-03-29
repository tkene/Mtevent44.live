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

    <p>Tu nous a fais une demande de changement mot de passe.</p>
    <br>
    <p>Si le lien ne te concerne pas directement merci de ne pas prendre en compte ce mail et le supprimer.</p>
    <br>
    <p>Sinon nous t'invitons à te connecter via le lien suivant :</p>
    <br>
    <p>https://www.mtevent44.fr/clients/mot_passe_oublie_partie2.php?id=<?php echo $recup_id ?> </p>


    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.mtevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">





</body>

</html>