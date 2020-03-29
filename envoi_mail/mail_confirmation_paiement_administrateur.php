<?php
@$nom = $_GET['nom'];
@$prenom = $_GET['prenom'];
@$nom_produit = $_GET['nomproduit'];
@$adresse_mail = $_GET['adresse_mail'];
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
    <h1>Demande de validation </h1>
    <p>Bonjour <?php echo  @$prenom . " " . @$nom ?>,</p>



    <p> Le client a procédé à un paiement pour une location dont le numéro de facture est : <?php echo $num_facture ?>
    </p>

    <p>Attention ! ne pas oublier :</p><br>

    <p>prendre contact avec la cliente pour fixer un RDV. Adresse mail du client : <?php echo $adresse_mail ?></p>

    <p>Lien sur le site de location : </p><a href="www.mtevent44.fr">www.mtevent44.fr</a>
    <br>
    <img class="" src="https://www.mtevent44.fr/images/logo/logo_mail.jpg">

</body>

</html>