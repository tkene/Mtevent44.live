<?php
ob_start();

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

//Permet d'empecher si un utilisateur n'est pas admin
if ($_SESSION["niv"] != 1) {
    header('Location:../clients/login.php');
}

//Permet de valider si le message est envoyé 
if (isset($_GET["msg"])) {
    $msg_text_envoyé_client = $_GET["msg"];

    if ($msg_text_envoyé_client == "true") {
        $reponse = "message envoyé";
    }
}

if (isset($_POST)) {

    $id_user = htmlspecialchars($_POST["id_user"]);
    $id_user_message = htmlspecialchars($_POST["id_user_message"]);
    $adresse_mail = htmlspecialchars($_POST["mail"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $text_au_client = htmlspecialchars($_POST["text_au_client"]);
    $envoyer_mesage_client = htmlspecialchars($_POST["envoyer"]);


    // Permet d'enoyer un message à l'utilisateur via la partie admin
    if ($envoyer_mesage_client) {
        header('location:../envoi_mail/envoi_mail_admin_compte_client.php?text_message_client=' . $text_au_client . '&nom=' . $nom . '&prenom=' . $prenom . '&mail=' . $adresse_mail . '&id_user1=' . $id_user_message);
        $reponse = "ok";
        ob_end_flush();
        exit();
        //var_dump($envoyer_mesage_client);
    }

    // permet de recuperer les informations en fonction de son id (select)
    if ($id_user) {
        $recup_id_user = recup_id_user($id_user);
    }
}

//recupere la liste des utilisateurs
$liste_user = liste_user();

?>

<h1 class="text-center" style="font-family:'Dancing Script',cursive;"> Compte client</h1><br>






<!-------------------------------------------------------->
<!------------------ SELECT USERS------------------------->
<!-------------------------------------------------------->

<div class="container mt-3">

    <!--------------------------------->
    <!---------- pop up réponse-------->
    <!--------------------------------->

    <div class="text-center" id="haut">
        <?php if (isset($reponse)) {
            echo '<font color="green">' . $reponse . '</font>';
        } ?>
    </div>

    <form action="admin_compte_client.php?#select_users" id="select_users" method="POST">
        <div class="text-center">
            <label class="badge-pill badge-info">Liste des inscripts</label>
            <select name="id_user" onchange="submit()" class="form-control">
                <option value="">Choisir l'utilisateurs pour modification</option>

                <?php foreach ($liste_user as $row) { ?>
                <option value="<?php echo stripslashes($row->id_user); ?>" <?php //permet de rester sur l'option sélectionnée
                                                                                if ($row->id_user == @$_POST["id_user"]) {
                                                                                    echo " selected";
                                                                                } ?>>
                    <?php echo stripslashes($row->nom); ?> <?php echo stripslashes($row->prenom); ?>
                </option>
                <?php } ?>

            </select>
        </div>
    </form>

</div>
<br>
<div class="container mt-3">
    <?php if ($id_user) { ?>

    <div class="table-responsive">

        <table class="table">

            <thead class="thead">
                <tr>
                    <th id="thead_th" scope="col">#</th>
                    <th id="thead_th" scope="col">Nom</th>
                    <th id="thead_th" scope="col">Prenom</th>
                    <th id="thead_th" scope="col">Mail</th>
                    <th id="thead_th" scope="col">Téléphone</th>
                    <th id="thead_th" scope="col">Date d'inscription</th>
                    <th id="thead_th" scope="col">Message</th>


                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>

                <tr>

                    <th scope="row"><?php echo $i++; ?></th>

                    <td> <?php echo $recup_id_user->nom ?></td>
                    <td> <?php echo $recup_id_user->prenom ?></td>
                    <td> <?php echo $recup_id_user->mail ?></td>
                    <td> <?php echo $recup_id_user->phone ?></td>

                    <?php $dateMySQL = ($recup_id_user->date_creat) ?>
                    <td> <?php echo date("d-m-Y", strtotime($dateMySQL)) ?></td>

                    <td>
                        <form action="admin_compte_client.php" method="POST">

                            <input hidden name="id_user_message" value="<?php echo $recup_id_user->id_user; ?>">
                            <input hidden name="mail" value="<?php echo $recup_id_user->mail; ?>">
                            <input hidden name="prenom" value="<?php echo $recup_id_user->prenom; ?>">
                            <input hidden name="nom" value="<?php echo $recup_id_user->nom; ?>">


                            <textarea class="text_au_client" type="text" name="text_au_client"
                                placeholder="Message à envoyer au client"></textarea><br>
                            <label><input class="btn btn-outline-success btn-sm" type="submit" name="envoyer"
                                    value="envoyer"></label>

                        </form>
                    </td>

                </tr>

            </tbody>

        </table>



    </div>

    <?php } ?>



    <br>



    <div class="table-responsive">

        <table class="table">

            <thead class="thead">
                <tr>
                    <th id="thead_th" scope="col">#</th>
                    <th id="thead_th" scope="col">Nom</th>
                    <th id="thead_th" scope="col">Prenom</th>
                    <th id="thead_th" scope="col">Mail</th>
                    <th id="thead_th" scope="col">Téléphone</th>
                    <th id="thead_th" scope="col">Date d'inscription</th>

                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($liste_user as $rowlisteinscrit) { ?>
                <tr>

                    <th scope="row"><?php echo $i++; ?></th>


                    <td> <?php echo $rowlisteinscrit->nom ?></td>
                    <td> <?php echo $rowlisteinscrit->prenom ?></td>
                    <td> <?php echo $rowlisteinscrit->mail ?></td>
                    <td> <?php echo $rowlisteinscrit->phone ?></td>

                    <?php $dateMySQL = (@$rowlisteinscrit->date_creat) ?>
                    <td> <?php echo date("d-m-Y", strtotime($dateMySQL)) ?></td>

                </tr>
                <?php } ?>


            </tbody>

        </table>



    </div>
</div>


<?php

include "../footer/footer.php";
?>