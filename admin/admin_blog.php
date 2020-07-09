<?php
ob_start();
require "../connect/connect.php";
require "../admin/uploads_img_article.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if ($_SESSION["niv"] != 1) {
    header('Location: login.php');
}

// permet de protéger la variable declarer sur le foreach
$image_unique = array();

if (isset($_POST)) {

    $ajouter = htmlspecialchars($_POST["ajouter"]);
    $modifier = htmlspecialchars($_POST["modifier"]);
    $supprimer = htmlspecialchars($_POST["supprimer"]);
    $id_article = htmlspecialchars($_POST["id_article"]);

    $titre_categorie_article = htmlspecialchars($_POST["titre_categorie_article"]);
    $titre_article = htmlspecialchars($_POST["titre_article"]);
    $texte_court = htmlspecialchars($_POST["texte_court"]);
    $article_long = htmlspecialchars($_POST["article_long"]);

    $id_categorie = htmlspecialchars($_POST["id_categorie"]);


    // permet de supprimer par la fonction
    if ($supprimer) {
        supprimer_article_blog($id_article);
        header('location:../admin/admin_blog.php?msg_blog_supprimer=true');
        ob_end_flush();
        exit();
    }


    // addslashes --> permet d'intégrer les ' ' évite les erreurs lorsque l'on rentre l'article
    // permet de modifier par la fonction
    if ($modifier) {
        modif_article($id_article, addslashes($titre_article), addslashes($texte_court), addslashes($article_long));
        //modif_tags($id_article, $tags);
        img_load_articles($id_article);
        modif_categorie_article($titre_categorie_article, $id_categorie);
        header('location:../admin/admin_blog.php?msg_blog_modifier=true');
        ob_end_flush();
        exit();
    }


    // permet de recuperer un produit en fonction de son id (select)

    if ($id_article) {

        $article_unique = article_unique($id_article);
        $image_unique = image_unique_article($id_article);
        //var_dump($produit_unique);
    }

    // permet d'ajouter un article
    if ($ajouter) {
        $id_article = insert_article($titre_article, $texte_court, $article_long);
        $insert_categorie_article = insert_categorie_article($titre_categorie_article);
        insert_liaison_article($id_article, $insert_categorie_article);
        //var_dump(insert_liaison_produits($id_produit, $id_categorie));
        //$affiche = "article ajouté";
        header('location:../admin/admin_blog.php?msg_blog_ajouter=true');
        ob_end_flush();
        exit();
    }
}



//variable qui permet de faire un foreach sur le select des titres
$liste_article = liste_titre_article();
$liste_categorie_article = liste_categorie_article();

?>



<div class="container mt-3">
    <h1 class="text-center" id="haut" style="font-family: 'Roboto Mono', monospace;"> Gestion du Blog
    </h1>
    <br><br>


    <form action="admin_blog.php" method="post" id="target" enctype="multipart/form-data">
        <div class="row">

            <!------------------------------>
            <!------ select de Article------>
            <!------------------------------>
            <div class="col-6">
                <label class="badge-pill badge-info">Liste des Articles</label>
                <select name="id_article" onchange="submit()" class="form-control">
                    <option value="">Ajout d'un nouvelle article</option>

                    <?php foreach ($liste_article as $row) { ?>
                    <option value="<?php echo stripslashes($row->id_article); ?>" <?php //permet de rester sur l'option sélectionné
                                                                                        if ($row->id_article == @$_POST["id_article"]) {
                                                                                            echo " selected";
                                                                                        } ?>>
                        <?php echo stripslashes($row->titre_article); ?>
                    </option>
                    <?php } ?>

                </select>
            </div>


            <!--------------------------------->
            <!------ select de catégories------>
            <!--------------------------------->
            <div class="col-6">
                <label class="badge-pill badge-info">Categorie de l'article</label>
                <select name="id_categorie" id="id_categorie" class="form-control">
                    <option value="">Ajout Catégorie pour l'article</option>
                    <?php foreach ($liste_categorie_article as $row) { ?>
                    <option value="<?php echo $row->id_categorie; ?>" <?php //permet de rester sur l'option sélectionné
                                                                            if ($row->id_categorie == @$article_unique->id_categorie) {
                                                                                echo " selected";
                                                                            } ?>>
                        <?php echo $row->titre_article_categorie; ?>
                    </option>
                    <?php } ?>

                </select>
            </div>


        </div>

        <br>
        <div class="row">
            <!---------------------------------------------->
            <!--------------la categorie de l'article ------>
            <!---------------------------------------------->
            <br>
            <label for="" class="badge-pill badge-info">Titre de la categorie article*</label><br>
            <input type="text" name="titre_categorie_article"
                value="<?php echo stripslashes($article_unique->titre_article_categorie); ?>" class="form-control">

            <!------------------------------------------>
            <!--------------le titre de l'article ------>
            <!------------------------------------------>
            <br>
            <label for="" class="badge-pill badge-info">Titre du article*</label><br>
            <input type="text" name="titre_article" value="<?php echo stripslashes($article_unique->titre_article); ?>"
                class="form-control" required>


            <!------------------------------------------->
            <!--------------- Texte court --------------->
            <!------------------------------------------->

            <label for="" class="badge-pill badge-info">Descriptif court*</label><br>
            <textarea name="texte_court" class="form-control" cols="30" rows="5"
                maxlength="90"><?php echo stripslashes($article_unique->text_court); ?></textarea>

            <!------------------------------------------>
            <!--------------- Texte long --------------->
            <!------------------------------------------>

            <label for="" class="badge-pill badge-info">Descriptif entier*</label><br>
            <textarea name="article_long" class="form-control" cols="30" rows="5"
                maxlength="1000"><?php echo stripslashes($article_unique->text_long); ?></textarea>

        </div>

</div>

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

    <?php if ($id_article) { ?>
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


    <input class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="ajouter"
        value="ajouter"></input>
    <?php } ?>

    </form>
</div>




<?php require "../footer/footer.php" ?>
<?php require "../footer/modal.php" ?>


<!-- Blog article ajouté -->
<?php if (isset($_GET["msg_blog_ajouter"])) {
    $msg_blog_ajouter = $_GET["msg_blog_ajouter"];

    if ($msg_blog_ajouter == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg_blog_ajouter').modal('show');
});
</script>

<?php }
} ?>

<!-- Blog article modifier -->
<?php if (isset($_GET["msg_blog_modifier"])) {
    $msg_blog_modifier = $_GET["msg_blog_modifier"];

    if ($msg_blog_modifier == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg_blog_modifier').modal('show');
});
</script>

<?php }
} ?>

<!-- Blog article supprimé -->
<?php if (isset($_GET["msg_blog_supprimer"])) {
    $msg_blog_supprimer = $_GET["msg_blog_supprimer"];

    if ($msg_blog_supprimer == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg_blog_supprimer').modal('show');
});
</script>

<?php }
} ?>