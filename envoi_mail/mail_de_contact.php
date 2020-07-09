<?php
@$nom = $_GET['nom'];
@$prenom = $_GET['pre'];
@$nom_produit = $_GET['nomp'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Demande de validation </h1>
    <p>Bonjour</p> <?php echo  @$nom . " " . @$prenom ?>

    <p>Le client souhaite faire une location pour le produit :<?php echo $nom_produit ?></p>

    <p>Ne pas oublier de valider le panier client pour qu'il puisse payer.</p>
    <br>
    <a href="www.MTevent44.fr">www.MTevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">




</body>

</html>