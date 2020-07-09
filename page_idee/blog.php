<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";







$select_article = select_article();
//select_article_uniq($id_article_uniq);


?>
<!-------------------------------------------------------->
<!--------------------en Tête----------------------------->
<!-------------------------------------------------------->

<div class="container mt-3">
    <div class="text-center">
        <h2 class="titre_bienvenue">Bienvenue</h2>
        <h3 class="location_particulier text-muted">Sur notre Blog</h3>
    </div>
    <div class="text-center">
        <a class="btn btn-primary-accueil btn-xl text-uppercase js-scroll-trigger"
            href="#formulaire_contact_accueil">Une Question ?</a>
    </div>
</div>


<!-------------------------------------------------------->
<!--------------------Les articles ----------------------->
<!-------------------------------------------------------->

<div class="container mt-3">


    <div class="row fluid mb-2 text:center">

        <?php foreach ($select_article as $row) { ?>
        <?php if ($row->actif == 1) { ?>

        <div class="card" style="width: 21.5rem; margin: 1rem;">

            <?php $recup_image_article = recup_image_article($row->id_article); ?>

            <figure class="snip1504">
                <img src="../uploads/<?php echo $recup_image_article->name_photo ?>" class="card-img-top" alt="..."
                    style="max-width:320px; max-height:210px">
                <figcaption>
                    <h5>Plus</h5>
                </figcaption>
                <a href="?" data-toggle="modal" data-target="#article_blog"></a>
            </figure>



            <div class="card-body">
                <h5 class="card-title"><?php echo $row->titre_article ?></h5>
                <div>
                    <p class="card-text"><?php echo substr($row->text_long, 0, 100) ?>...</p>
                </div>
                <div class="text-center">



                    <button onclick="id_article_uniq('<?php echo $row->id_article ?>')" type="button"
                        class="btn btn-primary-accueil btn-xl" data-toggle="modal" data-target="#article_blog"
                        style="color: white" value="<?php echo $row->id_article ?>">Agrandir</button>



                    <!-- <a href="#?id_article=<?php echo $row->id_article ?>" id="id_article_uniq" class="btn btn-primary-accueil btn-xl" data-toggle="modal" data-target="#article_blog" style="color: white" value="<?php echo $row->id_article ?>" onclick=" myFunction()">Agrandir</a> -->


                </div>

            </div>
        </div>
        <?php } ?>
        <?php } ?>



    </div>

</div>






<!-------------------------------------------------------->
<!------------Formulaire de contact----------------------->
<!-------------------------------------------------------->


<div class=" container mt-5 bg-light" id="formulaire_contact_accueil">

    <div class="titre" style="text-align: center">
        Formulaire de contact
    </div>
    <form action="../envoi_mail/envoi_mail.php" method="post">
        <div class="row container mt-3">

            <div class="col-md-6">
                <label>Civilité</label>
                <select name="civilite" class="form-control placeholder" value="">

                    <option value="<?php echo @$_SESSION["civilite"]; ?>">
                        <?php echo @$_SESSION["civilite"]; ?></option>

                    <option value="Monsieur">Monsieur</option>
                    <option value="Madame">Madame</option>

                </select>

                <input type="text" name="nom" class="form-control formulaire_accueil "
                    value="<?php echo @$_SESSION["nom"]; ?>" required placeholder="Nom">


                <input type="text" name="prenom" class="form-control formulaire_accueil "
                    value="<?php echo @$_SESSION["prenom"]; ?>" required placeholder="Prenom">


                <div class="input-group formulaire_accueil">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" name="mail" class="form-control" id="validationServerUsername"
                        aria-describedby="inputGroupPrepend3" value="<?php echo @$_SESSION["mail"]; ?>" required
                        placeholder="Adresse mail">
                </div>

                <input type="number_format" name="tel" class="form-control formulaire_accueil" maxlength="10"
                    value="<?php echo @$_SESSION["tel"]; ?>" required placeholder="Numéro de téléphone">

            </div>

            <div class="col-md-6">


                <label for="validationServer03">Date de l'événement</label>
                <input type="date" name="date_event" class="form-control" required>


                <label for="validationTextarea">Votre Message</label>
                <textarea class="form-control formulaire_accueil " name="message" placeholder="Ecrivez vous message"
                    required></textarea>
                <p style="text-align: right">(vous pouvez agrandir ici<i class="fas fa-arrow-up"></i>)</p>

                <br>

            </div>

        </div>
        <div class="g-recaptcha formulaire_accueil" data-sitekey="6LeNlNgUAAAAAJDvjCVNXtKfrPUBOMU1kIA7HNmv">
        </div>

        <button class="btn btn_color_accueil btn-rounded btn-block my-4 waves-effect z-depth-0" name="forminscription"
            value="ok" type="submit">Envoyer</button>
    </form>

</div>
<br>



<?php
require "../footer/footer.php";
require "../footer/modal.php";
?>


<script>
// animation image */

/*Demo purposes only */
$(".hover").mouseleave(
    function() {
        $(this).removeClass("hover");
    }
);




var id;

function id_article_uniq(id) {
    var id = id
    $(".modal-body").html("Voulez vous vraiment supprimer l'utilisateur <b>" + id + "</b> ayant pour Email <b>" +
        id + "</b> ?");
}






// document.getElementById("id_article_uniq").onclick = function() {
//     var valeur = this.value;
//     alert('.value');
//     return false;
// };






// $(document).ready(function() {
//     //console.log("ready!");


//     $("#id_article_uniq").click(function() {
//         let id_article = $(this).val(); // Récupère la valeur du bouton cliqué

//         $.ajax({
//             url: "https://www.mtevent44.fr/page_idee/blog" + id_article,
//             type: 'POST',
//             dataType: 'html',
//             success: function(code_html, statut) { // code_html contient le HTML retourné
//                 $('.modal-body').html(code_html);
//             },
//             error: function(resultat, statut, erreur) {
//                 alert(
//                     "Erreur: veuillez nous contacter pour prévenir de cette erreur, merci !"
//                 );
//             }
//         });
//     });



// });





// $('#article_blog').modal(
//     function() {
//         $(this)
//     }
// )
</script>

<!---------------------------------------------------------->
<!----------------------- BLOG ----------------------------->
<!---------------------------------------------------------->

<!-- Modal -->
<div class="modal fade" id="article_blog" tabindex="-1" role="dialog" aria-labelledby="article_blog_info"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>