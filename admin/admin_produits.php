<?php

require "../connect/connect.php";
require "../admin/uploads.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if ($_SESSION["niv"] != 1) {
    header('Location: login.php');
}

// permet de protéger la variable declarer sur le foreach
$image_unique = array();
$liste_categorie = liste_categorie();

if (isset($_POST)) {

    $ajouter = htmlspecialchars($_POST["ajouter"]);
    $modifier = htmlspecialchars($_POST["modifier"]);
    $supprimer = htmlspecialchars($_POST["supprimer"]);
    $id_produit = htmlspecialchars($_POST["id_produit"]);
    //$id_categorie = htmlspecialchars($_POST["id_categorie"]);
    $titre_produit = htmlspecialchars($_POST["titre_produit"]);
    $produit_court = htmlspecialchars($_POST["produit_court"]);
    $produit_long = htmlspecialchars($_POST["produit_long"]);
    $quantite = htmlspecialchars($_POST["quantite"]);
    $prix_ttc = htmlspecialchars($_POST["prix_ttc"]);
    $choix_tva = htmlspecialchars($_POST["choix_tva"]);
    @$commentaire = htmlspecialchars(($_POST)["commentaire"]);
    @$id_categorie = htmlspecialchars(($_POST)["id_categorie"]);
    @$titre_categorie = htmlspecialchars(($_POST)["titre_categorie"]);

    $photos = $_FILES;



    // permet de supprimer par la fonction
    if ($supprimer) {
        supprimer_article($id_produit);
        $sup = "produit supprimé";
    }

    // addslashes --> permet d'intégrer les ' ' évite les erreurs lorsque l'on rentre l'article
    // permet de modifier par la fonction
    if ($modifier) {
        modif_produit($id_produit, addslashes($titre_produit), addslashes($produit_long), addslashes($produit_court), addslashes($quantite), addslashes($prix_ttc), addslashes($choix_tva));
        //modif_tags($id_article, $tags);
        img_load($id_produit);
        modif_categorie($titre_categorie, $id_categorie);
        $affiche = "produit modifié";
    }



    // permet de recuperer un produit en fonction de son id (select)

    if ($id_produit) {

        $produit_unique = produit_unique($id_produit);
        $image_unique = image_unique($id_produit);
        //var_dump($produit_unique);
    }



    // permet d'ajouter un article
    if ($ajouter) {
        $id_produit = insert_produit($titre_produit, $produit_court, $produit_long, $quantite, $prix_ttc, $choix_tva);
        $id_categorie = insert_categorie($titre_categorie);
        insert_liaison_produits($id_produit, $id_categorie);
        //var_dump(insert_liaison_produits($id_produit, $id_categorie));
        $affiche = "article ajouté";
    }
}

//variable qui permet de faire un foreach sur le select des titres
$liste_produit = liste_titre();

//var_dump($id_produit);

?>

<div class="container mt-5" id="haut">
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


<div class="container mt-3">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Gestion des produits*
    </h1><br>
    <p class="text-center">(pour les consignes voir plus bas de la page)</p>
    <br>


    <form action="admin_produits.php" method="post" id="target" enctype="multipart/form-data">
        <div class="row">

            <!------------------------------>
            <!------ select de produit------>
            <!------------------------------>
            <div class="col-6">
                <label class="badge-pill badge-info">Liste des produits</label>
                <select name="id_produit" onchange="submit()" class="form-control">
                    <option value="">Ajout d'un nouveau produit</option>

                    <?php foreach ($liste_produit as $row) { ?>
                    <option value="<?php echo stripslashes($row->id_produit); ?>" <?php //permet de rester sur l'option sélectionné
                                                                                        if ($row->id_produit == @$_POST["id_produit"]) {
                                                                                            echo " selected";
                                                                                        } ?>>
                        <?php echo stripslashes($row->nom_produit); ?>
                    </option>
                    <?php } ?>

                </select>
            </div>


            <!--------------------------------->
            <!------ select de catégories------>
            <!--------------------------------->
            <div class="col-6">
                <label class="badge-pill badge-info">Categorie</label>
                <select name="id_categorie" id="id_categorie" class="form-control">
                    <option value="">Choix de la categorie</option>
                    <?php foreach ($liste_categorie as $row) { ?>
                    <option value="<?php echo $row->id_categorie; ?>" <?php //permet de rester sur l'option sélectionné
                                                                            if ($row->id_categorie == @$produit_unique->id_categorie) {
                                                                                echo " selected";
                                                                            } ?>>
                        <?php echo $row->nom_categorie; ?>
                    </option>
                    <?php } ?>

                </select>
            </div>


        </div>




        <br>
        <div class="row">
            <!------------------------------------------>
            <!--------------la categorie du produit ------>
            <!------------------------------------------>
            <br>
            <label for="" class="badge-pill badge-info">Titre de la categorie*</label><br>
            <input type="text" name="titre_categorie"
                value="<?php echo stripslashes(@$produit_unique->nom_categorie); ?>" class="form-control">

            <!------------------------------------------>
            <!--------------le titre de l'article ------>
            <!------------------------------------------>
            <br>
            <label for="" class="badge-pill badge-info">Titre du produit*</label><br>
            <input type="text" name="titre_produit" value="<?php echo stripslashes(@$produit_unique->nom_produit); ?>"
                class="form-control" required>


            <!------------------------------------------->
            <!--------------- Texte court --------------->
            <!------------------------------------------->

            <label for="" class="badge-pill badge-info">Descriptif court*</label><br>
            <textarea name="produit_court" id="editor2" class="form-control" cols="30" rows="5"
                maxlength="90"><?php echo stripslashes(@$produit_unique->produit_court); ?></textarea>

            <!------------------------------------------>
            <!--------------- Texte long --------------->
            <!------------------------------------------>

            <label for="" class="badge-pill badge-info">Descriptif entier*</label><br>
            <textarea name="produit_long" id="editor2" class="form-control" cols="30" rows="5"
                maxlength="1000"><?php echo stripslashes(@$produit_unique->produit_long); ?></textarea>

        </div>

