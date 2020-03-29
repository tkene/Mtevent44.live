<?php
//permet d'utiliser header(location)
ob_start();
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";
require "../recaptcha/autoload.php";


if (isset($_POST["verifier"])) {
    sleep(1); // Une pause de 1 sec
    $login = $_POST["login"];
    $passe = $_POST["passe"];
    $erreur =  verif_login($login, $passe);
}

if (isset($_POST["forminscription"])) {

    @$civil = htmlspecialchars($_POST['civilite']);
    @$nom = htmlspecialchars($_POST['nom']);
    @$prenom = htmlspecialchars($_POST['prenom']);
    @$mail_visiteur = htmlspecialchars($_POST['mail']);
    @$mail2 = htmlspecialchars($_POST['mail2']);
    @$tel = htmlspecialchars($_POST['tel']);
    @$password = htmlspecialchars($_POST['mot_de_passe']);
    @$pass_hash =  cryptage($password);







    // if (!empty($civil) and !empty($nom) and !empty($prenom) and !empty($mail_visiteur) and !empty($telephone) and !empty($password)) {

    //     if ($mail_visiteur == $mail2) {


    //         if ($mail_visiteur == doublonclient($mail_visiteur)) {

    //             $erreur = "utilisateur déjà inscrit";
    //         } else {


    //             incription($civil, $nom, $prenom, $mail_visiteur, $telephone, $pass_hash);
    //             // $valide = "enregistrement Validé";
    //             header('location:envoi_mail_formulaire.php?mail=' . $mail_visiteur . '&nom=' . $nom . '&prenom=' . $prenom . '$tel=' . $tel);
    //             ob_start();
    //             exit();
    //         }
    //     } else {
    //         $erreur = "Vos adresses emails ne correspondent pas";
    //     }
    // }


    // // code pour imposer des caractéres spéciaux
    // if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $password)) {
    //     echo 'Mot de passe conforme';
    // } else {
    //     echo 'Niveau de sécurité trop faible';
    // }



    if (isset($_POST['forminscription'])) {


        if ($mail_visiteur == $mail2) {

            if ($mail_visiteur != doublonclient($mail_visiteur)) {

                if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $password)) {

                    if (isset($_POST['g-recaptcha-response'])) {
                        $recaptcha = new \ReCaptcha\ReCaptcha('6LeNlNgUAAAAAKrIS6hmF-CCDsXeIAYLbE8OaPuQ');
                        $resp = $recaptcha->verify($_POST['g-recaptcha-response']);

                        if ($resp->isSuccess()) {
                            //echo 'inscription validé';
                            incription($civil, $nom, $prenom, $mail_visiteur, $tel, $pass_hash);
                            // $valide = "enregistrement Validé";
                            header('location:../envoi_mail/envoi_mail_formulaire.php?mail=' . $mail_visiteur . '&nom=' . $nom . '&prenom=' . $prenom . '&tel=' . $tel);
                            ob_end_flush();
                            exit();
                        } else {
                            $errors = $resp->getErrorCodes();
                            $erreur = 'Captcha non rempli ou incorrect';
                            //var_dump($errors);
                        }
                    } else {
                        $erreur =  'Captcha non rempli';
                    }
                } else {
                    $erreur =  'Niveau de sécurité trop faible';
                }
            } else {
                $erreur = "utilisateur déjà inscrit";
            }
        } else {
            $erreur = "Vos adresses emails ne correspondent pas";
        }
    }
}




//var_dump(verif_login($login, $passe));

?>

