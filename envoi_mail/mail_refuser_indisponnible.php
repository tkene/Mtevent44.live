<?php
@$prenom = $_GET['prenom'];
@$nom = $_GET['nom'];
@$nom_produit = $_GET['nom_produit'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Produit indisponible </h1>
    <p>Bonjour <?php echo $prenom ?> <?php $nom ?>, </p>
    <br>
    <p>Nous te remercions de l'intérêt porté à notre produit. <br> Mais malheureusement le produit :
        <?php echo $nom_produit ?></p>
    <br>
    <p>n'est plus disponible à la date demandée. Merci de choisir une autre date disponnible ou de prendre contact avec
        notre service client par mail : mtevenement44@gmail.com.</p>
    <br>

    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.mtevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">


</body>

</html>