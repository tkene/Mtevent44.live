<?php
include "connect.php";
include "uploads_inspiration.php";
include "fonction.php";
include "header_admin.php";


if ($_SESSION["niv"] != 1) {
    header('Location: login.php');
}



$liste_cat = liste_cat();


if ($_POST) {

    @$ajouter = htmlspecialchars($_POST["ajouter"]);
    @$modifier = htmlspecialchars($_POST["modifier"]);
    @$supprimer = htmlspecialchars(($_POST)["supprimer"]);
    @$id_image = htmlspecialchars(($_POST)["id_image"]);
    $id_categorie = htmlspecialchars($_POST["id_categorie"]);
    $titre_image = htmlspecialchars($_POST["titre_image"]);
    $photos = $_FILES;





    // permet de supprimer par la fonction
    if ($supprimer) {
        supprimer_image_idee($id_image);
        $sup = "L'article est supprimé";
    }


    // addslashes --> permet d'intégrer les ' ' évite les erreurs lorsque l'on rentre l'article//
    // permet de modifier par la fonction
    if ($modifier) {
        modif_image_idee($id_image, $id_categorie, addslashes($titre_image));
        $affiche = "L'article est modifié";
    }

    // permet de recuperer un produit en fonction de son id (select)
    if ($id_image) {
        $image_unique = image_idee_unique($id_image);
        //$image_unique = image_unique($id_image);
        //var_dump($image_unique);
    }

    // permet d'ajouter un article
    if ($ajouter) {
        $id_image = insert_image_idee($titre_image, $id_image, $id_categorie);

        $affiche = "article ajouté";
    }
}

$liste_image = liste_image();


if (isset($_POST["valider"])) {

    //$order = $_POST["order"];
    // $position = $_POST["position"];
    //$id_produit = $_POST["id_produit"];
    $order_idee = htmlspecialchars($_POST["order_idee"]);
    $id_idee = htmlspecialchars($_POST["id_idee"]);

    envoi_order_idee($order_idee, $id_idee);
    $affiche = ("Produit placé");
}
$liste_image_idee = liste_image_idee();
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
<!------ Gestion des idées---------->
<!---------------------------------->

<div class="container mt-3">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Gestion des idées</h1>
</div>

<div class="container mt-3">

    <form action="admin_idee.php" method="post" id="target" enctype="multipart/form-data">

        <div class="container mt-3">
            <div class="row">

                <!---------------------------------->
                <!------ select des images--- ------>
                <!--------------------------------->
                <div class="col-6">
                    <label>Liste des images</label>
                    <select name="id_image" onchange="submit()" class="form-control">
                        <option value="">Ajout d'un nouveau produit</option>
                        <?php foreach ($liste_image as $row) { ?>
                        <option value="<?php echo stripslashes($row->id_idee); ?>" <?php //permet de rester sur l'option sélectionné
                                                                                        if ($row->id_idee == @$_POST["id_image"]) {
                                                                                            echo " selected";
                                                                                        } ?>>
                            <?php echo stripslashes($row->titre_image); ?>
                        </option>
                        <?php } ?>

                    </select>
                </div>


                <!--------------------------------->
                <!------ select de Catégorie ------>
                <!--------------------------------->

                <div class="col-6">
                    <label>Choix des catégories</label>
                    <select name="id_categorie" id="id_categorie" class="form-control" required>
                        <option value="">Choix des produits</option>
                        <?php foreach ($liste_cat as $row) { ?>
                        <option value="<?php echo stripslashes($row->id_categorie); ?>" <?php //permet de rester sur l'option sélectionné
                                                                                            if ($row->id_categorie ==  @$image_unique->id_categorie) {
                                                                                                echo " selected";
                                                                                            } ?>>
                            <?php echo stripslashes($row->nom_categorie); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
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

            <img class="card-img-top" src="uploads/<?php echo @$image_unique->images_idee; ?>" alt="">
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

<br><br><br>


<!----------------------------------------->
<!------ Position des images idée---------->
<!----------------------------------------->

<div class="container mt-3">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Position des images idée</h1>
</div>


<div class="container mt-5">
    <div class="text-center">
        <?php
        if (isset($affiche)) {
            echo '<font color="green">' . $affiche . '</font>';
        } ?>
    </div>
</div>


<div class="container">
    <div class="row">
        <?php foreach ($liste_image_idee as $row) { ?>
        <?php if ($row->actif == 1) { ?>
        <form action="admin_idee.php" method="post">
            <div class="col-md-4">
                <div><strong>Produit :</strong> <?php echo $row->titre_image ?></div>
                <label><strong>Position</strong></label>
                <input type="text" name="order_idee" value="<?php echo $row->ordernum ?>" class="">
                <input type="hidden" name="id_idee" value="<?php echo $row->id_idee ?>">
                <input type="submit" name="valider" class="btn btn-success" value="Valider">
            </div>
        </form>
        <?php } ?>
        <?php } ?>
    </div>

</div>















<?php include "footer.php" ?>