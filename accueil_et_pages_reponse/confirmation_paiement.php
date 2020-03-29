<?php

include "../connect/connect.php";
include "../fonctions/fonction.php";
include "../header/header.php";
@$id_user = $_GET["id"];
@$num_facture = $_GET['num_facture'];

@$recup_panier = recup_panier($id_user);
//var_dump($recup_panier);
?>

<br>
<div class="container">

    <p class="remerciement">Merci pour votre commande</p>

    <p class="rappel"> Nous prendrons contact avec vous dans les 24h à 48h pour fixer un horaire pour récupérer vos
        produits. Nous restons naturelle à disposition pour toutes questions, merci pour votre confiance. </p>
    <p class="rappel"> Nous vous rappelons que vous pouvez récupérer vos articles 48h avant la date demandée.</p>

    <p class="rappel">Votre numéro de facture : <?php echo $num_facture; ?>
</div>

<p class="rappel"> Vous pouvez retrouver vos articles et imprimer votre facture dans la rubirque <a
        href="../clients/mes_commandes.php">>Mes
        commandes< </a>
</p>
</div> <br>

<?php include "../footer/footer.php" ?>