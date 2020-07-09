<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";



// <-------déclaration des variables----------------->
@$id_product = $_GET["id"];
@$id_user = $_SESSION["id_user"];
//var_dump($id_product);
//var_dump($id_user);






// <-------recuperation de la fonction ----------->
$recup_des_produits = produit_unique_entier($id_product);

$liste_image = recup_des_images($id_product);

?>


<!-- ============================ -->
<!-- ====== retour produit ====== -->
<!-- ============================ -->


<div class="container mt-5">
    <a href="../produits/produits.php"><i class="fas fa-arrow-circle-left fa-2x color-143054"></i></a>

</div>



<!-- ===================== -->
<!-- ====== Produit ====== -->
<!-- ===================== -->

<div class="container mt-5">
    <div class="row">



        <!-- ============================================================= -->
        <!-- =========================image=============================== -->
        <!-- ============================================================= -->

        <div class="col-sm-6">


            <div class="gallery">
                <div class="gallery-container">

                    <?php foreach ($liste_image as $row) { ?>
                    <img class="gallery-item" src="../uploads/<?php echo $row->name_photo ?>">
                    <?php } ?>

                </div>
                <div class="gallery-controls"></div>
            </div>

        </div>

        <!-- ========== présentation du produit + descriptif + prix + disponibilité + ajouter ==========-->

        <div class="col-sm-6">
            <div style="text-align: center">
                <h1 class="animate"><?php echo $recup_des_produits->nom_produit ?></h1>
            </div>
            <br>
            <p class="card-text" style="text-align:justify"><?php echo $recup_des_produits->produit_long ?></p>

            <p>Prix : <?php echo $recup_des_produits->prix ?> €</p>


            <!-- ============================================================= -->
            <!-- ===================Select quantitée========================== -->
            <!-- ============================================================= -->

            <!-- <select class="custom-select my-1 mr-sm-2" name="id_produit" onchange="submit()">
                <option selected value="0">choix quantité</option>
                <?php for ($i = 0; $i <= $recup_des_produits->quantite; $i++) { ?>
                <option value="<?php echo "$i"; ?>"><?php echo "$i"; ?></option>
                <?php } ?>
            </select> -->


            <!-- ============================================================= -->
            <!-- ============input Ajouter et disponibilité=================== -->
            <!-- ============================================================= -->

            <div class="container">



                <br>

                <button class="button">
                    <a href="../produits/calendrier.php?id=<?php echo $id_product ?>&id_cat=<?php echo $recup_des_produits->id_categorie ?>"
                        class="btn btn-sm">Disponibilité</a>
                    <div class="button__horizontal"></div>
                    <div class="button__vertical"></div>
                </button>




            </div>
        </div>

    </div>
</div>


<!-- ================== -->
<!-- ====== Avis ====== -->
<!-- ================== -->


<div class="container mt-5">

    <!-- <h3 class="text" style="text-align:center">Avis : </h3> -->
    <br>



    <!-- <?php foreach ($affiche_com as $row) { ?> -->

    <div class="card">

        <p>Publié Le <?php ?></p>
        <div class="commentaire">
            <p><?php  ?></p>
            <p>De <?php  ?></p>
        </div>
    </div>



    <!-- <?php } ?> -->
</div>

<script src="../js/carousel.js"></script>


<?php
include "../footer/footer.php";
?>