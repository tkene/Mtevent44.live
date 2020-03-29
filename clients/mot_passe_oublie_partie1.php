<?php
// ob_star() ouverture de traitement et fermeture par ob_start()
ob_start();
require '../connect/connect.php';
require '../connect/crypt.php';
require "../fonctions/fonction.php";
require "../header/header.php";


if (isset($_POST["envoi"])) {


    @$adresse_mail = htmlspecialchars($_POST['adresse_mail']);





    if (isset($adresse_mail)) {
        $recup_id = recup_id($adresse_mail);
        $var1 = aesEncrypt($recup_id);
        if ($adresse_mail == motdepasse_oublie($adresse_mail)) {
            sleep(1);
            header('location:https://www.mtevent44.fr/envoi_mail/envoi_mail_motdepasse.php?id=' .  $var1 . '&adresse_mail=' . $adresse_mail);
            ob_end_flush();
            echo 'ok tu passes';
        } else {
            $erreur = "l'adresse mail n'existe pas.";
        }
    }
}

?>



<div class="container mt-5">
    <div class="text-center">

        <p class="mot_de_passe_oublie_partie1">Bienvenue sur la page mot de passe oublié.</p>

        <p class="mot_de_passe_oublie_partie1_saisie">Merci de saisir votre adresse mail.</p>

        <form action="mot_passe_oublie_partie1.php" method="post">
            <input type="email" name="adresse_mail" placeholder="votre adresse mail" required>
            <input class="btn_motdepasse btn-light" type="submit" name="envoi" value="envoyer">
        </form>

        <div class="container mt-5">

            <div class="text-center">
                <?php
                if (isset($erreur)) {
                    echo '<font color="red">' . $erreur . '</font>';
                } ?>
            </div>
            <a class="navbar-brand mt-5" href="https://www.mtevent44.fr/accueil_et_pages_reponse/accueil.php"><img
                    class="logo" src="https://www.mtevent44.fr/images/logo/Logo_simplifie.png"></a>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>


</body>


</html>