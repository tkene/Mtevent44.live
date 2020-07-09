<?php
ob_start();



require "../connect/connect.php";
require "../fonctions/fonction.php";



$id_user = $_GET["id"];

$promo = $_GET["code_promo"];
// mettre une fonction pour sélectionner tout les informations clients pour envoyer par mail piour résumer
//$paiement_paypal_success = paiement_paypal_success($id_user);


if ($id_user) {
    $paiement_paypal_success = paiement_paypal_success($id_user, $promo);
    foreach ($paiement_paypal_success as $row) {
    }


    //header('location:confirmation_paiement.php?id=' . $id_user);
    header('location:https://www.mtevent44.fr/envoi_mail/envoi_mail_confirmation_paiement_client.php?id_user=' . $id_user . '&nom=' . $row->nom . '&prenom=' . $row->prenom . '&num_facture=' . $row->numero_facture . '&adresse_mail=' . $row->mail . '&code_promo=' . $promo);


    exit();
    ob_end_flush();
}

?>

<?php //include "../footer/footer.php" 
?>