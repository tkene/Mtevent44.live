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

    <p>On te remercie pour ta commande , nous revenons vers toi dans les 24h à 48h pour fixer une date.<br><br>Tu
        pourras venir récupérer ton ou t'es produits 48heures avant la date
        prévue.<br><br> Retrouve ci-joint ton numéro de facture : <?php echo $num_facture ?>.<br>(Pour imprimer la
        facture
        retourne sur le site et connecte toi pour te rendre à la rubrique mes commandes).<br>Pour rappel voiçi notre
        adresse
        de contact Mtevenement44@gmail.com.</p>
    <br>
    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.mtevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">


    </p>


</body>

</html>