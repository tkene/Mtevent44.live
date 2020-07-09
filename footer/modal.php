<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!----------------------Contact + modal------------------->
<!-------------------------------------------------------->
<!-------------------------------------------------------->

<!-- Modal -->


<div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="animate" style="text-align: center">
                        Formulaire de contact
                    </div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <form action="../envoi_mail/envoi_mail.php" method="post">
                    <select name="civilite" class="form-control placeholder" value="">

                        <option value="<?php echo @$_SESSION["civilite"]; ?>">
                            <?php echo @$_SESSION["civilite"]; ?></option>

                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>

                    </select>

                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control " value="<?php echo @$_SESSION["nom"]; ?>"
                        required>

                    <label>Prenom</label>
                    <input type="text" name="prenom" class="form-control " value="<?php echo @$_SESSION["prenom"]; ?>"
                        required>

                    <label for="validationServerUsername">Adresse mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="mail" class="form-control" id="validationServerUsername"
                            aria-describedby="inputGroupPrepend3" value="<?php echo @$_SESSION["mail"]; ?>" required>
                    </div>

                    <label for="validationServer03">Numéro de téléphone</label>
                    <input type="number_format" name="tel" class="form-control" maxlength="10"
                        value="<?php echo @$_SESSION["tel"]; ?>" required>

                    <label for="validationServer03">Date de l'événement</label>
                    <input type="date" name="date_event" class="form-control" required>


                    <label for="validationTextarea">Votre Message</label>
                    <textarea class="form-control " name="message" placeholder="Ecrivez vous message"
                        required></textarea>
                    <p style="text-align: right">(vous pouvez agrandir ici<i class="fas fa-arrow-up"></i>)</p>

                    <br>

                    <div class="g-recaptcha" data-sitekey="6LeNlNgUAAAAAJDvjCVNXtKfrPUBOMU1kIA7HNmv"> </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                    name="forminscription" value="ok" type="submit">Envoyer</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- message contact true -->

<div class="modal fade" id="message_contact_true" tabindex="-1" role="dialog" aria-labelledby="message_contact_true"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Votre message est envoyé, nous vous répondrons dans les plus brefs délais.
                <br>
                Cordialement.
                <br>
                MTEVENT44
            </div>

        </div>
    </div>
</div>

<!-- message contact false -->

<div class="modal fade" id="message_contact_false" tabindex="-1" role="dialog" aria-labelledby="message_contact_false"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Nous rencontrons un soucis d'envoi, merci de nous contacter écrire à l'adresse mail :
                mtevenement44@gmail.com.
                <br>
                Cordialement.
                <br>
                MTEVENT44
            </div>

        </div>
    </div>
</div>



<!---------------------------------------------------------->
<!--------------------- Page login ------------------------->
<!---------------------------------------------------------->

<!-- login false = Mot de passe incorrect-->

<div class="modal fade" id="message_login" tabindex="-1" role="dialog" aria-labelledby="message_login"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Mot de passe incorrect
            </div>

        </div>
    </div>
</div>

<!-- login false = Votre login est faux-->

<div class="modal fade" id="message_login2" tabindex="-1" role="dialog" aria-labelledby="message_login2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Votre mail est incorrect
            </div>

        </div>
    </div>
</div>

<!--------------------------------------------------------------->
<!--------------------- Page calendrier ------------------------->
<!--------------------------------------------------------------->

<!-- login false = Mot de passe incorrect-->

<div class="modal fade" id="msg_calendrier" tabindex="-1" role="dialog" aria-labelledby="msg_calendrier"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Produit déjà reservé pour changer la date supprimer l'article de votre panier
            </div>

        </div>
    </div>
</div>


<!---------------------------------------------------------->
<!---------------- Admin tableau client -------------------->
<!---------------------------------------------------------->

<!-- confirmation -->

<div class="modal fade" id="msg_confirmation" tabindex="-1" role="dialog" aria-labelledby="msg_confirmation"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Produit confirmé et mail envoyé au client
            </div>

        </div>
    </div>
</div>

<!-- relance -->

<div class="modal fade" id="relance" tabindex="-1" role="dialog" aria-labelledby="relance" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Mail relance client envoyé
            </div>

        </div>
    </div>
</div>

<!-- refuser -->

