<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";



//$liste_produit = liste_titre();
$liste_ordernum = liste_ordernum();


?>




<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!--------------------------- titre----------------------->
<!-------------------------------------------------------->
<!-------------------------------------------------------->
<br>

<h1 class="titre_produits">Nos produits</h1>

<br><br><br>



<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!-------------------- les étapes de locations------------>
<!-------------------------------------------------------->
<!-------------------------------------------------------->

<h3 class="location">Louez tout le matériel pour votre réception en 3 étapes !</h3>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_selection.png" alt=""><br><br>
            <span class="step-number">
                <h3>1</h3>
            </span>
            <span class="step-label">Vérifie la disponnibilitée du produit</span>
        </div>

        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_quantite.png" alt=""><br><br>
            <span class="step-number">
                <h3>2</h3>
            </span>
            <span class="step-label">Envoi ta demande de location</span>
        </div>

        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_valider.png" alt=""><br><br>
            <span class="step-number">
                <h3>3</h3>
            </span>
            <span class="step-label">Valide ton produit au retour</span>
        </div>
    </div>
</div>


<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!------------------------ les produits------------------->
<!-------------------------------------------------------->
<!-------------------------------------------------------->
<br><br><br>

<div class="container">
    <div class="row">
        <?php $i = 0;
        ?>
        <?php foreach ($liste_ordernum as $row) { ?>
        <?php if ($row->ref == 1) { ?>
        <?php if ($i == 5) {
                    $i = 0;
                } ?>


        <?php if ($i <= 1) { ?>

        <?php $liste_image = recup_image($row->id_produit); ?>


        <div class="col-sm-6">
            <div class="card" style="width: 22rem center">
                <a
                    href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>">
                    <img src="../uploads/<?php echo  @$liste_image->name_photo ?>" class="card-img-top" alt="..."></a>
                <div class="card-body">

                    <section class="portfolio-experiment">
                        <a
                            href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>">
                            <span class="text_produit"><?php echo $row->nom_produit ?></span>
                            <span class="line -right"></span>
                            <span class="line -top"></span>
                            <span class="line -left"></span>
                            <span class="line -bottom"></span>
                        </a>
                    </section>
                    <br>
                    <p class="card-text"><?php echo $row->produit_court ?>
                        <a
                            href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>">
                            <i class="far fa-file-alt fa-1x color-143054"> Suite...</i><a>
                    </p>
                    <p class="prix_produits"> Prix : <?php echo $row->prix ?> € </p>

                    <div class="text-right">
                        <!-- <button type="button" class="btn btn-outline-success btn-sm">Ajouter</button> -->
                        <a
                            href="../produits/calendrier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>"><i
                                class="far fa-calendar-alt fa-1x color-143054"> Disponibilité</i></a>
                    </div>
                </div>
            </div><br>
        </div>

        <?php } ?>
        <?php if ($i >= 2) { ?>
        <?php $liste_image = recup_image($row->id_produit);


                    ?>


        <div class="col-sm-4">
            <div class="card" style="width: 18rem center">
                <a
                    href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>"><img
                        src="../uploads/<?php echo  @$liste_image->name_photo ?>" class="card-img-top" alt="..."></a>
                <div class="card-body">


                    <section class="portfolio-experiment">
                        <a
                            href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>">
                            <span class="text_produit2"><?php echo $row->nom_produit ?></span>
                            <span class="line -right"></span>
                            <span class="line -top"></span>
                            <span class="line -left"></span>
                            <span class="line -bottom"></span>
                        </a>
                    </section>

                    <br>
                    <p class="card-text"><?php echo $row->produit_court ?>
                        <a
                            href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>">
                            <i class="far fa-file-alt fa-1x color-143054"> Suite...</i><a>

                    </p>
                    <p class="prix_produits"> Prix : <?php echo $row->prix ?> € </p>
                    <div class="text-right">
                        <!-- <button type="button" class="btn btn-outline-success btn-sm">Ajouter</button> -->
                        <a
                            href="../produits/calendrier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>"><i
                                class="far fa-calendar-alt fa-1x color-143054"> Disponibilité</i></a>
                    </div>
                </div>
            </div><br>
        </div>

        <?php  } ?>
        <?php $i++;
            } ?>

        <?php } //echo $row; 
        ?>
    </div>
</div>
<br>

<?php
include "../footer/footer.php";
?>