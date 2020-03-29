<?php
ob_start();

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if ($_SESSION["niv"] != 1) {
    header('Location:../clients/login.php');
}

@$id_user = $_GET["id_user"];

@$id_user1 = $_GET["id_user1"];
@$id_paiement1 = $_GET["id_paiement1"];


if ($id_user1) {
    $_POST["id_user"] = @$id_user1;
    $_POST["id_paiement"] = @$id_paiement1;
}


//Permet de valider si le message est envoyé 
if (isset($_GET["msg"])) {
    $msg_text_envoyé_client = $_GET["msg"];

    if ($msg_text_envoyé_client == "true") {
        $reponse = "message envoyé";
    }
}

//Permet de valider si le message est envoyé 
if (isset($_GET["relance"])) {
    $relance = $_GET["relance"];

    if ($relance == "true") {
        $reponse = "relance message envoyé";
    }
}

//Permet de valider si le message est envoyé 
if (isset($_GET["msg_refuser"])) {
    $msg_refuser = $_GET["msg_refuser"];

    if ($msg_refuser == "true") {
        $reponse = "Mail de suppression envoyé au client";
    }
}

//Permet de valider si le message est envoyé 
if (isset($_GET["msg_confirmation"])) {
    $msg_confirmation = $_GET["msg_confirmation"];

    if ($msg_confirmation == "true") {
        $reponse = "Produit validé en attente de paiement client";
    }
}



