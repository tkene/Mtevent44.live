<?php

$no_cache = uniqid();

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_transaction.php";

// Permet d'empêcher d'accéder s'il n'est pas connecté 
if ($_GET["total"]) {
} else {
    header('location:login.php');
}

$total = $_GET["total"];



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
?>



<body>
    <div class="container">
        <div class="progress">
            <div class="exemple">
                <b class="cercle"></b>
            </div>
            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="container">

        <div class="">

            <!-- <input type="submit" class="btn btn-outline-success" style="width:80%" value="Payer"> -->

            <!-- PayPal payment form for displaying the buy button -->
            <form action="<?php echo PAYPAL_URL; ?>" method="post">

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

                <input type="hidden" name="amount" value="<?php echo $total ?>">

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




</body>

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
                    exercer ces droits via ce lien : <a
                        href="https://www.mtevent44.fr/mention_legale/CGV.php">https://www.mtevent44.fr/mention_legale/CGV</a>,
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>

<!-- JQUERY -->



</html>