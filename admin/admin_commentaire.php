<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if ($_SESSION["niv"] != 1) {
    header('Location: login.php');
} ?>

<div class="container mt-3">
    <h1 class="text-center" style="font-family: 'Roboto Mono', monospace;"> Gestion des Avis</h1>

    <div> User : </div>
    <div> Avis : </div>
    <div> Notation : </div>


    <!------------------------------------------------->
    <!-------------Répondre au commentaire------------->
    <!------------------------------------------------->
    <br>
    <label for="" class="badge-pill badge-info">Descriptif entier*</label><br>
    <textarea name="article_court" id="editor2" class="form-control" cols="30" rows="5" maxlength="1000"></textarea>
    <br>

    <!------------------------------------------>
    <!-------------Boutton d'ajout ------------->
    <!------------------------------------------>

    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Confirmer le
        commentaire</button>

    <!-------------------------------------------->
    <!-------------Boutton supprimer ------------->
    <!-------------------------------------------->


    <div class="container">
        <div class="row row-cols-4">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"><button class="btn btn-outline-danger btn-rounded btn-block my-4 waves-effect z-depth-0"
                    type="submit">Supprimer</button></div>
        </div>
    </div>


</div>




<?php include "../footer/footer.php" ?>