<?php


// ob_star() ouverture de traitement et fermeture par ob_start()
ob_start();
require "../connect/connect.php";
require '../connect/crypt.php';
require "../fonctions/fonction.php";
require "../header/header_transaction.php";

@$id_user = $_SESSION["id_user"];
// $var_total = $_GET["total"];
// Permet d'empêcher d'accéder s'il n'est pas connecté 
// if ($_GET["total"]) {
// } else {
//     header('location:https://www.mtevent44.fr/clients/login.php');
// }


// decrypt les informations dans l'url
if (isset($_GET["total"])) {
    $var2 = $_GET["total"];

    $total_decrypt = aesDecrypt($var2);
}

// decrypt les informations dans l'url
if (isset($_GET["total_new"])) {
    $total_new = $_GET["total_new"];

    $total_new = aesDecrypt($total_new);
}

// decrypt les informations dans l'url
if (isset($_GET["balance"])) {
    $balance = $_GET["balance"];

    $promotion_balance = aesDecrypt($balance);
}

// decrypt les informations dans l'url
if (isset($_GET["rdt"])) {
    $rdt = $_GET["rdt"];

    $type_rdt = aesDecrypt($rdt);
}

// récupére le code promotion pour le paiement
if (isset($_GET["code_promo"])) {
    $code_promotion = $_GET["code_promo"];
}

$type_promo = type_promo($type_rdt);

// afficher les produits du panier
$recup_panier = recup_panier($id_user);

//$select_promo = select($promo);

if (isset($_POST)) {

    $promo = htmlspecialchars($_POST["promo"]);
    $total = htmlspecialchars($_POST["total"]);
    $valider = htmlspecialchars($_POST["valider"]);


    // selectionne le montant minimum d'achat
    $verif_montant_promo = verif_montant_promo($promo);


    // selectionne le type de promo
    $select = select($promo);


    // selectionne actif promo
    $actif_promo = actif_promo($promo);


    // selectionne la valeur promo 
    $valeur_promo = valeur_promo($promo);
    $prix = (1 - ($valeur_promo / 100));



    // comparaison date 
    $date_du_jour = date('Y-m-d');
    $date_debut_promo = date_debut_promo($promo);
    $date_fin_promo = date_fin_promo($promo);



    if ($valider) {

        if ($promo == verif_code_promo($promo)) {
            sleep(1);
            if (actif_promo($promo) == 1) {

                if ($verif_montant_promo <= $total) {
                    if ($date_debut_promo <= $date_du_jour) {
                        if ($date_fin_promo >= $date_du_jour) {

                            //echo "tu passes";
                            if ($select == 1) {
                                echo "prix en valeur";

                                $new_total = $total * $prix;

                                //    var_dump($new_total);
                                $var_crypt_new = aesEncrypt($new_total);
                                $var_crypt = aesEncrypt($total);
                                $crypt_valeur_promo = aesEncrypt($valeur_promo);
                                $var_crypt_select = aesEncrypt($promo);

                                header('location:https://www.mtevent44.fr/clients/transaction.php?total_new=' . $var_crypt_new . '&total=' . $var_crypt . '&balance=' . $crypt_valeur_promo . '&msg_code_valide=true&rdt=' . $var_crypt_select . '&code_promo=' . $promo);
                                // Permet de fermer le ob_start
                                ob_end_flush();
                            } elseif ($select == 2) {
                                echo "prix en valeur";

                                $new_total =  $total - $valeur_promo;

                                //var_dump($new_total);
                                $var_crypt = aesEncrypt($total);
                                $var_crypt_new = aesEncrypt($new_total);
                                $crypt_valeur_promo = aesEncrypt($valeur_promo);
                                $var_crypt_select = aesEncrypt($promo);
                                header('location:https://www.mtevent44.fr/clients/transaction.php?total_new=' . $var_crypt_new . '&total=' . $var_crypt . '&balance=' . $crypt_valeur_promo . '&msg_code_valide=true&rdt=' . $var_crypt_select . '&code_promo=' . $promo);
                                // Permet de fermer le ob_start
                                ob_end_flush();
                            }
                        } else {
                            $var_crypt = aesEncrypt($total);
                            header('location:https://www.mtevent44.fr/clients/transaction?total=' . $var_crypt . '&msg_code_promo=false');
                            // Permet de fermer le ob_start
                            ob_end_flush();
                        }
                    } else {
                        $var_crypt = aesEncrypt($total);
                        header('location:https://www.mtevent44.fr/clients/transaction?total=' . $var_crypt . '&msg_code_promo=false');
                        // Permet de fermer le ob_start
                        ob_end_flush();
                    }
                } else {
                    $var_crypt = aesEncrypt($total);
                    // //echo "montant insuffisant";
                    header('location:https://www.mtevent44.fr/clients/transaction?total=' . $var_crypt . '&msg_montant_promo=false');
                    // Permet de fermer le ob_start
                    ob_end_flush();
                }
            } else {
                $var_crypt = aesEncrypt($total);
                header('location:https://www.mtevent44.fr/clients/transaction?total=' . $var_crypt . '&msg_code_promo=false');
                // Permet de fermer le ob_start
                ob_end_flush();
            }
            //echo "code promo non valide";}
        } else {
            $var_crypt = aesEncrypt($total);
            header('location:https://www.mtevent44.fr/clients/transaction?total=' . $var_crypt . '&msg_code_promo=false');
            // Permet de fermer le ob_start
            ob_end_flush();
            //echo "code promo non valide";
        }
    }
}


