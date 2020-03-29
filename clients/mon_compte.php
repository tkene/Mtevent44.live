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

        $valide = "Vos coordonnées sont modifiées";
    }
}


?>

<div class="container mt-5">

    <div class="text-center">
        <?php
        if (isset($erreur)) {
            echo '<font color="red">' . $erreur . '</font>';
        } ?>

        <?php
        if (isset($valide)) {
            echo '<font color="green">' . $valide . '</font>';
        } ?>


    </div>

</div>

<div class="container mt-5">
    <div class="card">
        <div class="animate">
            <h3 class="card-header" style="text-align: center">Mon compte</h3>
        </div>
        <form action="mon_compte.php" method="post">

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
                        <input type="text" name="nom" value="<?php echo @$_SESSION["nom"]; ?>" class="form-control "
                            required>

                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Prenom</label>
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
                                class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3"
                                required>
                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col-md-6 mb-3">

                        <label for="validationServer03">Numéro de téléphone</label>
                        <input type="text" name="tel" class="form-control" value="<?php echo @$_SESSION["tel"]; ?>"
                            maxlength="10" required>

                    </div>
                </div>

                <button type="submit" name="modifier_compte" value="modification_compte"
                    class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0">modifier
                </button>
                <input type="hidden" name="id_user" value="<?php echo @$_SESSION["id_user"] ?>">
            </div>

        </form>
    </div>
</div>


<br>

<?php include "../footer/footer.php" ?>