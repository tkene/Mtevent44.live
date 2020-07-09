<?php

require "../connect/connect.php";
require '../connect/crypt.php';
require "../fonctions/fonction.php";
require "../header/header_facturation_edition.php";

// si y a un id dans l'url je décripte et je le compare à la base de donnée.
if (isset($_GET["id_user"])) {
    $id_user = $_GET["id_user"];

    $var1 = aesDecrypt($id_user);
    //echo $var2;
    if (verification_id($var1)) {
        //echo 'ok tu passes';
        //echo  $verification_id;
    } else {
        //$erreur = "Vous n'avez pas copié le bon lien ou merci de contacter l'administrateur";
        header('location:https://www.mtevent44.fr/404.php');
        ob_end_flush();
    }
} else {
    echo 'Erreur pas id ';
}

$id_user = $_GET['id_user'];
$var1 = aesDecrypt($id_user);

$recup_id_paiement = $_GET['id_paiement'];
$var2 = aesDecrypt($recup_id_paiement);

$recup_code_promo = $_GET['code_promo'];
$var3 = aesDecrypt($recup_code_promo);

//permet de recuperer les informations concernant l'id paiement
$recup_paiement_edition = recup_paiement_edition($var1, $var2);

//permet de recuperer les informations concernant l'id user
$recup_user_edition = recup_user_edition($var1);

//var_dump($recup_user_edition);
$recup_facture_edition = recup_facture_edition($var1, $var2);

// récupere le code promo pour le comparer à la base de donnée
$recup_info_code_promo = recup_info_code_promo($var3);

// selectionne le type de promo
$select = select_type($var3);

// permet de calculer le total :

foreach ($recup_paiement_edition as $row) {

    @$total += $row->prix;
}
// foreach ($recup_paiement_edition as $row) {

//     @$tva += ($row->prix) * 0.20;
// }
foreach ($recup_info_code_promo as $row) {

    $code_promo = $row->valeur_promo;
}






//var_dump($select);
//var_dump($code_promo);
?>



<body class="facturation_edition">




    <!-- <header class="clearfix"> -->

    <div id="logo">
        <img src="../images/logo/Logo_simplifie.png">
    </div>

    <br>
    <h1 class="h1">MT Location FACTURE</h1>

    <div id="company" class="clearfix">
        <div>MT Event</div>
        <div>5B rue de criport,<br /> 44120 Vertou</div>
        <div>06 06 06 06 06</div>
        <div><a class="lien_facturation_edition" href="mailto:company@example.com">mtevenement44@gmail.com</a></div>
    </div>

    <div id="project">
        <?php foreach ($recup_user_edition as $row) { ?>
        <div><span>PROJECT :</span> Location matériel</div>
        <div><span>CLIENT :</span> <?php echo $row->nom ?> <?php echo $row->nom ?></div>
        <!-- <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div> -->
        <div><span>EMAIL :</span> <?php echo $row->mail ?></div>
        <div><span>Telephone :</span><?php echo $row->phone ?> </div>
        <?php } ?>
        <?php foreach ($recup_facture_edition as $row) { ?>
        <div><span>N° facture : </span> <?php echo $row->numero_facture ?> </div>
        <?php    } ?>
    </div>

    <!-- </header> -->

    <main>

        <table class="table">

            <thead>
                <tr>
                    <th class="service">SERVICE</th>
                    <th class="desc" style="padding-left: 70px;padding-right: 70px;">DESCRIPTION</th>
                    <th class="table th">PRIX</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($recup_paiement_edition as $row) { ?>

                <tr>
                    <td class="service"><?php echo $row->nom_produit ?></td>
                    <td class="desc"><?php echo $row->produit_long ?></td>
                    <td class="unit"><?php echo $row->prix ?> €</td>
                    <td class="total">1</td>
                    <td class="unit"><?php echo $row->prix ?> €</td>
                </tr>

                <?php    } ?>

                <tr>
                    <?php foreach ($recup_facture_edition as $row) { ?>
                    <td colspan="4">Date du paiement <?php echo $row->date_de_paiement ?></td>
                    <!-- <td class="total"></td> -->
                    </td>
                    <?php    } ?>
                </tr>



                <tr>
                    <td colspan="4" class="grand total">Sous TOTAL TTC</td>
                    <td class="grand total"><?php echo $total ?> €</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">Code promotion</td>
                    <td class="grand total"><?php if (isset($recup_info_code_promo)) {
                                                if ($select == 1) {
                                                    $valeur_en_pourcentage = (1 - ($code_promo / 100));
                                                    $new_valeur_promo = ($total * $valeur_en_pourcentage);
                                                    echo $new_valeur_promo;
                                                } elseif ($select == 2) {
                                                    $new_valeur_promo = $code_promo;
                                                    echo $new_valeur_promo;
                                                } else {
                                                    echo "0";
                                                }
                                            } ?> €</td>
                </tr>

                <?php $total_avec_promo = ($total - $new_valeur_promo);
                $tva = ($total_avec_promo * 0.20); ?>

                <tr>
                    <td colspan="4" class="grand total">TOTAL TTC</td>
                    <td class="grand total"><?php echo $total_avec_promo; ?> €</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">TVA 20%</td>
                    <td class="grand total"><?php echo $tva ?> €</td>
                </tr>
            </tbody>

        </table>

        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice"></div>
        </div>

    </main>






    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script> -->


    <!--Permet de lancer le bouton impression -->
    <script>
    (function(w, d) {
        'use strict';

        d.querySelector('.imprimer').addEventListener('click', function() {
            w.print();
        }, false);

    }(window, document));
    </script>

</body>

</html>