// =================================
/* 
 * PayPal and database configuration 
 */
// =================================


// PayPal configuration 
define('PAYPAL_ID', 'sb-magdt976762@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'https://www.mtevent44.fr/clients/success.php?id=' . $_SESSION["id_user"] . '&code_promo=' . $code_promotion);
define('PAYPAL_CANCEL_URL', 'https://www.mtevent44.fr/clients/cancel.php?id=' . $_SESSION["id_user"] . '');
// define('PAYPAL_NOTIFY_URL', 'http://localhost/paypal/ipn.php');
define('PAYPAL_CURRENCY', 'EUR');


// Change not required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" :
    "https://www.paypal.com/cgi-bin/webscr");
?>



<body>

    <!----------------------------------------------->
    <!--  En tête de la page tunnel de progression -->
    <!----------------------------------------------->





    <div class="container mt-3" id="gestion_commande_client">
        <div class="row">
            <div class="col-md-4" style="text-align:left">

                <i class="fas fa-shopping-cart fa-3x " style="color:#143054;" alt="panier"></i>

                </b><br><br>
                <span class="step-number">
                    <h3>1</h3>
                </span>
                <span class="step-label">Ton panier</span>
            </div>

            <div class="col-md-4" style="text-align:center">
                <i class="fas fa-caret-square-right fa-3x" style="color:#143054;" alt="paiement"></i><br><br>
                <span class="step-number">
                    <h3>2</h3>
                </span>
                <span class="step-label">Valider ton panier </span>
            </div>

            <div class="col-md-4" style="text-align:right">
                <i class="fas fa-check fa-3x" style="color:#143054;" alt="paiement validé"></i>
                <br><br>
                <span class="step-number">
                    <h3>3</h3>
                </span>
                <span class="step-label"> Paiement validé </span>
            </div>
        </div>
    </div>

    <br>

    <!----------------------------------------------->
    <!--------------  Barre de progression ----------->
    <!----------------------------------------------->

    <div class="container">

        <div class="progress">

            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                aria-valuemin="0" aria-valuemax="100"></div>

        </div>
    </div>
    <!----------------------------------------------->
    <!--------------  Résume des articles ----------->
    <!----------------------------------------------->

    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <?php foreach ($recup_panier as $row) { ?>
                <?php if ($row->confirmation_panier == 2) { ?>

                <div class="card mt-3">
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


                        </div>
                    </div>
                </div>

                <?php } ?>
                <?php } ?>

            </div>


            <!----------------------------------------------->
            <!-----------------  Panier Total --------------->
            <!----------------------------------------------->


            <div class="col-sm-4">


                <table class="table">
                    <thead>

                        <!-- total du panier -->
                        <tr>
                            <th scope="col">Total articles TTC</th>
                            <th scope="col"><?php if (isset($total_decrypt)) { ?>
                                <?php echo $total_decrypt;
                                            } ?> €</th>

                        </tr>

                        <!-- total réduction -->
                        <tr>
                            <th>Réduction</th>
                            <th><?php if (isset($promotion_balance)) {  ?>
                                <?php if ($type_promo == 1) { ?>
                                <?php echo $promotion_balance; ?>%<?php } elseif ($type_promo == 2) {
                                                                            echo $promotion_balance; ?> €<?php } ?>
                                <?php } else {
                                        echo "0"; ?>€<?php
                                                    } ?>
                            </th>

                        </tr>

                        <!-- Total du panier -->
                        <tr>
                            <th>Total</th>
                            <th><?php if (isset($total_new)) {
                                    echo $total_new;
                                } else {
                                    echo $total_decrypt;
                                } ?> €</th>
                        </tr>

                        <!-- form code promo -->
                        <form action="transaction.php" method="post">
                            <tr>
                                <th>Code promotion<br>
                                    <input type="text" name="promo" onkeyup="this.value=this.value.toUpperCase()">
                                    <input hidden type="number" name="total"
                                        value="<?php echo stripslashes($total_decrypt); ?>">
                                </th>
                                <th><input class="btn btn-info" type="submit" name="valider" value="valider"></th>
                            </tr>
                        </form>

                    </thead>
                </table>



                <!----------------------------------------------->
                <!----------------  Bouton Paypal --------------->
                <!----------------------------------------------->

                <div>
                    <!-- PayPal payment form for displaying the buy button -->
                    <form class="boutton_form" action="<?php echo PAYPAL_URL; ?>" method="post">

                        <!-- <div>A PAYER 100 Euro</div> -->


                        <!-- Identify your business so that you can collect the payments. -->
                        <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                        <!-- Specify a Buy Now button. -->
                        <input type="hidden" name="cmd" value="_xclick">

                        <!-- Specify details le nom de la personne. -->
                        <?php if (isset($_SESSION["id_user"])) { ?>
                        <input type="hidden" name="item_name"
                            value="<?php echo @$_SESSION["nom"], ' ', @$_SESSION["prenom"]; ?>">
                        <?php } ?>

                        <!-- Si IPN retour id_user -->
                        <input type="hidden" name="item_number" value="<?php echo $_SESSION["id_user"] ?>">
                        <!-- Somme a envoyer a Paypal -->

                        <input type="hidden" name="amount" value="<?php if (isset($total_new)) {
                                                                        echo $total_new;
                                                                    } else {
                                                                        echo $total_decrypt;
                                                                    } ?>">

                        <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

                        <!-- Specify URLs -->
                        <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                        <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                        <!-- <input type="hidden" name="notify_url" value="<?php // echo PAYPAL_NOTIFY_URL; 
                                                                            ?>"> -->

                        <!-- Display the payment button. -->
                        <input type="submit" name="submit" class="btn btn-outline-success" value="Payer par Paypal">

                    </form>

                </div>

            </div>
        </div>
    </div>
    <br>