<div class="parent">

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

    <!-- login -->
    <div class="container mt-5">
        <div class="text-center">
            <div class="row">
                <div class="col-6">

                    <div class="container">


                        <p class="titre_login" style="color:#143054;"> Login </p>

                        <br>

                        <div class="login-form">

                            <form action="login.php" method="post">
                                <label class="animate">
                                    <h5>Votre mail</h5>
                                </label>
                                <br>
                                <input type="text" name="login" value="" style="width:65%" required>
                                <br><br>
                                <label class="animate">
                                    <h5>Votre mot de passe</h5>
                                </label>
                                <br>
                                <input type="password" name="passe" value="" style="width:65%" required><br><br>

                                <input type="submit" name="verifier" value="Connexion" class="btn btn-success"
                                    data-toggle="modal" data-target="#exampleModal">
                                <br><br>
                            </form>
                            <a href="../clients/mot_passe_oublie_partie1.php" class="btn btn-outline-secondary"
                                value="">Mot
                                de passe oublié</a>

                        </div>
                    </div>
                </div>
                <!-- nouveau client -->
                <div class="col-6">

                    <h1 class="animate" style="color:#143054;">Nouveau client ?</h1>
                    <br>

                    <p class=" text-left">Créez votre compte en quelques instants afin d'effectuer et suivre
                        vos demandes de devis et consulter vos archives.</p>
                    <br>
                    <a class="btn btn-outline-secondary" data-toggle="modal"
                        data-target="#exampleModalCenter">S'inscrire</a>

                </div>
            </div>
        </div>
    </div>


</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-center">
                <div class="modal-header">

                    <div class="animate">

                        <h3 class="">Formulaire d'inscription</h3>

                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">

                <!-------------------------->
                <!-- inscription au site  -->
                <!-------------------------->
                <form action="login.php" method="post">


                    <select name="civilite" class="form-control placeholder">

                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>

                    </select>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <!-- <label>Nom</label> -->
                            <input type="text" name="nom" value="" placeholder="Votre Nom" class="form-control "
                                required>

                        </div>

                        <div class="col-md-6 mb-3">
                            <!-- <label>Prenom</label> -->
                            <input type="text" name="prenom" value="" placeholder="Votre Prenom" class="form-control "
                                required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <!-- <label for="validationServerUsername">Adresse mail</label> -->
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>

                                <input type="email" name="mail" value="" placeholder="Adresse email"
                                    class="form-control" id="validationServerUsername"
                                    aria-describedby="inputGroupPrepend3" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- <label for="validationServerUsername">confirmer votre adresse mail</label> -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" name="mail2" value="" placeholder="Confirmer votre email"
                                    class="form-control" id="validationServerUsername"
                                    aria-describedby="inputGroupPrepend3" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-md-6 mb-3">

                            <!-- <label for="validationServer03">Numéro de téléphone</label> -->
                            <input type="text" name="tel" class="form-control" value=""
                                placeholder="Votre numéro téléphone" maxlength="10" required>

                        </div>
                    </div>



                    <div>
                        <label for=" mot_de_passe">Password</label>
                        <input type="password" id="password" name="mot_de_passe" data-toggle="tooltip"
                            title="minimum 8 caractères avec au moins 1 majuscule 1 minuscule 1 caractère spécial et 1 chiffre"
                            data-placement="right" class="form-control" value="" required pattern=".{8,}">

                        <div class="progress progress-striped active">
                            <div id="" class="progress-bar jak_pstrength" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                        </div>





                    </div>
                    <br>
                    <div class="g-recaptcha" data-sitekey="6LeNlNgUAAAAAJDvjCVNXtKfrPUBOMU1kIA7HNmv"> </div>
            </div>

            <div class="modal-footer">
                <button type="submit" name="forminscription" value="enregistrer"
                    class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0">S'inscrire
                </button>

            </div>

            </form>
        </div>
    </div>
</div>





<?php
include "../footer/footer.php";
?>

<script>
// permet à la barre de se remplir
$(document).ready(function() {
    $("#password").keyup(function() {
        passwordStrength(jQuery(this).val());
    });
});
// var msg = ['not acceptable', 'very weak', 'weak', 'standard', 'looks good', 'yeahhh, strong mate.'];

// permet de mettre un message dans l'input password
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>