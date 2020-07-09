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

    <p>Nous te confirmons la disponibilitée de ton produit :<?php echo $nom_produit ?></p>

    <p>Nous t'invitons à finaliser ta commande au plus vite pour que ta réservation puisse être prise en compte.
        Nous restons à ta disposition pour toutes questions concernant la suite de ta réservation.</p>
    <br>
    <p>N'hésite à compléter ta commande avec nos autres articles. </p><a href="www.mtevent44.fr">www.MTevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">


</body>

</html>