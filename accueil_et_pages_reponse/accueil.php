<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";



$recup_produit_index_random = recup_produit_index_random();
//var_dump($recup_produit_index_random);
//$liste_image = recup_image_index();

?>

<div class="container mt-3">
    <!-------------------------------------------------------->
    <!-------------------------------------------------------->
    <!--------------- Texte de présentation------------------->
    <!-------------------------------------------------------->
    <!-------------------------------------------------------->
    <br>

    <div class="text-center">
        <?php
        if (isset($erreur)) {
            echo '<font color="red">' . '<strong>' . $erreur . '</strong>' . '</font>';
        } ?>

        <?php
        if (isset($retour_mail)) {
            echo '<font color="green">' . '<strong>' . $retour_mail . '</strong>' . '</font>';
        } ?>


    </div>


    <h1 class="titre">Présentation</h1>

    <p>Bienvenue sur notre site internet dédié à la location de matériel. Nous te proposons à travers le site, plusieurs
        objets pour décorer et embellir ton évènement. Tu retrouveras plusieurs informations qui décrivent les produits
        mais aussi son prix de location. Nous avons décidés de te proposer des prix très abordable, car nous souhaitons
        que ton évènement soit la plus belle journée de ta vie et non un gouffre financier.
        Alors n'hésite pas et on te souhaite une bonne visite sur notre site.
    </p>




    <!-------------------------------------------------------->
    <!-------------------------------------------------------->
    <!--------------- Les étapes de locations----------------->
    <!-------------------------------------------------------->
    <!-------------------------------------------------------->

    <br><br><br>

    <h3 class=" location">Louez tout le matériel pour votre réception en 3 étapes !</h3>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="text-align:center">
                <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_selection.png"
                    alt="cible"><br><br>
                <span class="step-number">
                    <h3>1</h3>
                </span>
                <span class="step-label">Sélectionnez votre objet</span>
            </div>

            <div class="col-md-4" style="text-align:center">
                <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_quantite.png"
                    alt="quantite"><br><br>
                <span class="step-number">
                    <h3>2</h3>
                </span>
                <span class="step-label">Nous vous te confirmons dans les 48h sa disponnibilitée</span>
            </div>

            <div class="col-md-4" style="text-align:center">
                <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_valider.png"
                    alt="valider"><br><br>
                <span class="step-number">
                    <h3>3</h3>
                </span>
                <span class="step-label">Validez votre panier </span>
            </div>
        </div>
    </div>




</div>

<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!-------------------- Les produits----------------------->
<!-------------------------------------------------------->
<!-------------------------------------------------------->
<br><br><br>

<h1 class="titre">Nos produits</h1>
<br>


<div class="container">
    <div class="row ">

        <?php foreach ($recup_produit_index_random as $row) { ?>
        <?php if ($row->actif == 1) { ?>

        <div class="col-md-4">
            <div class="card-deck">
                <div class="card" style="width: 21rem;">
                    <figure class="snip1573">
                        <img src="../uploads/<?php echo  @$row->images_index ?>" class="card-img-top" alt="location">
                        <figcaption>
                            <h3>Louez moi</h3>
                        </figcaption>
                        <a aria-label="produits" href="../produits/produits.php"></a>
                    </figure>
                    <div class="card-body">
                        <h5 class="card-title produit"><?php echo  @$row->titre_image ?></h5>
                        <p class="card-text"></p>
                    </div>
                    <!-- <div class="card-footer">
                        <small class="text-muted">Louez vite pour vos réceptions de mariage, Anniversaire,
                            Cousinade,...</small>
                    </div> -->
                </div>


            </div>
        </div>

        <?php  } ?>
        <?php  } ?>
    </div>
</div>
<br>
<div class="container">

    <div class="text-center">

        <div class="animate">
            <a aria-label="produits" href="../produits/produits.php">
                <h4>la suite.....</h4>
            </a>
        </div>

    </div>
</div>
<br>


<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!--------------- Nos réalisations------------------------>
<!-------------------------------------------------------->
<!-------------------------------------------------------->

<br>
<h1 class="titre">Des idées réalisations</h1>
<br>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-4">
            <div class="card">

                <img src="../images/tableaccueil.jpg" class="card-img-top" alt="mariage">

            </div>


        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="../images/alleeaccueil.jpg" class="card-img-top" alt="allee">
            </div>


        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="../images/tableaccueil2.jpg" class="card-img-top" alt="table">
            </div>


        </div>
    </div>
</div>

<br>
<!-- <div class="container">

    <div class="text-center">

        <div class="animate">
            <a href="../produits/produits.php">
                <h4>la suite.....</h4>
            </a>
        </div>

    </div>
</div>
<br> -->



<?php
require "../footer/footer.php";
?>