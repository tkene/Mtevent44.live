<?php

require "../connect/connect.php";
require "../admin/uploads_image_index.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if ($_SESSION["niv"] != 1) {
    header('Location:./clients/login.php');
}



//$liste_cat = liste_cat();


if ($_POST) {

    @$ajouter = htmlspecialchars($_POST["ajouter"]);
    @$modifier = htmlspecialchars($_POST["modifier"]);
    @$supprimer = htmlspecialchars(($_POST)["supprimer"]);
    @$id_image = htmlspecialchars(($_POST)["id_image"]);
    //@$id_categorie = htmlspecialchars($_POST["id_categorie"]);
    @$titre_image = htmlspecialchars($_POST["titre_image"]);
    $photos = $_FILES;





    // permet de supprimer par la fonction
    if ($supprimer) {
        supprimer_image_index($id_image);
        $sup = "L'article est supprimé";
    }


    //addslashes --> permet d'intégrer les ' ' évite les erreurs lorsque l'on rentre l'article//
    //permet de modifier par la fonction
    if ($modifier) {
        modif_image_index($id_image, addslashes($titre_image));
        $affiche = "L'article est modifié";
    }

    // permet de recuperer un produit en fonction de son id (select)
    if ($id_image) {
        $image_unique = image_idee_unique_index($id_image);
        //$image_unique = image_unique($id_image);
        //var_dump($image_unique);
    }

    // permet d'ajouter un article
    if ($ajouter) {
        $id_image = insert_image_index($titre_image, $id_image);

        $affiche = "article ajouté";
    }
}

$liste_image = liste_image_index();


// if (isset($_POST["valider"])) {

//     //$order = $_POST["order"];
//     // $position = $_POST["position"];
//     //$id_produit = $_POST["id_produit"];
//     $order_idee = htmlspecialchars($_POST["order_idee"]);
//     $id_idee = htmlspecialchars($_POST["id_idee"]);

//     envoi_order_idee($order_idee, $id_idee);
//     $affiche = ("Produit placé");
// }


//$liste_image_idee = liste_image_idee();
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



<div class="container mt-5">
    <div class="text-center">
        <?php
        if (isset($sup)) {
            echo '<font color="red">' . $sup . '</font>';
        } ?>
    </div>
</div>


<!---------------------------------->
<!------ Gestion des images index---------->
<!---------------------------------->

<div class="container mt-3">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Gestion des images index</h1>
</div>

<div class="container mt-3">

    <form action="admin_disposition_image_index.php" method="post" id="target" enctype="multipart/form-data">

        <div class="container mt-3">


            <!---------------------------------->
            <!------ select des images--- ------>
            <!--------------------------------->
            <div class="col-6">
                <label>Liste des images</label>
                <select name="id_image" onchange="submit()" class="form-control">
                    <option value="">Ajout d'une nouvelle image pour l'index</option>
                    <?php foreach ($liste_image as $row) { ?>
                    <option value="<?php echo stripslashes($row->id_index_image); ?>" <?php //permet de rester sur l'option sélectionné
                                                                                            if ($row->id_index_image == @$_POST["id_image"]) {
                                                                                                echo " selected";
                                                                                            } ?>>
                        <?php echo stripslashes($row->titre_image); ?>
                    </option>
                    <?php } ?>

                </select>
            </div>


        </div>

        <!--------------------------------->
        <!--------- titre de l'image ------>
        <!--------------------------------->
        <br>
        <label for="" class="badge-pill badge-info">Titre de l'image*</label><br>
        <input type="text" name="titre_image" value="<?php echo stripslashes(@$image_unique->titre_image); ?>"
            class="form-control" required>

        <br>

        <!--------------------------------------------->
        <!------ Permet de télécharger une image------->
        <!--------------------------------------------->

        <input type="file" name="image"><br><br>

        <div class="card" style="width: 18rem;">

            <img class="card-img-top" src="../uploads/<?php echo @$image_unique->images_index; ?>" alt="">
        </div>


        <!--------------------------------------------------------------------------------------->
        <!------ bouton ajouter et modifier il apparait en fonction du choix de l'article ------->
        <!--------------------------------------------------------------------------------------->

        <!-- <input class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="ajouter" value="ajouter"></input> -->

        <!--------------------------------------------------------------------------------------->
        <!------ bouton ajouter et modifier il apparait en fonction du choix de l'article ------->
        <!--------------------------------------------------------------------------------------->

        <?php if (@$id_image) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <input type="submit" class=" btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                        width="50" name="modifier" value="modifier">
                </div>
                <div class="col-md-6">
                    <input type="submit" id="supprimer"
                        class=" btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" width="50"
                        name="supprimer" value="supprimer">
                </div>
            </div>
        </div>
        <?php } else { ?>


        <input class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit"
            name="ajouter" value="ajouter"></input>
        <?php } ?>

</div>
</div>
</form>

<?php include "../footer/footer.php"; ?>