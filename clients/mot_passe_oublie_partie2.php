<?php
ob_start();
require '../connect/connect.php';
require '../connect/crypt.php';
require "../fonctions/fonction.php";
require "../header/header.php";

//  Vérifie s'il y a un id dans la barre url
if (isset($_GET["id"])) {
} else {
    header('location:https://www.mtevent44.fr/404.php');
}



// si y a un id dans l'url je décripte et je le compare à la base de donnée.
if (isset($_GET["id"])) {
    $id_user = $_GET["id"];

    $var2 = aesDecrypt($id_user);
    //echo $var2;
    if (verification_id($var2)) {
        //echo 'ok tu passes';
        //echo  $verification_id;
    } else {
        //$erreur = "Vous n'avez pas copié le bon lien ou merci de contacter l'administrateur";
        header('location:https://www.mtevent44.fr/404.php');
        ob_end_flush();
    }
} else {
    echo 'Erreur pas id ';
}


// $verification_id = verification_id($var2);
// var_dump($verification_id);


if (isset($_POST)) {

    @$mot_de_passe1 = htmlspecialchars($_POST['mot_de_passe1']);
    @$mot_de_passe2 = htmlspecialchars($_POST['mot_de_passe2']);
    @$modifier = htmlspecialchars($_POST['modifier']);
    @$pass_hash =  cryptage($password);
    //var_dump($id_user);

    if ($modifier)

        if ($mot_de_passe1 == $mot_de_passe2) {

            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $mot_de_passe1)) {
                sleep(1);
                //echo 'ok mdp modifié';
                modifier_motdepasse($var2, $mot_de_passe1);
                header('location:https://www.mtevent44.fr/accueil_et_pages_reponse/reponse_motdepasse_confirme.php');
                ob_start();
                exit();
            } else {
                $erreur =  'Niveau de sécurité trop faible';
            }
        } else {
            $erreur = 'Vos mot de passe ne correspondent pas, merci de retaper votre mot de passe';
        }
}



?>
<div class="container mt-5">

    <div class="text-center">
        <?php
        if (isset($erreur)) {
            echo '<font color="red">' . $erreur . '</font>';
        } ?>
    </div>

</div>

<div class="container mt-5">
    <div class="text-center">
        <p class="mot_de_passe_oublie_partie2">Bienvenue.</p>

        <p class="mot_de_passe_oublie_partie2_saisie">merci de saisir votre nouveau mot de passe</p>

        <form action="mot_passe_oublie_partie2.php?id=<?php echo $id_user; ?>" method="post">

            <div class="col-md-12 mb-3">

                <div class="input-group">

                    <input type="password" name="mot_de_passe1" value="" placeholder="Nouveau mot de passe"
                        class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3"
                        data-toggle="tooltip"
                        title="minimum 8 caractères avec au moins 1 majuscule 1 minuscule 1 caractère spécial et 1 chiffre"
                        data-placement="right" required pattern=".{8,}">
                </div>
            </div>

            <div class=" col-md-12 mb-3">

                <div class="input-group">
                    <input type="password" name="mot_de_passe2" value="" placeholder="retaper votre mot de passe"
                        class="form-control" id="validationServerUsername" data-toggle="tooltip"
                        title="minimum 8 caractères avec au moins 1 majuscule 1 minuscule 1 caractère spécial et 1 chiffre"
                        data-placement="right" aria-describedby="inputGroupPrepend3" required pattern=".{8,}">
                </div>
            </div>

            <input class=" btn_motdepasse2" type="submit" name="modifier" value="modifier">

        </form>

        <a class="navbar-brand mt-5" href="#"><img class="logo"
                src="https://www.mtevent44.fr/images/logo/Logo_simplifie.png"></a>



    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>

<script src="https://www.mtevent44.fr/js/app.js"></script>
<script>
// permet de mettre un message dans l'input password
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>
</body>



</html>