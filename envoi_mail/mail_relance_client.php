<?php
@$prenom = $_GET['prenom'];
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
    <h1>Relance de réservation</h1>
    <p>Bonjour <?php echo $prenom ?>, </p>
    <br>
    <p>Tu nous a fais une réservation pour le produit :<?php echo $nom_produit ?>.</p>
    <br>
    <p>Malheureusement nous n'avons pas de nouvelle. Si tu souhaites réserver la date, nous t'invitons à finaliser ta
        commande, sans nouvelle de ta part dans les 48heures nous devrons supprimer ta demande de nos réservations.
        (Mais pas d'inquiétude si ton produit est encore disponnible tu pourras à nouveau le réserver à la même
        date)<br><br> Nous espérons te revoir rapidement sur notre site <a>wwww.MTevent44.fr</a></p>
    <br>

    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.mtevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">

</body>

</html>