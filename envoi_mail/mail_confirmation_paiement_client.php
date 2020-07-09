<?php
@$nom = $_GET['nom'];
@$prenom = $_GET['prenom'];
@$num_facture = $_GET['num_facture'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Confirmation paiement au client</h1>

    <p>Bonjour</p> <?php echo  @$prenom . " " . @$nom ?>

    <p>Nous te remercions pour ta commande.
        Nous revenons vers toi d'ici 24h à 48h pour fixer une date de rendez-vous pour l'enlèvement de tes
        produits.<br><br>
        Nous prévoyons généralement ce rendez-vous 48h avant la date de ton événement.<br><br>
        Retrouve ci-joint ton numéro de facture : <?php echo $num_facture ?>.<br>(Pour imprimer la
        facture
        retourne sur le site et connecte toi pour te rendre dans la rubrique "mes commandes").<br>Pour rappel voici
        notre adresse de contact Mtevenement44@gmail.com.</p>
    <br><br>
    <p>Bonne organisation et à bientôt sur notre site </p><a href="www.mtevent44.fr">www.MTevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">


    </p>


</body>

</html>