<div class="modal fade" id="msg_refuser" tabindex="-1" role="dialog" aria-labelledby="msg_refuser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Mail de refus envoyé
            </div>

        </div>
    </div>
</div>

<!-- Message libre -->

<div class="modal fade" id="msg" tabindex="-1" role="dialog" aria-labelledby="msg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Message envoyé au client
            </div>

        </div>
    </div>
</div>







<!---------------------------------------------------------->
<!---------------- Modification compte  -------------------->
<!---------------------------------------------------------->

<div class="modal fade" id="modalConnect" tabindex="-1" role="dialog" aria-labelledby="modalConnect" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Modifications effectuées
            </div>

        </div>
    </div>
</div>



<!---------------------------------------------------------->
<!---------------- add code promo  ------------------------->
<!---------------------------------------------------------->

<div class="modal fade" id="message_code_promo" tabindex="-1" role="dialog" aria-labelledby="message_code_promo"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Code promotion ajouté et actif
            </div>

        </div>
    </div>
</div>

<!---------------------------------------------------------->
<!---------------- delete code promo  ------------------------->
<!---------------------------------------------------------->

<div class="modal fade" id="delete_code_promo" tabindex="-1" role="dialog" aria-labelledby="delete_code_promo"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Code promo supprimé
            </div>

        </div>
    </div>
</div>

<!---------------------------------------------------------------->
<!---------------- erreur de code promo  ------------------------->
<!---------------------------------------------------------------->

<div class="modal fade" id="msg_code_promo" tabindex="-1" role="dialog" aria-labelledby="msg_code_promo"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Code promo invalide
            </div>

        </div>
    </div>
</div>

<!--------------------------------------------------------------------->
<!---------------- montant promo insuffisant  ------------------------->
<!--------------------------------------------------------------------->

<div class="modal fade" id="msg_montant_promo" tabindex="-1" role="dialog" aria-labelledby="msg_montant_promo"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Montant insuffisant
            </div>

        </div>
    </div>
</div>




<!--------------------------------------------------------------------->
<!---------------- Code promotion validé  ------------------------->
<!--------------------------------------------------------------------->

<div class="modal fade" id="msg_code_valide" tabindex="-1" role="dialog" aria-labelledby="msg_code_valide"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Code promotion Validé
            </div>

        </div>
    </div>
</div>


<!-------------------------------------------------------------------------->
<!---------------- refus calendrier doublon panier ------------------------->
<!-------------------------------------------------------------------------->

<div class="modal fade" id="msg_calendrier_ajoute" tabindex="-1" role="dialog" aria-labelledby="msg_calendrier_ajoute"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                <p style="color:green;">Produit ajouté au panier</p>
                <p>" Pensez à envoyer votre demande pour validation "</p>
            </div>

        </div>
    </div>
</div>

<!-------------------------------------------------------------------------->
<!---------------- refus calendrier doublon panier ------------------------->
<!-------------------------------------------------------------------------->

<div class="modal fade" id="msg_calendrier" tabindex="-1" role="dialog" aria-labelledby="msg_calendrier"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                <p style="color: red">Produit déjà reservé pour changer la date supprimer l'article de votre panier</p>
            </div>

        </div>
    </div>
</div>

<!-------------------------------------------------------------------------->
<!---------------- admin ajout article blog------- ------------------------->
<!-------------------------------------------------------------------------->

<div class="modal fade" id="msg_blog_ajouter" tabindex="-1" role="dialog" aria-labelledby="msg_blog_ajouter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Article <b style="color: green">Ajoute</b>
            </div>

        </div>
    </div>
</div>

<!-------------------------------------------------------------------------->
<!---------------- admin modifié article blog------- ------------------------->
<!-------------------------------------------------------------------------->

<div class="modal fade" id="msg_blog_modifier" tabindex="-1" role="dialog" aria-labelledby="msg_blog_modifier"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Article <b style="color: green">Modifier</b>
            </div>

        </div>
    </div>
</div>

<!-------------------------------------------------------------------------->
<!---------------- admin supprime article blog------- ------------------------->
<!-------------------------------------------------------------------------->

<div class="modal fade" id="msg_blog_supprimer" tabindex="-1" role="dialog" aria-labelledby="msg_blog_supprimer"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal_header_modal">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal_body_mon_compte">
                Article <b style="color: red">Supprimer</b>
            </div>

        </div>
    </div>
</div>