if (isset($_POST)) {

    $id_user = htmlspecialchars($_POST["id_user"]);
    $attente = htmlspecialchars($_POST["attente"]);
    $refuser = htmlspecialchars($_POST["refuser"]);
    $relance = htmlspecialchars($_POST["relance"]);
    $message = htmlspecialchars($_POST["message"]);
    $envoyer = htmlspecialchars($_POST["envoyer"]);
    $id_produit = htmlspecialchars($_POST["id_produit"]);
    $adresse_mail = htmlspecialchars($_POST["mail"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom_produit = htmlspecialchars($_POST["nom_produit"]);

    $message_location = htmlspecialchars($_POST["message_location"]);
    $envoyer_location = htmlspecialchars($_POST["location"]);
    $id_paiement = htmlspecialchars($_POST["id_paiement"]);
    $check = htmlspecialchars($_POST["check"]);
    $supprimer = htmlspecialchars($_POST["supprimer"]);

    @$text_message_client = htmlspecialchars($_POST["text_message_client"]);
    @$envoyer_mesage_client = htmlspecialchars($_POST["envoyer_mesage_client"]);

    @$numero_facture = htmlspecialchars($_POST["numero_facture"]);



    if (@$id_paiement) {
        $recup_info_facture = recup_info_facture($id_paiement);
    }


    //UPDATE message dans la table paiement
    if ($envoyer_location) {
        $table_paiement_commentaire = table_paiement_commentaire($id_user, $id_paiement, $message_location, $check);
        //var_dump($table_paiement_commentaire);
        $reponse = "Commentaire ajouté";
    }

    //UPDATE message dans le panier
    if ($envoyer) {
        message_tableau_bord($id_produit, $id_user, $message);
        $reponse = "Commentaire ajouté";
    }

    //RELANCE client pour le produit
    if ($relance) {
        relance($id_produit, $id_user);
        header('location:../envoi_mail/envoi_mail_relance_client.php?mail=' . $adresse_mail . '&nom=' . $nom . '&prenom=' . $prenom . '&nom_produit=' . $nom_produit . '&id_user1=' . $id_user);
        $reponse = "produit relance et mail envoyé au client";
        ob_end_flush();
        exit();
    }
    //DELETE le produit demandé 
    if ($supprimer) {
        delete_produit_apres_validation($id_produit, $id_user);
        header('location:../envoi_mail/envoi_mail_refuser_indisponnible.php?mail=' . $adresse_mail . '&nom=' . $nom . '&prenom=' . $prenom . '&nom_produit=' . $nom_produit . '&id_user1=' . $id_user);
        //$reponse = "produit supprimer et mail envoyé au client";
        ob_end_flush();
        exit();
    }

    //DELETE le produit demandé
    if ($refuser) {
        delete_produit($id_produit, $id_user);
        header('location:../envoi_mail/envoi_mail_refuser_indisponnible.php?mail=' . $adresse_mail . '&nom=' . $nom . '&prenom=' . $prenom . '&nom_produit=' . $nom_produit . '&id_user1=' . $id_user);
        //$reponse = "produit supprimer et mail envoyé au client";
        ob_end_flush();
        exit();
    }

    //Confirme la disponibilité du produit et attente d'achat du client
    if ($attente) {
        attente_gestion_locative_2($id_produit, $id_user);
        header('location:../envoi_mail/envoi_mail_confirmation.php?mail=' . $adresse_mail . '&nom=' . $nom . '&prenom=' . $prenom . '&nom_produit=' . $nom_produit . '&id_user=' . $id_user);
        //var_dump(attente_gestion_locative_2($id_produit, $id_user));
        //$reponse = "en attente paiement client";
        ob_end_flush();
        exit();
    }

    // Permet d'enoyer un message à l'utilisateur via la partie admin
    if ($envoyer_mesage_client) {
        header('location:../envoi_mail/envoi_mail_admin_message_client.php?text_message_client=' . $text_message_client . '&nom=' . $nom . '&prenom=' . $prenom . '&mail=' . $adresse_mail . '&id_user1=' . $id_user);
        $reponse = "ok";
        ob_end_flush();
        exit();
    }

    // permet de recuperer les informations en fonction de son id (select)
    if ($id_user) {
        $recup_id_user = recup_id_user($id_user);
    }
}

//recupere la liste des utilisateurs
$liste_user = liste_user();

//recupere les informations pour des paiements
if (isset($id_user)) {
    $recup_paiement = recup_paiement($id_user);
    //var_dump($id_paiement);
}


// donne les informations dans le gestion des demande client et en attente de paiement
if (isset($id_user)) {
    $liste_locative = liste_locative_client($id_user);
}

// permet de sélectionner l'ensemble des informations pour la rubrique en attente de traitement
@$liste_client_attente = liste_client_attente();

//permet d'afficher les achats du client par la table paiement
if (isset($id_paiement)) {
    @$liste_paiement = liste_paiement($id_paiement);
}

//permet d'afficher les achats du client par la table paiement
if (isset($id_user)) {
    $affiche_produit_facture = affiche_produit_facture($id_user);
}

// incrémentation pour le tableau
$i = 1;

?>

<!-------------------------------------------------------->
<!------------- statut de la demande :------------------>
<!--------------------
0 ==> panier gerer par le client
1 ==> demande envoyer par le client pour traitement administrateur
2 ==> admin à répondu en attente retour paiement client
3 ==> le client à réglé 
----------------------------------->






<div class="container-fluid mt-3">
    <!-------------------------------------------------------->
    <!------------------------ Titre-------------------------->
    <!-------------------------------------------------------->

    <h1 class="text-center" style="font-family:'Dancing Script',cursive;"> Tableau de bord</h1><br>

    <!--------------------------------->
    <!---------- pop up réponse-------->
    <!--------------------------------->

    <div class="text-center" id="haut">
        <?php if (isset($reponse)) {
            echo '<font color="green">' . $reponse . '</font>';
        } ?>
    </div>
    <!---------------------------------------------------------->
    <!------------- En attente de traitement ------------------->
    <!---------------------------------------------------------->


    <!-- <a class="btn" style="background-color: #143054; color:white" data-toggle="collapse" href="#collapseExample"
        role="button" aria-expanded="false" aria-controls="collapseExample">
        Ouvrir le tableau
    </a> -->

    <!-------------------------------------------------------------->
    <!------------------- Liste des demandes------------------------>
    <!-------------------------------------------------------------->


    <br> <br>

    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center" style="font-family:'Dancing Script',cursive;"> Liste des demandes </h3><br>
            <!-- <div class="collapse" id="collapseExample"> -->


            <div class="table-responsive">
                <table class="table">

                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date de la demande</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Nom / Prenom</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Action</th>
                            <!-- <th scope="col">Validation</th> -->
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($liste_client_attente as $rowdemande) { ?>
                        <?php if (@$rowdemande->confirmation_panier == 1) { ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <?php $date_liste_demande = ($rowdemande->date_de_la_demande) ?>
                            <td><?php echo date("d-m-Y G:i:s", strtotime($date_liste_demande)) ?></td>
                            <td><?php echo $rowdemande->nom_produit; ?></td>
                            <td></strong><?php echo $rowdemande->nom; ?> <?php echo $rowdemande->prenom; ?></td>
                            <td>En attente de traitement</td>
                            <td>

                                <form action="admin_tableau_bord_client.php" method="POST">

                                    <input hidden class="" name="id_produit"
                                        value="<?php echo $rowdemande->id_produit; ?>">
                                    <input hidden class="" name="id_user" value="<?php echo $rowdemande->id_user; ?>">
                                    <input hidden class="" name="mail" value="<?php echo $rowdemande->mail; ?>">
                                    <input hidden class="" name="prenom" value="<?php echo $rowdemande->prenom; ?>">
                                    <input hidden class="" name="nom" value="<?php echo $rowdemande->nom; ?>">
                                    <input hidden class="" name="nom_produit"
                                        value="<?php echo $rowdemande->nom_produit; ?>">


                                    <input name="attente" type="submit" class="btn btn-outline-success btn-sm"
                                        value="Valider demande client"></input>
                                    <br><br>
                                    <input name="refuser" type="submit" class="btn btn-outline-danger btn-sm"
                                        value="refuser"></input>

                                </form>

                            </td>
                        </tr>

                        <?php } ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <!-- </div> -->
        </div>

        <!-------------------------------------------------------------->
        <!------------- Tableau en attente de paiement------------------>
        <!-------------------------------------------------------------->

        <div class="col-md-6">
            <h3 class="text-center" style="font-family:'Dancing Script',cursive;"> Liste en attente de paiement </h3>
            <br>

            <!-- <div class="collapse" id="collapseExample"> -->
            <div class="table-responsive">
                <table class="table">

                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date de traitement</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Nom / Prenom</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Validation</th>
                            <th scope="col">Commentaire</th>
                            <th scope="col">Relancer</th>
                            <!-- <th scope="col">Validation</th> -->
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($liste_client_attente as $row) { ?>
                        <?php if (@$row->confirmation_panier == 2) { ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <?php $date_liste_paiement = ($row->date_de_la_demande) ?>
                            <td><?php echo date("d-m-Y G:i:s", strtotime($date_liste_paiement))  ?></td>
                            <td><?php echo $row->nom_produit; ?></td>
                            <td></strong><?php echo $row->nom; ?> <?php echo $row->prenom; ?></td>
                            <td>En attente de paiement</td>
                            <td>

                                <form action="admin_tableau_bord_client.php" method="POST">

                                    <input hidden class="" name="id_produit" value="<?php echo $row->id_produit; ?>">
                                    <input hidden class="" name="id_user" value="<?php echo $row->id_user; ?>">
                                    <input hidden class="" name="mail" value="<?php echo $row->mail; ?>">
                                    <input hidden class="" name="prenom" value="<?php echo $row->prenom; ?>">
                                    <input hidden class="" name="nom" value="<?php echo $row->nom; ?>">
                                    <input hidden class="" name="nom_produit" value="<?php echo $row->nom_produit; ?>">


                                    <input name="relance" type="submit" class="btn btn-outline-success btn-sm"
                                        value="Relance"></input>
                                    <br><br>
                                    <input name="supprimer" type="submit" class="btn btn-outline-danger btn-sm"
                                        value="supprimer"></input>


                            </td>

                            <td>

                                <textarea class="form-control "
                                    name="message"><?php echo $row->commentaire; ?></textarea>
                                <input name="envoyer" type="submit" class="btn btn-outline-Dark btn-sm"
                                    value="Envoyer"></input>
                                </form>
                            </td>


                            <td><?php echo $row->relance; ?></td>
                        </tr>

                        <?php } ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>

<h1 class="text-center" style="font-family:'Dancing Script',cursive;"> Tableau de bord par client</h1><br>

<div class="container mt-3">

    <!-------------------------------------------------------->
    <!------------------ SELECT USERS------------------------->
    <!-------------------------------------------------------->


    <form action="admin_tableau_bord_client.php?#select_users" id="select_users" method="POST">
        <div class="text-center">
            <label class="badge-pill badge-info">Liste des acheteurs</label>
            <select name="id_user" onchange="submit()" class="form-control">
                <option value="">Choisir le nom et prenom de l'acheteur</option>

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



<div class="container-fluid mt-3">

    <div class="row">

        <!------------------------------------------------------------>
        <!------------- Coordonnées de l'utilisateur------------------>
        <!------------------------------------------------------------>

        <div class="col-md-6">

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


        <!------------------------------------------------------------>
        <!----------------------- Facture client --------------------->
        <!------------------------------------------------------------>

        <div class="col-md-6">

            <h3 class="text-center" style="font-family:'Dancing Script',cursive;"> Facture Clients </h3><br>

            <div class="container">
                <div class="row mt-3">


                    <?php if (isset($id_user)) { ?>
                    <?php foreach (@$recup_paiement as $row) { ?>

                    <?php $date_facture = ($row->date_de_paiement) ?>
                    <p><strong>Date de paiement :</strong> <?php echo date("d-m-Y G:i:s", strtotime($date_facture)) ?>
                    </p>

                    <p> <strong> Numéro de facture : </strong> <?php echo ($row->numero_facture); ?> </p>
                    <a
                        href="../clients/facturation_edition.php?id_user=<?php echo $row->id_user ?>&id_paiement=<?php echo $row->id_paiement ?>"><input
                            class="btn btn-dark btn-sm" value="editer" style="margin-left: 10px;">
                    </a>

                    <?php } ?>
                    <?php } else { ?>
                    <?php echo 'Pas de commande sélectionnée';
                    } ?>
                </div>
            </div>
        </div>

    </div>

</div>




<!------------------------------------------------------------>
<!------------- Les prochaines locations---------------------->
<!------------------------------------------------------------>


<div class="container">

    <h3 class="text-center" style="font-family:'Dancing Script',cursive;"> Location </h3><br>

    <form action="admin_tableau_bord_client.php?#select_locations" id="select_locations" method="POST">

        <!-- Permet de renvoyer les informations pour rester sur la meme personne lors d'un choix -->
        <input type="hidden" name="id_user" value="<?php echo @$_POST["id_user"]; ?>">

        <div class="text-center">
            <label class="badge-pill badge-info">Liste des acheteurs</label>
            <select name="id_paiement" onchange="submit()" class="form-control">
                <option value="">choisir la facture</option>

                <?php foreach (@$recup_paiement as $row) { ?>
                <option value="<?php echo stripslashes($row->id_paiement); ?>" <?php //permet de rester sur l'option sélectionnée
                                                                                    if ($row->id_paiement == @$_POST["id_paiement"]) {
                                                                                        echo " selected";
                                                                                    } ?>>
                    <?php echo stripslashes($row->numero_facture); ?>
                </option>
                <?php } ?>

            </select>
        </div>
    </form>
    <br>

    <div class="table-responsive">

        <table class="table">

            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero de facture</th>
                    <th scope="col">Date de location</th>
                    <th scope="col">Produits</th>
                    <th scope="col">commentaire client</th>
                    <th scope="col">Location faite</th>
                    <th scope="col">Validation</th>

                </tr>
            </thead>


            <tbody>





                <tr>

                    <th scope="row"><?php echo $i++; ?></th>
                    <?php if (isset($id_paiement)) { ?>
                    <td><?php echo @$recup_info_facture->numero_facture ?></td>
                    <?php } ?>

                    <td colspan="2">

                        <table class=" table">
                            <?php if (@$id_paiement != 0) { ?>
                            <?php foreach (@$liste_paiement as $row2) { ?>

                            <tr>
                                <?php $date_location = ($row2->date_demande) ?>
                                <td><?php echo date("d-m-Y", strtotime($date_location)) ?></td>
                                <td><?php echo @$row2->nom_produit; ?></td>



                                <td><a
                                        href="../produits/calendrier.php?id=<?php echo $row2->id_produit ?>&id_user=<?php echo $row2->id_user ?>&id_cat=<?php echo $row2->id_categorie ?>&id_paiement=<?php echo $row2->id_paiement ?>">lien
                                        produit...<a></td>

                    </td>

                </tr>

                <?php }
                            } else {
                            } ?>



        </table>


        </td>

        <form action='admin_tableau_bord_client.php' method='POST'>
            <?php if (@$id_paiement != 0) { ?>

            <td>


                <input hidden name="id_user" value="<?php echo @$recup_info_facture->id_user ?>">
                <input hidden name="id_paiement" value="<?php echo @$recup_info_facture->id_paiement ?>">

                <textarea class="form-control "
                    name="message_location"><?php echo @$recup_info_facture->commentaire; ?></textarea>

            </td>

            <td>

                <?php
                    if (isset($id_paiement)) {
                        if (@$recup_info_facture->recup_par_client == "" || $recup_info_facture->recup_par_client == 1) {
                            $checked1 = "checked";
                        } else {
                            $checked2 = "checked";
                        }
                    }

                    ?>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" <?php echo @$checked1 ?> name="check"
                        id="customRadio1" value="1">
                    <label class="custom-control-label" for="customRadio1">oui</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" <?php echo @$checked2 ?> name="check"
                        id="customRadio2" value="0">
                    <label class="custom-control-label" for="customRadio2">non</label>
                </div>



            </td>

            <td><input name="location" type="submit" class="btn btn-Dark btn-sm" value="envoyer"></input>
            </td>
            <?php } else {
            } ?>
        </form>


        </tr>

        </tbody>
        </table>



    </div>

</div>



<?php $i = 1; ?>

<div class="container-fluid mt-3">

    <div class="row">
        <div class="col-md-6">

            <!-------------------------------------------------------->
            <!------------- en attente de traitement------------------>
            <!-------------------------------------------------------->

            <h3 class="text-center" style="font-family:'Dancing Script',cursive;"> En attente de traitement </h3>
            <br>
            <div class="table-responsive">
                <table class="table">

                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Date de sa demande</th>
                            <th scope="col">Date de Location</th>
                            <th scope="col">Lien produit</th>
                            <th scope="col">Validation</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (isset($id_user)) { ?>
                        <?php foreach (@$liste_locative as $row3) { ?>

                        <?php if (@$row3->confirmation_panier == 1) { ?>

                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $row3->nom_produit; ?></td>

                            <?php $date_attente_traitement = ($row3->date_de_la_demande) ?>
                            <td><?php echo date("d-m-Y G:i:s", strtotime($date_attente_traitement)) ?></td>


                            <?php $date_location_attente = ($row3->date_demande) ?>
                            <td></strong><?php echo date("d-m-Y", strtotime($date_location_attente)) ?></td>


                            <td><a
                                    href="../produits/calendrier.php?id=<?php echo $row3->id_produit ?>&id_user=<?php echo $row3->id_user ?>&id_cat=<?php echo $row3->id_categorie ?>">lien
                                    produit...<a></td>
                            <td>

                                <form action="admin_tableau_bord_client.php" method="POST">

                                    <input hidden class="" name="id_produit" value="<?php echo $row3->id_produit; ?>">

                                    <input hidden class="" name="mail" value="<?php echo $row3->mail; ?>">
                                    <input hidden class="" name="prenom" value="<?php echo $row3->prenom; ?>">
                                    <input hidden class="" name="nom" value="<?php echo $row3->nom; ?>">
                                    <input hidden class="" name="nom_produit" value="<?php echo $row3->nom_produit; ?>">
                                    <input type="hidden" name="id_user" value="<?php echo $_POST["id_user"]; ?>">

                                    <input name="attente" type="submit" class="btn btn-outline-success btn-sm"
                                        value="Valider demande client"></input>
                                    <br><br>
                                    <input name="refuser" type="submit" class="btn btn-outline-danger btn-sm"
                                        value="refuser"></input>

                                </form>

                            </td>
                        </tr>

                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php $i = 1; ?>
        <div class="col-md-6">
            <!-------------------------------------------------------->
            <!------------- en attente de paiement-------------------->
            <!-------------------------------------------------------->

            <h3 class="text-center" style="font-family:'Dancing Script',cursive;"> En attente paiement client </h3>
            <br>
            <div class="table-responsive">
                <table class="table">

                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Date de traitement</th>
                            <th scope="col">Date de Location</th>
                            <th scope="col">Lien produit</th>
                            <th scope="col">Validation</th>
                            <th scope="col">Commentaire</th>
                            <th scope="col">Relancer</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (isset($id_user)) { ?>
                        <?php foreach (@$liste_locative as $row) { ?>

                        <?php if (@$row->confirmation_panier == 2) { ?>

                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $row->nom_produit; ?></td>

                            <?php $date_paiment = ($row->date_de_la_demande) ?>
                            <td><?php echo date("d-m-Y G:i:s", strtotime($date_paiment)) ?></td>
                            <?php $date_location_paiement = ($row->date_demande) ?>
                            <td></strong><?php echo date("d-m-Y", strtotime($date_location_paiement)) ?></td>
                            <td><a
                                    href="../produits/calendrier.php?id=<?php echo $row->id_produit ?>&id_user=<?php echo $row->id_user ?>&id_cat=<?php echo $row->id_categorie ?>">lien
                                    produit...<a></td>
                            <td>

                                <form action="admin_tableau_bord_client.php" method="POST">

                                    <input hidden class="" name="id_produit" value="<?php echo $row->id_produit; ?>">
                                    <input hidden class="" name="id_user" value="<?php echo $row->id_user; ?>">
                                    <input hidden class="" name="mail" value="<?php echo $row->mail; ?>">
                                    <input hidden class="" name="prenom" value="<?php echo $row->prenom; ?>">
                                    <input hidden class="" name="nom" value="<?php echo $row->nom; ?>">
                                    <input hidden class="" name="nom_produit" value="<?php echo $row->nom_produit; ?>">
                                    <input type="hidden" name="id_user" value="<?php echo $_POST["id_user"]; ?>">

                                    <input name="relance" type="submit" class="btn btn-outline-success btn-sm"
                                        value="Relance"></input>
                                    <br><br>
                                    <input name="refuser" type="submit" class="btn btn-outline-danger btn-sm"
                                        value="refuser"></input>


                            </td>

                            <td><textarea class="form-control "
                                    name="message"><?php echo $row->commentaire; ?></textarea>
                                <input name="envoyer" type="submit" class="btn btn-outline-Dark btn-sm"
                                    value="Envoyer"></input>
                            </td>

                            </form>
                            <td><?php echo $row->relance; ?></td>
                        </tr>

                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>


<br>
<?php include "../footer/footer.php"; ?>