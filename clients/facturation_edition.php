<?php






$recup_id_user = $_GET['id_user'];
$recup_id_paiement = $_GET['id_paiement'];



require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_facturation_edition.php";



//permet de recuperer les informations concernant l'id paiement
$recup_paiement_edition = recup_paiement_edition($recup_id_user, $recup_id_paiement);
//permet de recuperer les informations concernant l'id user
$recup_user_edition = recup_user_edition($recup_id_user);
//var_dump($recup_user_edition);
$recup_facture_edition = recup_facture_edition($recup_id_user, $recup_id_paiement);



// permet de calculer le total :

foreach ($recup_paiement_edition as $row) {

    @$total += $row->prix;
}
foreach ($recup_paiement_edition as $row) {

    @$tva += ($row->prix) * 0.20;
}


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
                    <th class="table th">PRICE</th>
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
                    <td colspan="4">TVA 20%</td>
                    <td class="total"><?php echo $tva ?> €</td>
                </tr>

                <tr>
                    <td colspan="4" class="grand total">TOTAL TTC</td>
                    <td class="grand total"><?php echo $total ?> €</td>
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