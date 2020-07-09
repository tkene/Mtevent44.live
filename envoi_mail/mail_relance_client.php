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
    <p>Nous avions reçu une demande de réservation pour le produit :<?php echo $nom_produit ?>.</p>
    <br>
    <p>Malheureusement tu n'as pas été au bout de ta réservation. Si tu souhaites réserver la date, nous t'invitons à
        finaliser ta
        commande au plus vite afin de garantir sa disponibilité à la date souhaitée. Sans nouvelle de ta part sous 48h
        nous devrons supprimer ta demande de réservation.
        Si tu souhaites te positionner après ce délai et que le produit est encore disponible, il faudra seulement que
        tu relances une demande de réservation. <br><br> Nous espérons te revoir rapidement sur notre site
        <a>wwww.MTevent44.fr</a></p>
    <br>

    <p>A bientôt sur notre site </p><a href="www.mtevent44.fr">www.MTevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">

</body>

</html>