</body>

<!----------------------------------------------->
<!-----------------  Panier Total --------------->
<!----------------------------------------------->

<nav class="navbar navbar-expand-lg">

    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarText2"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span><i class="fas fa-align-justify"></i>
    </button>

    <br>

    <div class="container">
        <div class="collapse navbar-collapse" id="navbarText2">

            <div>
                <p class="condition_transaction"> Les informations demandées sont nécessaires à la société MTevent44
                    pour le
                    traitement de votre
                    Commande. Vous disposez d'un droit d'accès, de rectification, d’effacement et dans certaines
                    conditions,
                    de portabilité, de limitation et d’opposition au traitement de vos données personnelles. Vous pouvez
                    exercer ces droits via ce lien : <a href="https://www.mtevent44.fr/mention_legale/CGV.php"
                        target="_blank">https://www.mtevent44.fr/mention_legale/CGV</a>,
                    conformément aux
                    conditions prévues par la Politique de protection des données . Vous disposez également de la
                    possibilité de déposer une réclamation auprès de la CNIL.

                </p>

            </div>

        </div>
    </div>

</nav>


<!-- icone fontawesome -->
<script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>

<!-- Bottstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<!-- promo erreur de code promo -->

<?php if (isset($_GET["msg_code_promo"])) {
    $msg_code_promo = $_GET["msg_code_promo"];

    if ($msg_code_promo == "false") { ?>

<script>
$(document).ready(function() {
    $('#msg_code_promo').modal('show');
});
</script>

<?php }
} ?>


<!-- promo total insuffisant -->

<?php if (isset($_GET["msg_montant_promo"])) {
    $msg_montant_promo = $_GET["msg_montant_promo"];

    if ($msg_montant_promo == "false") { ?>

<script>
$(document).ready(function() {
    $('#msg_montant_promo').modal('show');
});
</script>

<?php }
} ?>

<!-- promo 
 -->

<?php if (isset($_GET["msg_code_valide"])) {
    $msg_code_valide = $_GET["msg_code_valide"];

    if ($msg_code_valide == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg_code_valide').modal('show');
});
</script>

<?php }
} ?>

</html>

<?php require "../footer/modal.php" ?>