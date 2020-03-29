<?php
ob_start();



include "../connect/connect.php";
include "../fonctions/fonction.php";



@$id_user = $_GET["id"];
// mettre une fonction pour sélectionner tout les informations clients pour envoyer par mail piour résumer
//$paiement_paypal_success = paiement_paypal_success($id_user);


if ($id_user) {
    $paiement_paypal_success = paiement_paypal_success($id_user);
    foreach ($paiement_paypal_success as $row) {
    }
    //header('location:confirmation_paiement.php?id=' . $id_user);
    header('location:https://www.mtevent44.fr/envoi_mail/envoi_mail_confirmation_paiement_client.php?id_user=' . $id_user . '&nom=' . $row->nom . '&prenom=' . $row->prenom . '&num_facture=' . $row->numero_facture . '&adresse_mail=' . $row->mail);


    exit();
    ob_end_flush();
}

?>

<?php //include "../footer/footer.php" 
?>