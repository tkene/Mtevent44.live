<?php
// ob_star() ouverture de traitement et fermeture par ob_start()
ob_start();

require "../connect/connect.php";
require '../connect/crypt.php';
require "../fonctions/fonction.php";
require "../header/header.php";




// Permet d'empêcher d'accéder s'il n'est pas connecté 
if (empty($_SESSION["id_user"])) {
    header('Location:https://www.mtevent44.fr/clients/login');
    ob_end_flush();
}


$id_user = $_SESSION["id_user"];
$recup_panier_commandes = mes_commandes($id_user);
$recup_paiement = recup_paiement($_SESSION["id_user"]);

if ($_POST) {

    @$modifier = htmlspecialchars($_POST['modifier_compte']);
    @$civil = htmlspecialchars($_POST['civilite']);
    @$nom = htmlspecialchars($_POST['nom']);
    @$prenom = htmlspecialchars($_POST['prenom']);
    @$mail = htmlspecialchars($_POST['mail']);
    @$telephone = htmlspecialchars($_POST['tel']);
    @$password = htmlspecialchars($_POST['mot_de_passe']);
    @$id_user = htmlspecialchars($_POST['id_user']);

    if ($modifier) {
        modif_compte($id_user, $civil, $nom, $prenom, $mail, $telephone);
        //modif_tags($id_article, $tags);

        header('Location: mon_compte.php?mon_compte=true');
        //$valide = "Vos coordonnées sont modifiées";
    }
}


?>

<div class="container mt-5">




</div>

<!---------------------------------------------------------->
<!----------------- Les demandes clients ------------------->
<!---------------------------------------------------------->

<div class="container mt-3">
    <h3 class="mes_anciennes_commandes">Mes demandes</h3>
    <br>
    <div class="table-responsive">
        <table class="table">
            <thead class="thead_tableau_client">
                <tr>
                    <th id="tableau_client" scope="col">Date de la demande</th>
                    <th id="tableau_client" scope="col">Nom produit</th>
                    <th id="tableau_client" scope="col">Date de reservation</th>
                    <th id="tableau_client" scope="col">Statut de la demande</th>
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
                    }  ?></td>


            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="container mt-5">
    <div class="row">

        <!---------------------------------------------------------->
        <!----------------------- Mon compte ----------------------->
        <!---------------------------------------------------------->
        <div class="col-md-6">

            <div class="card">
                <div class="animate">
                    <h3 class="card-header" style="text-align: center">Mon compte</h3>
                </div>
                <form action="mon_compte" method="post">

                    <div class="card-body">
                        <select name="civilite" class="form-control placeholder">
                            <option value="<?php echo @$_SESSION["civilite"]; ?>"><?php echo @$_SESSION["civilite"]; ?>
                            </option>
                            <option value="Monsieur">Monsieur</option>
                            <option value="Madame">Madame</option>

                        </select>
                        <br>
                        <div class="form-row">
                            <div class="col-md-6 mb-4">
                                <label>Nom</label>
                                <input type="text" name="nom" value="<?php echo @$_SESSION["nom"]; ?>"
                                    class="form-control " required>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Prénom</label>
                                <input type="text" name="prenom" value="<?php echo @$_SESSION["prenom"]; ?>"
                                    class="form-control " required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationServerUsername">Adresse mail</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="email" name="mail" value="<?php echo @$_SESSION["mail"]; ?>"
                                        class="form-control" id="validationServerUsername"
                                        aria-describedby="inputGroupPrepend3" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-6 mb-3">

                                <label for="validationServer03">Numéro de téléphone</label>
                                <input type="text" name="tel" class="form-control"
                                    value="<?php echo @$_SESSION["tel"]; ?>" maxlength="10" required>

                            </div>
                        </div>

                        <button type="submit" name="modifier_compte" value="modification_compte"
                            class="btn btn-outline-color btn-rounded btn-block my-4 waves-effect z-depth-0">Modifier
                        </button>
                        <input type="hidden" name="id_user" value="<?php echo $_SESSION["id_user"] ?>">
                    </div>

                </form>
            </div>

        </div>


        <!---------------------------------------------------------->
        <!----------------------- Historique  ---------------------->
        <!---------------------------------------------------------->


        <div class="col-md-6">
            <h3 class="mes_anciennes_commandes">Mon historique</h3>

            <?php if (isset($_SESSION["id_user"])) { ?>
            <?php foreach ($recup_paiement as $row) { ?>

            <div class="row mt-5">
                <p><strong>Date de paiement :</strong> <?php echo ($row->date_de_paiement); ?>
                </p>
                <?php $var1 = aesEncrypt($row->id_user); ?>
                <?php $var2 = aesEncrypt($row->id_paiement); ?>
                <?php $var3 = aesEncrypt($row->use_promo); ?>
                <a
                    href="facturation_edition.php?id_user=<?php echo $var1 ?>&id_paiement=<?php echo $var2 ?>&code_promo=<?php echo $var3 ?>"><input
                        class="btn btn-color btn-sm" value="editer" style="margin-left: 10px;"></a>
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


    </div>
</div>





<br>

<?php require "../footer/footer.php" ?>
<?php require "../footer/modal.php"; ?>