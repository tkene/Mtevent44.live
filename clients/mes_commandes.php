<?php
// ob_star() ouverture de traitement et fermeture par ob_start()
ob_start();
include "../connect/connect.php";
include "../fonctions/fonction.php";
include "../header/header.php";


// Permet d'empêcher d'accéder s'il n'est pas connecté 
if (empty($_SESSION["id_user"])) {
    header('Location:login.php');
    ob_end_flush();
}


$id_user = @$_SESSION["id_user"];



// if ($_SESSION["id_user"]) {
// } else {
//     header('Location: login.php');
// }

@$recup_panier_commandes = mes_commandes($id_user);
//var_dump($recup_panier_commandes);
@$recup_paiement = recup_paiement(@$_SESSION["id_user"]);
?>



<div class="container mt-3">
    <h3 class="mes_anciennes_commandes">Mes demandes</h3>
    <br>
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Date de la demande</th>
                    <th scope="col">Nom produit</th>
                    <th scope="col">Date de reservation</th>
                    <th scope="col">Statut de la demande</th>
                </tr>
            </thead>
            <?php foreach ($recup_panier_commandes as $row) { ?>
            <tr>
                <?php if ($row->confirmation_panier != 3) { ?>
                <th scope="row"> <?php echo $row->date_de_la_demande ?></th>
                <td><?php echo $row->nom_produit ?> <a href="produit_entier.php?id=<?php echo  @$row->id_produit ?>"
                        class="text-secondary"> revoir le produit
                    </a></td>
                <td><?php echo $row->date_demande ?></td>
                <td>
                    <?php if ($row->confirmation_panier == 2) {
                            echo "commande validée en attente de paiement";
                        } elseif ($row->confirmation_panier == 0) {
                            echo "non envoyé";
                        } elseif ($row->confirmation_panier == 1) {
                            echo "En cours de traitement";
                        }
                    } ?></td>


            </tr>
            <?php } ?>
        </table>
    </div>



    <br>



    <h3 class="mes_anciennes_commandes">Mes anciennes commandes</h3>

    <?php if (isset($_SESSION["id_user"])) { ?>
    <?php foreach ($recup_paiement as $row) { ?>

    <div class="row mt-5">
        <p><strong>Date de paiement :</strong> <?php echo ($row->date_de_paiement); ?>
        </p> <a
            href="facturation_edition.php?id_user=<?php echo $row->id_user ?>&id_paiement=<?php echo $row->id_paiement ?>"><input
                class="btn btn-dark btn-sm" value="editer" style="margin-left: 10px;"></a>
    </div>

    <?php }
    } else {
        $commande =  "Pas de commande";
    } ?>





    <div class="text-center">

        <?php
        if (isset($commande)) {
            echo '<font color="#848583">' . '<strong>' . $commande . '</strong>' . '</font>';
        } ?>


    </div>



</div>


<?php include "../footer/footer.php" ?>