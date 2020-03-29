<?php

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if (isset($_POST["valider"])) {

    $order = $_POST["order"];
    // $position = $_POST["position"];
    $id_produit = $_POST["id_produit"];

    envoi_order($order, $id_produit);
    $affiche = ("Produit placé");
}
$liste_produit = liste_produit();
//var_dump($liste_produit);
?>

<div class="container mt-5">
    <div class="text-center">
        <?php
        if (isset($affiche)) {
            echo '<font color="green">' . $affiche . '</font>';
        } ?>
    </div>
</div>

<div class="container mt-3">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Dispostion des produits</h1>
</div>
<br>
<p class="text-center">(pour les consignes voir plus bas de la page)</p>

<br>
<div class="container mt-3">




    <div class="row">
        <?php foreach ($liste_produit as $row) { ?>
        <?php if ($row->ref == 1) { ?>
        <?php if ($row->actif == 1) { ?>
        <form action="admin_disposition_produits.php" method="post">
            <div class="col-md-4">
                <div><strong>Produit :</strong> <?php echo $row->nom_produit ?></div>
                <label><strong>Position</strong></label>
                <input type="text" name="order" value="<?php echo $row->ordernum ?>" class="">
                <input type="hidden" name="id_produit" value="<?php echo $row->id_produit ?>">
                <input type="submit" name="valider" class="btn btn-success" value="Valider">
            </div>
            <br>
        </form>
        <?php } ?>
        <?php } ?>
        <?php } ?>
    </div>

</div>
<br>

<div class="container-fluid">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Consigne d'utilisation</h1><br>


    <div class="card" style="width: 18rem;">
        <div class="card-header">
            Le positionnement des produits :
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"> Les produits suit une régle d'affichage : <br>
                Produit 1 / Produit 2 <br>
                pdt 3 / pdt4 / pdt5<br>
                produit 6 / produit 7<br>
                pdt8 / pdt9 / pdt10<br>
                ....</li>
            <li class="list-group-item"> Il suffit donc d'attribuer un chiffre de position à chaque produit.<br>
                *si 2 produits on la même valeur ils se mettront à la suite. Donc ne pas oublier d'attribuer un nombre à
                chaque
                produit.<br></li>
        </ul>
    </div>
    <br>


</div>

<?php include "../footer/footer.php" ?>