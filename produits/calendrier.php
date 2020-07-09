<?php

// ob_star() ouverture de traitement et fermeture par ob_start()
ob_start();

//page: calendrier.php
//session_start(); //pour maintenir la session active
//connexion à la base de données:

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";
//page: calendrier.php
//session_start(); //pour maintenir la session active

@$id_user_admin = $_GET["id_user"];
@$id_user = $_SESSION["id_user"];


@$id_produit = $_GET["id"];
@$id_cat = $_GET["id_cat"];
@$id_paiement_pour_admin = $_GET["id_paiement"];




$verif_doublon_article_user = verif_doublon_article_user($id_user, $id_produit);
//$verif_doublon_article_produit = verif_doublon_article_produit($id_produit);
//var_dump($verif_doublon_article_user);
//var_dump($verif_doublon_article_produit);
// var_dump($id_product);
// var_dump($id_user);

if ($_POST) {

    @$demande = htmlspecialchars($_POST["demande"]);
    @$ajouter = htmlspecialchars($_POST["ajouter"]);
    @$id_product = $_GET["id"];
    @$id_user = $_SESSION["id_user"];

    // if ($envoi) {
    //envoi_demande($demande, $id_produit, $id_user);
    //     $sup = "Merci pour votre demande de réservation nous vous répondrons dans les plus brefs délais";
    // }

    if ($ajouter) {

        if ($verif_doublon_article_user) {
            header('Location: ../produits/calendrier.php?id=' . $id_produit . '&id_cat=' . $id_cat . '&msg_calendrier=false');
            ob_end_flush();
            //$erreur = "produit déjà reservé pour changer la date supprimer l'article de votre panier";
        } else {
            ajout_produit($id_product, $id_user, $demande);

            header('Location: ../produits/calendrier.php?id=' . $id_produit . '&id_cat=' . $id_cat . '&msg_calendrier_ajoute=true');
            ob_end_flush();
            //$sup = "produit rajouté au panier";
        }
    }
}



//connexion à la base de données:


$NomDeSessionAdmin = "nomdesession"; //mettre ici le nom de $_SESSION de votre site quand l'administrateur est connecté
/*
* Module de connexion/déconnexion simplifié.
* Vous pouvez adapter une variable de session de votre site afin de supprimer ce module
*/

$MotDePasse = "votremotdepasse"; //mettre ici un mot de passe
//pour vous connecter, entrez votresite.tld/calendrier.php?connexion=votremotdepasse
if (@$_SESSION["niv"] == 1) {
    if (isset($_GET['connexion'])) {
        if ($_GET['connexion'] == $MotDePasse) {
            $_SESSION[$NomDeSessionAdmin] = 1;
            echo "Connecté avec succès!";
        }
    }
    if (isset($_GET['deconnexion'])) {
        unset($_SESSION[$NomDeSessionAdmin]);
        echo "Déconnecté avec succès!";
    }
    // if (isset($_SESSION[$NomDeSessionAdmin])) {
    //     echo '<p><a style="letter-spacing:0.5px;" href="?deconnexion">Déconnexion</a></p>';
    // }
}
/*
* Fin du module de connexion/déconnexion
*/

$jours = array(1 => "Lu", 2 => "Ma", 3 => "Me", 4 => "Je", 5 => "Ve", 6 => "Sa", 0 => "Di");
if (isset($_GET['annee']) and preg_match("#^[0-9]{4}$#", $_GET['annee'])) { //si on souhaite afficher une autre année, on l'affiche si elle est correcte
    $annee = $_GET['annee'];
} else {
    $annee = date("Y"); //si non, on affiche l'année actuelle
}
$NbrDeJour = [];
for ($mois = 1; $mois <= 12; $mois++) {
    $NbrDeJour[$mois] = date("t", mktime(1, 1, 1, $mois, 2, $annee));
    $PremierJourDuMois[$mois] = date("w", mktime(5, 1, 1, $mois, 1, $annee));
}

// <-------recuperation de la fonction des informations produits ----------->
@$recup_des_produits = produit_unique_entier($id_produit);


@$recup_produit_calendrier = recup_produit_calendrier($id_produit, $id_cat);
//var_dump($recup_produit_calendrier);




// <!-------------------------------------------------------->
// <!--------- fonction pour la page calendrier-------------->
// <!-------------------------------------------------------->



