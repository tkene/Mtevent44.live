<?php

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";

$id_user = $_GET["id"];
$num_facture = $_GET['num_facture'];
$code_promo = $_GET['code_promo'];



$recup_panier = recup_panier($id_user);
//var_dump($recup_panier);
?>
<!----------------------------------------------->
<!--  En tête de la page tunnel de progression -->
<!----------------------------------------------->


<div class="container mt-3" id="gestion_commande_client">
    <div class="row">
        <div class="col-md-4" style="text-align:left">

            <i class="fas fa-shopping-cart fa-3x " style="color:#143054;" alt="panier"></i>

            </b><br><br>
            <span class="step-number">
                <h3>1</h3>
            </span>
            <span class="step-label">Ton panier</span>
        </div>

        <div class="col-md-4" style="text-align:center">
            <i class="fas fa-caret-square-right fa-3x" style="color:#143054;" alt="paiement"></i><br><br>
            <span class="step-number">
                <h3>2</h3>
            </span>
            <span class="step-label">Valider ton panier </span>
        </div>

        <div class="col-md-4" style="text-align:right">
            <i class="fas fa-check fa-3x" style="color:#143054;" alt="paiement validé"></i>
            <br><br>
            <span class="step-number">
                <h3>3</h3>
            </span>
            <span class="step-label"> Paiement validé </span>
        </div>
    </div>
</div>

<br>

<!------------------------------------------------>
<!--------------  Barre de progression ----------->
<!------------------------------------------------>

<div class="container">

    <div class="progress">

        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
            aria-valuemin="0" aria-valuemax="100"></div>

    </div>
</div>
<br><br>
<div class="container">

    <p class="remerciement">Merci pour votre commande</p>

    <p class="rappel"> Nous prendrons contact avec vous dans les 24h à 48h pour fixer un horaire afin de récupérer vos
        produits. Nous restons naturelle à disposition pour toutes questions, merci pour votre confiance. </p>
    <p class="rappel"> Nous vous rappelons que vous pouvez récupérer vos articles 48h avant la date demandée.</p>

    <p class="rappel">Votre numéro de facture : <?php echo $num_facture; ?>


        <p class="rappel"> Vous pouvez retrouver vos articles et imprimer votre facture dans la rubirque <a
                href="../clients/mes_commandes.php">>Mes
                commandes< </a>
        </p> <br><br>
</div>
<?php require "../footer/footer.php" ?>