</div>
<br>

<div class="container mt-3">
    <!-------------------------------------------------------->
    <!--------------- Prix ttc / TVA / prix HT --------------->
    <!-------------------------------------------------------->

    <div class="row">
        <!-- Quantité -->
        <div class="col-6 col-md-4"><label for="" class="badge-pill badge-info">ref*</label><br>
            <input type="number" name="quantite" value="<?php echo stripslashes(@$produit_unique->ref); ?>"
                class="form-control" required>
        </div>
        <!-- Prix TTC -->
        <div class="col-6 col-md-4"><label for="" class="badge-pill badge-info">Prix TTC* / unitée</label><br>
            <input type="text" name="prix_ttc" value="<?php echo stripslashes(@$produit_unique->prix); ?>"
                class="form-control" required>
        </div>
        <!-- TVA -->
        <div class="col-6 col-md-4"><label for="" class="badge-pill badge-info">TVA*</label><br>
            <select name="choix_tva" class="form-control">
                <option value="0.2">20 %</option>
                <option value="0.1">10 %</option>
                <option value="0.55">5.5 %</option>
                <option value="<?php echo stripslashes(@$produit_unique->nom_produit); ?>"></option>

            </select>
        </div>

    </div>


    <!-------------------------------------------------------->
    <!----------------- autoriser commentaires ---------------->
    <!-------------------------------------------------------->

    <?php
    if (@$produit_unique->commentaire == "" || $produit_unique->commentaire == 1) {
        $checked1 = "checked";
    } else {
        $checked2 = "checked";
    }

    ?>

    <label for="">Autoriser un commentaire* </label>
    <br>

    <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" <?php echo @$checked1 ?> name="commentaire" id="customRadio1"
            value="1">
        <label class="custom-control-label" for="customRadio1">oui</label>
    </div>
    <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" <?php echo @$checked2 ?> name="commentaire" id="customRadio2"
            value="0">
        <label class="custom-control-label" for="customRadio2">non</label>
    </div>

    <br>

    <div class="container mt-3">
        <input type="file" name="photos[]" multiple>

        <div class="row">
            <br>

            <!--------------------------------------------->
            <!------ Permet de télécharger une image------->
            <!--------------------------------------------->



            <?php foreach ($image_unique as $row) { ?>

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../uploads/<?php echo $row->name_photo; ?>" alt="...">
            </div>


            <?php } ?>


        </div>

        <!--------------------------------------------------------------------------------------->
        <!------ bouton ajouter et modifier il apparait en fonction du choix de l'article ------->
        <!--------------------------------------------------------------------------------------->

        <!-- <input class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="ajouter" value="ajouter"></input> -->

        <!--------------------------------------------------------------------------------------->
        <!------ bouton ajouter et modifier il apparait en fonction du choix de l'article ------->
        <!--------------------------------------------------------------------------------------->

        <?php if (@$id_produit) { ?>
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






        </form>


    </div>

</div>

<br><br><br>
<div class="container-fluid">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Consigne d'utilisation</h1><br>

    <p><strong> l'ajout d'un produit : </strong><br>
        1) Choisir liste des produis --> "Ajout d'un nouveau produit".<br>
        2) Categorie --> sois choisir une catégorie déjà existante ou laisser en choix de la categorie et inscrire
        la
        nouvelle dans le champ "Titre de la catégorie".<br>
        3) Remplir les champs demandés.<br>
        4) Ref --> pour presenter sur la fiche produit (visu client) il faudra mettre une référence 1 ou mettre une
        référence qui correspond au nombre de l'objet (ex: miroir1 = ref -> 1, miroir2 = ref -> 2,Etc.. )<br>
        5) Une fois tout les champs remplis valider.<br>
    </p>

    <p>
        <strong>Modifier un article :</strong><br>
        1) Choisir le produit concerné<br>
        2) Modifier le champs souhaité<br>
        3) Appuyer sur modifier<br>
    </p>

    <p>
        <strong>Pour supprimer :</strong><br>
        1) Choisir le produit concerné.<br>
        2) Appuyer sur modifier.<br>
        *(l'article n'est pas complément supprimer pour le réintégrer adressez-vous à l'administrateur).<br>
    </p>

</div>
<?php include "../footer/footer.php" ?>