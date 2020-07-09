<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";



$recup_produit_index_random = recup_produit_index_random();


?>

<div class="container mt-3">
    <div class="text-center">
        <h2 class="titre_bienvenue">Bienvenue</h2>
        <h3 class="location_particulier text-muted">A la location pour particulier</h3>
    </div>
    <div class="text-center">
        <a class="btn btn-primary-accueil btn-xl text-uppercase js-scroll-trigger"
            href="#bouton_ancre_presentation">Nous
            connaitre</a>
    </div>
</div>


<!----------------Step for rent--------------------------->





<div class="container-fluid mt-3 bg-light" id="etape">
    <p class="location ">Louez tout le matériel pour votre réception en 3 étapes !</p>
    <br>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4" style="text-align:center">
                <span class="fa-stack fa-4x"> <i class="fas fa-circle fa-stack-2x " style="color: #FFC848;"></i><i
                        class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i></span>
                <br><br>

                <h3>1</h3>

                <span class="step-label">Sélectionnez votre objet <br>et <br>envoyer nous votre demande</span>
            </div>

            <div class="col-md-4" style="text-align:center">
                <span class="fa-stack fa-4x"><i class="fas fa-circle fa-stack-2x " style="color: #FFC848;"></i><i
                        class="fas fa-laptop fa-stack-1x fa-inverse"></i></span>
                <br><br>
                <span class="step-number">
                    <h3>2</h3>
                </span>
                <span class="step-label">Nous vous te confirmons dans les 48h sa disponibilité</span>
            </div>

            <div class="col-md-4" style="text-align:center">
                <span class="fa-stack fa-4x"><i class="fas fa-circle fa-stack-2x " style="color: #FFC848;"></i><i
                        class="fas fa-lock fa-stack-1x fa-inverse"></i></span>
                <br><br>
                <span class=" step-number">
                    <h3>3</h3>
                </span>
                <span class="step-label">Validez votre panier </span>
            </div>
        </div>
    </div>
</div>



<!--------------- Texte de présentation------------------->


<div class="container mt-5" id="bouton_ancre_presentation">

    <br>

    <h1 class="titre">Présentation</h1>

    <p class="presentation">Bienvenue sur notre site internet dédié à la location de matériel
        pour tout type
        d'événement.<br>
        Vous trouverez différents éléments pour embellir votre fête à des prix abordables.<br>
        Bonne visite.
    </p>
</div>





<!-------------------- Les produits----------------------->




<h1 class="titre mt-5">Nos produits</h1>



<div class="container revealmt-3">
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
                        <a aria-label="produits" href="../produits/produits"></a>
                    </figure>
                    <div class="card-body">
                        <h5 class="card-title produit"><?php echo  @$row->titre_image ?></h5>
                        <p class="card-text"></p>
                    </div>

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
                <h4 class="suite_produit">la suite.....</h4>
            </a>
        </div>

    </div>
</div>
<br>




<!--------------- Nos réalisations------------------------>



<br>
<h1 class="titre">Des idées de réalisation</h1>
<br>

<div class="container-fluid reveal">
    <div class="row">

        <div class="col-md-4">
            <div class="card">

                <img src="../images/blog1.jpg" class="card-img-top" alt="mariage">

            </div>


        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="../images/blog2.jpg" class="card-img-top" alt="allee">
            </div>


        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="../images/blog3.jpg" class="card-img-top" alt="table">
            </div>


        </div>
    </div>
</div>



<!------------Formulaire de contact----------------------->



<div class="container mt-5 bg-light reveal" id="formulaire_contact_accueil">

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
        <div class="g-recaptcha formulaire_accueil" data-sitekey="6LeNlNgUAAAAAJDvjCVNXtKfrPUBOMU1kIA7HNmv"> </div>

        <button class="btn btn_color_accueil btn-rounded btn-block my-4 waves-effect z-depth-0" name="forminscription"
            value="ok" type="submit">Envoyer</button>
    </form>

</div>


<br>

<?php
require "../footer/footer.php";
require "../footer/modal.php";
?>