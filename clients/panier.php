<?php
// ob_star() ouverture de traitement et fermeture par ob_start()
ob_start();


require "../connect/connect.php";
require '../connect/crypt.php';
require "../fonctions/fonction.php";
require "../header/header.php";


@$id_user = $_SESSION["id_user"];
@$nom_prenom = $_SESSION["nom_prenom"];
@$nom_prenom = $_SESSION["prenom"];

// Permet d'empêcher d'accéder s'il n'est pas connecté 
if (empty($_SESSION["id_user"])) {
    header('Location:../clients/login.php');
    // Permet de fermer le ob_start
    ob_end_flush();
}


// =================================
/* 
 * PayPal and database configuration 
 */
// =================================


// PayPal configuration 
define('PAYPAL_ID', 'sb-magdt976762@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'https://www.mtevent44.fr/clients/success.php?id=' . $_SESSION["id_user"] . '');
define('PAYPAL_CANCEL_URL', 'https://www.mtevent44.fr/clients/cancel.php?id=' . $_SESSION["id_user"] . '');
// define('PAYPAL_NOTIFY_URL', 'http://localhost/paypal/ipn.php');
define('PAYPAL_CURRENCY', 'EUR');


// Change not required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" :
    "https://www.paypal.com/cgi-bin/webscr");




if ($_POST) {

    @$retirer = htmlspecialchars($_POST["retirer"]);
    @$id_produit = htmlspecialchars($_POST["id_produit"]);
    @$envoi_demande_client = htmlspecialchars($_POST["envoi"]);
    @$id_user = htmlspecialchars($_POST["id_user"]);
    @$nom = htmlspecialchars($_POST["nom"]);
    @$prenom = htmlspecialchars($_POST["prenom"]);
    @$nom_produit = htmlspecialchars($_POST["nom_produit"]);


    @$submit = htmlspecialchars($_POST["submit"]);


    // var_dump($_POST);



    if ($retirer) {
        retirer($id_produit);
        $erreur = "Votre produit est bien retiré !";
        @header('location:../clients/panier.php');
        //var_dump(retirer($id_produit));
    }

    if ($envoi_demande_client) {
        $rep = attente_de_traitement($id_user, $id_produit);

        header('location:https://www.mtevent44.fr//envoi_mail/envoi_mail_client_demande.php?id_user=' . $id_user . '&nom=' . $nom . '&prenom=' . $prenom . '&nom_produit=' . $nom_produit);
        // var_dump($rep);
        $valide = "Merci pour votre demande nous vous fairons un retour au plus vite !";
    }
}


@$recup_panier = recup_panier($id_user);

// permet de calculer le total :

foreach ($recup_panier as $row_prix) {
    if ($row_prix->confirmation_panier == 2) {
        @$total += $row_prix->prix;
    }
}



?>



<br>

<h3 class="titre">Valider votre panier en 3 étapes</h3>

<br>

<div class="container mt-3" id="gestion_commande_client">
    <div class="row">
        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_selection.png" alt=""><br><br>
            <span class="step-number">
                <h3>1</h3>
            </span>
            <span class="step-label">Envoyez vos demandes pour <br>chaque produit souhaité</span>
        </div>

        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_quantite.png" alt=""><br><br>
            <span class="step-number">
                <h3>2</h3>
            </span>
            <span class="step-label">Nous vérifions la disponibilité <br>de vos produits </span>
        </div>

        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_valider.png" alt=""><br><br>
            <span class="step-number">
                <h3>3</h3>
            </span>
            <span class="step-label">Paiement pour validation </span>
        </div>
    </div>
</div>

<div class="container mt-5">

    <div class="text-center" id='valide'>
        <?php
        if (isset($erreur)) {
            echo '<font color="red">' . '<strong>' . $erreur . '</strong>' . '</font>';
        } ?>

        <?php
        if (isset($valide)) {
            echo '<font color="green">' . '<strong>' . $valide . '</strong>' . '</font>';
        } ?>


    </div>

</div>