function insert_calendrier($annee, $mois, $jour, $id_produit, $id_user_admin)
{
    global $connection;

    @$id_user_admin = $_GET["id_user"];
    $id_produit = $_GET["id"];
    //$id_user = $_SESSION["id_user"];
    //var_dump($id_user_admin);
    $sql = "INSERT INTO calendrier SET date='" . $annee . "-" . $mois . "-" . $jour . "', id_produit=$id_produit, id_user=$id_user_admin";
    $sth = $connection->prepare($sql);
    $sth->execute();
}



function delete_calendrier($annee, $id_produit)
{

    global $connection;

    $id_produit = $_GET["id"];

    $sql = "DELETE FROM calendrier WHERE date='" . $annee . "-" . $_GET['mois'] . "-" . $_GET['jour'] . "' AND id_produit=$id_produit";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

function select_calendrier($annee, $mois, $jour, $id_produit)
{

    global $connection;

    //$id_produit = $_GET["id"];

    $sql = "SELECT * FROM calendrier WHERE date='" . $annee . "-" . $mois . "-" . $jour . "' AND id_produit=$id_produit";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}


?>






<!--==========================================================-->
<!-- ============En tête de la page ========================= -->
<!-- ======================================================== -->

<div class="container mt-3">
    <div style="text-align: center">

        <h1 class="titre">Calendrier de disponibilité</h1>


    </div>
</div>

<br>
<div class="container-fluid bg-light">
    <div class="container mt-2">


        <!--=========================================================-->
        <!-- ============Etapes d'utilisation========================= -->
        <!-- ========================================================= -->

        <br>


        <h3 class="location">Louez tout le matériel pour votre réception en 3 étapes !</h3>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-4" style="text-align:center">
                    <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_selection.png"
                        alt=""><br><br>
                    <span class="step-number">
                        <h3>1</h3>
                    </span>
                    <span class="step-label">S'inscrire</span>
                </div>

                <div class="col-md-4" style="text-align:center">
                    <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_quantite.png"
                        alt=""><br><br>
                    <span class="step-number">
                        <h3>2</h3>
                    </span>
                    <span class="step-label">Déterminez la date de location</span>
                </div>

                <div class="col-md-4" style="text-align:center">
                    <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_valider.png"
                        alt=""><br><br>
                    <span class="step-number">
                        <h3>3</h3>
                    </span>
                    <span class="step-label">Rdv au panier pour finaliser votre demande </span>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

<div class="container mt-2">
    <br>
    <style>
    .color-143054 {
        color: #143054;

    }
    </style>

    <div>
        <a class=""
            href="../produits/produit_entier.php?id=<?php echo $id_produit ?>&id_cat=<?php echo $recup_des_produits->id_categorie ?>"><i
                class="fas fa-arrow-circle-left fa-2x color-143054"></i> </a>


    </div>


    <!-- ================================================================= -->
    <!-- ====================Nom du produit============================== -->
    <!-- ================================================================= -->

    <div class="container" id="btn_produit">
        <div style="text-align: center">
            <div class="animate">
                <h1 class="nom_produit" id="nom_produit_calendrier"><?php echo $recup_des_produits->nom_produit ?></h1>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- ============Permet de choisir le produit========================= -->
    <!-- ================================================================= -->

    <div class="container mt-3">
        <div class="text-center">
            <p><u>Choix du produit à réserver</u></p>
            <?php foreach ($recup_produit_calendrier as $row) { ?>
            <?php if ($row->actif == 1) { ?>

            <a href="../produits/calendrier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>&id_user=<?php echo $id_user_admin ?>&#btn_produit"
                class="btn btn-outline-success btn-sm"><?php echo $row->nom_produit ?></a>

            <?php } ?>
            <?php } ?>


        </div>
    </div>

    <!-------------------------------------------------------->
    <!--------------- echo d'information---------------------->
    <!-------------------------------------------------------->

    <div class="container mt-5">
        <div class="text-center">
            <?php
            if (isset($sup)) {
                echo '<font color="green">'  . '<strong>' . $sup .   '</strong>' . '</font>';
            } ?>
            <?php
            if (isset($erreur)) {
                echo '<font color="red">' . '<strong>' . $erreur . '</strong>' . '</font>' ?> <a
                href="../clients/panier.php">>Panier< </a> <?php } ?> </div>
    </div>
    <!-------------------------------------------------------------------------------->
    <!--------------- input Admin pour redirection tableau de bord-------------------->
    <!-------------------------------------------------------------------------------->


    <?php if (@$_SESSION["niv"] == 1) { ?>
    <div class="container mt-5">
        <a class="btn btn-outline-secondary btn-sm"
            href="../admin/admin_tableau_bord_client.php?id_user1=<?php echo $id_user_admin ?>&id_paiement1=<?php echo $id_paiement_pour_admin ?>"
            role="boutton" class="btn btn-link">Retour à la gestion locative</a>
    </div>

    <br>

    <!-------------------------------------------------------->
    <!--------------- input de réservation-------------------->
    <!-------------------------------------------------------->
    <?php } ?>
    <?php if (@$_SESSION["id_user"]) { ?>

    <form method="post" action="">
        <div>

            <p><i class="far fa-calendar-alt fa-1x color-143054"><u> Demande de réservation :</u></i> </p>
            <!-- si fonctionne pas réactiver l'input en dessous -->
            <!-- <input class="mr-sm-3" type="date" value="xxxx/xx/xx" name="demande" id="" require> -->

            <div class="row">
                <input type="date" name="demande" class="form-control" id="" value="xxxx/xx/xx" style="width: 14rem"
                    required>

                <div class="btn_calendrier_ajouter">
                    <style>
                    .btn-primary {
                        background: #143054;
                        color: white;
                        border-color: #143054;
                    }
                    </style>
                    <input type="submit" name="ajouter" class="btn btn-primary btn-sm"
                        value="Ajouter au panier"></input>
                </div>
            </div>

        </div>
    </form>

    <?php } else { ?>
    <!---------------------------------------------------------------------------->
    <!-------------------Message de rappel d'inscription-------------------------->
    <!---------------------------------------------------------------------------->

    <div class="container mt-3">
        <p class="calendrier_message_insciption">Vous souhaitez réserver une date ? <br>Inscrivez-vous ou
            identifiez-vous en cliquant <a href="../clients/login.php">ici</a></p>
    </div>
    <?php } ?>
    <!-------------------------------------------------------------------------->
    <!---------------cases de réservation et disponibilité---------------------->
    <!-------------------------------------------------------------------------->

    <br>
    <div class="table-responsive">
        <table id="recap">
            <tr>
                <td style="background:#C43030;width:15px;height:15px;"></td>
                <td>Réservé</td>
            </tr>
            <tr>
                <td style="background:#EDEFF1;width:15px;height:15px;"></td>
                <td>Disponible</td>
            </tr>
        </table>
    </div>
    <br>


    <!-------------------------------------------------------->
    <!------------------ Partie calendrier-------------------->
    <!-------------------------------------------------------->


    <?php
                        $_SESSION[$NomDeSessionAdmin] = 1;
                        if (isset($_SESSION[$NomDeSessionAdmin])) {
                            if (
                                isset($_GET['jour']) and preg_match("#^[0-9]{1,2}$#", $_GET['jour']) and
                                isset($_GET['mois']) and preg_match("#^[0-9]{1,2}$#", $_GET['mois']) and
                                isset($_GET['choix']) and preg_match("#^(0|1)$#", $_GET['choix'])
                            ) {
                                if ($_GET['choix'] == 1) {
                                    if (insert_calendrier($annee, $_GET['mois'], $_GET['jour'], $id_produit, $id_user_admin)) {
                                        echo "Journée mise en \"réservé\" avec succès !";
                                    } else {
                                        echo "Impossible de valider ici, il faut passer par le tableau de bord";
                                    }
                                } else {
                                    if (delete_calendrier($annee, $id_produit)) {
                                        echo "Journée mise en \"disponible\" avec succès !";
                                    } else {
                                        echo "Une erreur s'est produite: 2";
                                    }
                                }
                            }
                        }
                        $StyleTh = "text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black; text-align:center;";
                        ?>

    <div class="container">

        <!-- --------------------------------------------------- -->
        <!-- Information envoyer pour faire année +1 ou année -1 -->
        <!-- --------------------------------------------------- -->

        <div class="text-center">
            <tr>
                <!-- Année -1 -->
                <a href="../produits/calendrier.php?annee=<?php echo $annee - 1; ?>&id=<?php echo @$id_produit ?>&id_user=<?php echo @$id_user ?>&id_cat=<?php echo $row->id_categorie ?>&id_user=<?php echo $id_user_admin ?>&#nom_produit_calendrier"
                    style="font-size:60%;vertical-align:middle;text-decoration:none;"><?php echo $annee - 1; ?></a>
                <!-- Année N -->
                <?php echo $annee; ?>
                <!-- Année +1 -->
                <a href="../produits/calendrier.php?annee=<?php echo $annee + 1; ?>&id=<?php echo @$id_produit ?>&id_user=<?php echo @$id_user ?>&id_cat=<?php echo $row->id_categorie ?>&id_user=<?php echo $id_user_admin ?>&#nom_produit_calendrier"
                    style="font-size:60%;vertical-align:middle;text-decoration:none;"><?php echo $annee + 1; ?></a>
            </tr>
        </div>

        <br>

        <!-- --------------------------------------------------- -->
        <!-- Information envoyer pour faire la reservation ----- -->
        <!-- --------------------------------------------------- -->

        <div class="table-responsive">
            <table
                style="border:1px solid black;border-collapse:collapse;box-shadow: 10px 10px 5px #888888;width: 100%">



                <tr style="border-right:1px solid black;">
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Janvier</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Février</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Mars</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Avril</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Mai</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Juin</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Juillet</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Août</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Septembre</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Octobre</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Novembre</th>
                    <th
                        style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                        Décembre</th>
                </tr>

                <!-- <tr style="border-right:1px solid black;">
                                        <th style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054; text-align:center;">
                                            Janvier</th>
                                        <th style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054">
                                            Février</th>
                                        <th style="text-shadow: 1px 1px 1px #000;color:white;width:75px;border-right:1px solid black;border-bottom:1px solid black;background:#143054">
                                            Mars</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Avril</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Mai</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Juin</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Juillet</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Août</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Septembre</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Octobre</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Novembre</th>
                                        <th style="<?php echo $StyleTh; ?>background:#143054">Décembre</th>
                                    </tr> -->


                <tr>
                    <?php
                                        for ($mois = 1; $mois <= 12; $mois++) {
                                            for ($jour = 1; $jour <= $NbrDeJour[$mois]; $jour++) {
                                                if ($jour == 1) {
                                                    echo '<td style="vertical-align:top;border-right:1px solid black;">
                            <center><table style="width:100%;border-collapse:collapse;">';
                                                    $Jr = $PremierJourDuMois[$mois];
                                                }
                                                $JourReserve = 0;



                                                $req = select_calendrier($annee, $mois, $jour, $id_produit);

                                                // var_dump($req);



                                                if (isset($req->id) > 0) $JourReserve = 1;
                                        ?>
                <tr>
                    <td
                        style="<?php echo $JourReserve == 1 ? "background:#C43030;" : "background:#EDEFF1;"; ?>border-bottom:1px solid #eee;">
                        <?php echo $jours[$Jr]; ?></td>
                    <td
                        style="<?php echo $JourReserve == 1 ? "background:#C43030;" : "background:#FFFFFF;"; ?>border-bottom:1px solid #eee;">
                        <?php echo $jour; ?></td>
                    <?php
                                                if ($Jr > 5) {
                                                    $Jr = 0;
                                                } else {
                                                    $Jr++;
                                                }

                                                if (@$_SESSION["niv"] == 1) { ?>


                    <!-- --------------------------------------------------- -->
                    <!-- Information envoyer pour faire la reservation ----- -->
                    <!-- --------------------------------------------------- -->

                    <td
                        style="<?php echo $JourReserve == 1 ? "background:#FF8888;" : "background:#88FF88;"; ?>border-bottom:1px solid #eee;">
                        <a
                            href="../produits/calendrier.php?id=<?php echo $row->id_produit ?>&id_cat=<?php echo $row->id_categorie ?>&jour=<?php echo $jour; ?>&amp;mois=<?php echo $mois; ?>&amp;id=<?php echo @$id_produit; ?>&amp;annee=<?php echo $annee; ?>&amp;choix=<?php echo $JourReserve == 1 ? 0 : 1; ?>&id_user=<?php echo $id_user_admin ?>#recap"><img
                                src="images/<?php echo $JourReserve; ?>.png" alt="Action" style="width:13px;"
                                title="<?php echo $JourReserve == 1 ? "Mettre ce jour en Disponible" : "Mettre ce jour en Réservé"; ?>" /></a>
                    </td>
                    <?php } ?>
                </tr>



                <?php
                                                if ($jour == $NbrDeJour[$mois]) {
                                                    echo '</table></center>
                        </td>';
                                                }
                                            }
                                        }
                            ?>
        </div>

        </table>
    </div>
    <br>
</div>
</div>
<br>

<?php
    require "../footer/footer.php"; ?>
<?php require "../footer/modal.php"; ?>