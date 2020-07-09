<?php

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";


if ($_POST) {

    // recup des posts

    @$recherche = htmlspecialchars($_POST["recherche"]);
    $recherche_input = htmlspecialchars($_POST["recherche_input"]);
}

//var_dump($recherche_input);

if (@$recherche != '') {
    @$affiche_recherche = recherche($recherche);
};
//var_dump(@$affiche_recherche);
?>


<div class="container">

    <div class="row">
        <?php if (!empty(@$affiche_recherche)) { ?>
        <?php foreach (@$affiche_recherche as $row) { ?>


        <div class="col-md-6">

            <div class="card-body">

                <h2 class="shadow-lg p-3 mb-5 bg-white rounded card-body" style="text-align : center">
                    <?php echo $row->nom_produit ?>
                </h2>
                <h5 class="shadow-lg p-3 mb-5 bg-white rounded card-body">
                    <?php echo $row->produit_long ?>
                    <!-- Button trigger -->
                    <a href="../produits/produit_entier.php?id=<?php echo $row->id_produit ?>">
                        lire la suite...
                    </a>
                </h5>



            </div>
        </div>

        <?php } ?>

        <?php } else { ?>
        <div class="container">
            <h2 style="text-align:center"> Pas de correspondance</h2>
        </div>
        <?php } ?>


    </div>
</div>




<!-- JQUERY -->
<!-- https://markjs.io/configurator.html -->
<script>
$(document).ready(function() {
    $(".card-body").mark("<?php echo  $recherche ?>");
});
</script>

<?php
include "../ffoter/footer.php";
?>