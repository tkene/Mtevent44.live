<?php
@$nom = $_GET['nom'];
@$prenom = $_GET['prenom'];
@$nom_produit = $_GET['nomproduit'];


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
    <p>Bonjour</p> <?php echo  @$prenom . " " . @$nom ?>

    <p>Nous te confirmons la disponnibilitée de ton produit :<?php echo $nom_produit ?></p>

    <p>On t'invite à finaliser ta commande au plus vite, cela permet de reserver sur notre site.Nous restont à
        ta disposition pour toutes questions concernant la suite de la réservation.</p>
    <br>
    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.mtevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">


</body>

</html>