<?php

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";


if ($_SESSION["niv"] != 1) {
    header('Location:../clients/login.php');
}


if ($_POST) {

    $id_user = htmlspecialchars($_POST["id_user"]);
}


?>

<h1 class="text-center" style="font-family:'Dancing Script',cursive;"> Compte client</h1><br>


<!------------------------------>
<!---------- select user-------->
<!------------------------------>
<div class="container-fluid mt-3">

    <br>
    <h3 class="text-center" style="font-family:'Dancing Script',cursive;">Coordonnées de l'utilisateur</h3>
    <label>Nom : <?php echo @$recup_id_user->nom ?></label><br>
    <label>Prenom : <?php echo @$recup_id_user->prenom ?></label><br>
    <label>mail : <?php echo @$recup_id_user->mail ?></label><br>

    <label>téléphone : <?php echo @$recup_id_user->phone ?></label><br>

    <?php $dateMySQL = (@$recup_id_user->date_creat) ?>
    <label>Date d'inscription : <?php echo date("d-m-Y", strtotime($dateMySQL)) ?></label>

    <br><br>
    <form action="admin_tableau_bord_client.php" method="POST">
        <?php if (isset($recup_id_user)) { ?>
        <input hidden class="" name="id_user" value="<?php echo $recup_id_user->id_user; ?>">
        <input hidden class="" name="mail" value="<?php echo $recup_id_user->mail; ?>">
        <input hidden class="" name="prenom" value="<?php echo $recup_id_user->prenom; ?>">
        <input hidden class="" name="nom" value="<?php echo $recup_id_user->nom; ?>">
        <?php } ?>
        <div>
            <textarea class="text_message_client" type="text" name="text_message_client"
                placeholder="Message à envoyer"></textarea><br>
            <label><input type="submit" name="envoyer_mesage_client" value="envoyer"></label>
        </div>
    </form>
</div>

<?php

include "../footer/footer.php";
?>