<div class="container mt-5">
    <div class="row">

        <div class="col-sm-12">
            <div class="row">


                <!-------------------------------------------------------------------------------------------------------->
                <!-------------------------------Produit sélectionné par le client  -------------------------------------->
                <!-------------------------------------------------------------------------------------------------------->

                <div class="col-md-4">

                    <div class="card" style="border:none; ">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align:center">Vos produits sélectionnés</h5>
                            <p style="text-align: center">(Article non envoyé)</p>

                            <div class="trait"></div>
                            <br>

                            <div class="container">
                                <div class="row-cols-md">

                                    <?php foreach ($recup_panier as $row) { ?>



                                    <?php if ($row->confirmation_panier == 0) { ?>

                                    <div class="card-deck mt-3">
                                        <div class="card">

                                            <div class="card-body">



                                                <h5 class="card-title"><?php echo  @$row->nom_produit ?></h5>
                                                <p class="card-text" name="prix">Prix : <?php echo  @$row->prix ?> €
                                                </p>


                                                <p> Statut de votre demande : <strong><?php if ($row->confirmation_panier == 2) {
                                                                                                    echo "votre date est validée";
                                                                                                } elseif ($row->confirmation_panier == 0) {
                                                                                                    echo "Envoyez nous votre demande pour traitement";
                                                                                                } elseif ($row->confirmation_panier == 1) {
                                                                                                    echo "votre demande est en cour de traitement";
                                                                                                } else {
                                                                                                    echo "Désolé votre date n'est plus disponible";
                                                                                                } ?></strong>




                                                    <p>Date de votre demande :<br>
                                                        <?php $date_demande_produits = $row->date_demande ?><?php echo date("d-m-Y", strtotime($date_demande_produits)) ?>
                                                    </p>
                                                    <a href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo  @$row->id_produit ?>"
                                                        class="text-secondary"> retour au
                                                        produit
                                                    </a>
                                            </div>

                                            <div class="card-footer">

                                                <div class="text-center">

                                                    <form action="panier.php?#valide" method="POST">

                                                        <input hidden name="id_produit"
                                                            value="<?php echo  @$row->id_produit ?>">
                                                        <input hidden name="id_user"
                                                            value="<?php echo  @$row->id_user ?>">
                                                        <input hidden name="nom_produit"
                                                            value="<?php echo  @$row->nom_produit ?>">
                                                        <input hidden name="nom" value="<?php echo  @$row->nom ?>">
                                                        <input hidden name="prenom"
                                                            value="<?php echo  @$row->prenom ?>">

                                                        <input type="submit" name="envoi"
                                                            class="btn btn-outline-success" style="width:80%"
                                                            value="Envoyer">
                                                        <br> <br>
                                                        <input type="submit" name="retirer"
                                                            class="btn btn-outline-danger btn-sm" value="Retirer">

                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <?php } ?>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <!------------------------------------------------------------------------------------------->
                <!-------------------------------Statut demande client -------------------------------------->
                <!------------------------------------------------------------------------------------------->
                <div class="col-md-4">

                    <div class="card" style="border:none; ">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align:center">Statut de vos demandes</h5>
                            <p style="text-align: center">(Article envoyé)</p>
                            <div class="trait"></div>
                            <br>




                            <div class="container">
                                <div class="row-cols-md">

                                    <?php foreach ($recup_panier as $row) { ?>


                                    <?php if ($row->confirmation_panier == 1) { ?>

                                    <div class="card-deck mt-3 alert alert-warning ">
                                        <div class="card">

                                            <div class="card-body">

                                                <h5 class="card-title" style="text-align: center">
                                                    <?php echo  @$row->nom_produit ?></h5>
                                                <p class="card-text" name="prix">Prix : <?php echo  @$row->prix ?> €
                                                </p>

                                                <p class="card-text">Date de votre demande :
                                                    <?php $date_demande = @$row->date_demande ?>
                                                    <?php echo date("d-m-Y", strtotime($date_demande)) ?>
                                                </p>
                                                <a href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo  @$row->id_produit ?>"
                                                    class="text-secondary"> revoir le produit
                                                </a>
                                            </div>

                                            <div class="card-footer">

                                                <div class="text-center">
                                                    <p> Statut de votre demande : <strong><?php if ($row->confirmation_panier == 2) {
                                                                                                        echo "votre date est validée";
                                                                                                    } elseif ($row->confirmation_panier == 0) {
                                                                                                        echo "Envoyez nous votre demande pour Vérification";
                                                                                                    } elseif ($row->confirmation_panier == 1) {
                                                                                                        echo "votre demande est en cour de traitement";
                                                                                                    } else {
                                                                                                        echo "Désolé votre date n'est plus disponible";
                                                                                                    } ?></strong>


                                                        <form action="panier.php" method="POST">

                                                            <input hidden name="id_produit" class=""
                                                                value="<?php echo  @$row->id_produit ?>">

                                                            <input type="submit" name="retirer"
                                                                class="btn btn-outline-danger btn-sm" value="Retirer">

                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php } ?>

                                    <?php if ($row->confirmation_panier == 2) { ?>

                                    <div class="card-deck mt-3 alert alert-success">
                                        <div class="card">

                                            <div class="card-body">

                                                <h5 class="card-title" style="text-align: center">
                                                    <?php echo  @$row->nom_produit ?></h5>
                                                <p class="card-text" name="prix">Prix : <?php echo  @$row->prix ?> €
                                                </p>

                                                <p class="card-text">Date de votre demande :
                                                    <?php $date_demande = @$row->date_demande ?>
                                                    <?php echo date("d-m-Y", strtotime($date_demande)) ?>
                                                </p>
                                                <a href="https://www.mtevent44.fr/produits/produit_entier.php?id=<?php echo  @$row->id_produit ?>"
                                                    class="text-secondary"> revoir le produit
                                                </a>
                                            </div>

                                            <div class="card-footer">

                                                <div class="text-center">
                                                    <p> Statut de votre demande : <strong><?php if ($row->confirmation_panier == 2) {
                                                                                                        echo "votre date est validée";
                                                                                                    } elseif ($row->confirmation_panier == 0) {
                                                                                                        echo "Envoyez nous votre demande pour Vérification";
                                                                                                    } elseif ($row->confirmation_panier == 1) {
                                                                                                        echo "votre demande est en cour de traitement";
                                                                                                    } else {
                                                                                                        echo "Désolé votre date n'est plus disponible";
                                                                                                    } ?></strong>


                                                        <form action="panier" method="POST">

                                                            <input hidden name="id_produit" class=""
                                                                value="<?php echo  @$row->id_produit ?>">

                                                            <input type="submit" name="retirer"
                                                                class="btn btn-outline-danger btn-sm" value="Retirer">

                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php } ?>

                                    <?php } ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!------------------------------------------------------------------------------------------------>
                <!-------------------------------Validation admin et client  -------------------------------------->
                <!------------------------------------------------------------------------------------------------->
                <div class="col-md-4">


                    <!---------------------------------------------------------------------------->
                    <!-------------------------------Panier--------------------------------------->
                    <!---------------------------------------------------------------------------->

                    <!-- <div class="panier_client" id="volet_clos">
                        <div class="panier_client" id="volet"> -->

                    <!---------------------------------------------------------------------------->
                    <!-------------------------------Total- -------------------------------------->
                    <!---------------------------------------------------------------------------->

                    <!-- <div class="panier_total"> -->
                    <div class="card-body">
                        <h5 class="card-title" style="text-align:center">A PAYER</h5>
                        <p style="text-align: center"><i class="fas fa-chevron-down fa-1x"></i></p>
                        <div class="trait"></div>
                    </div>


                    <br>

                    <div class="container">

                        <p>Total (TTC) :
                            <?php if (isset($total)) { ?>
                            <?php echo $total; ?> €</p>
                        <?php $var1 = aesEncrypt($total); ?>

                        <div class="">

                            <a class="btn btn-info" href="../clients/transaction?total=<?php echo $var1; ?>"
                                value="">Valider le panier</a>

                            <?php } else {
                                echo "0 €";
                            } ?>


                        </div>
                        <!---------------------------------------------------------------------------->
                        <!-------------------------------Paiement Paypal------------------------------>
                        <!---------------------------------------------------------------------------->

                        <div class="container">

                            <div class="text-center">
                                <p>Moyen de paiement : </p>
                                <i class="fab fa-cc-paypal fa-2x"></i>
                            </div>
                        </div>


                        <!-- 
                            </div>

                            <a href="panier.php#volet" class="ouvrir" aria-hidden="true">Panier</a>
                            <a href="panier.php#volet_clos" class="fermer" aria-hidden="true">fermer !</a>
                        </div> -->
                    </div>


                </div>



            </div>

        </div>
    </div>

</div>




<?php require "../footer/footer.php" ?>