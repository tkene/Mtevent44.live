</body>

<nav class="navbar navbar-expand-lg">

    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarText2"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span><i class="fas fa-align-justify"></i>
    </button>

    <br>

    <div class="container">
        <div class="collapse navbar-collapse" id="navbarText2">

            <div class=" col-md-12">
                <div class="row">
                    <div class="col-4">
                        <p class="color-blanc"><span style="text-decoration: underline;">Lien du site :</span></p>
                        <a class="color-blanc" href="../accueil_et_pages_reponse/accueil" aria-label="accueil">Accueil
                            <span class="sr-only">(current)</span></a><br>
                        <a class="color-blanc" href="../produits/produits" aria-label="produits">Produits</a><br>
                        <a class="color-blanc" href="../jeu_decouvert/jeu_decouvert" aria-label="produits">Jeux</a><br>
                        <a class="color-blanc" href="../page_idee/idees" aria-label="idee">Idées</a><br>
                        <!-- Button trigger modal -->
                        <a class="color-blanc" href="#" data-toggle="modal" data-target="#exampleModal">Contact </a>

                    </div>

                    <div class="col-4">

                        <p class="color-blanc"><span style="text-decoration: underline;">Mentions légales :</span></p>
                        <a class="color-blanc" href="../mention_legale/mention_legal" aria-label="mention legal">Cookies
                            <span class="sr-only">(current)</span></a><br>
                        <a class="color-blanc" href="https://www.mtevent44.fr/mention_legale/CGV"
                            aria-label="CGV">Conditions
                            générales de
                            vente</a><br>
                    </div>

                    <div class="col-4">

                        <div class="">
                            <p class="color-blanc"> <span style="text-decoration: underline;">Retrouvez nous aussi sur
                                    :</span> </p>

                            <i class="fab fa-facebook-square fa-2x color-blanc" style="margin-right: 30px"></i>
                            <i class="fab fa-instagram fa-2x color-blanc" style="margin-right: 30px"></i>
                            <i class=" fab fa-pinterest-square fa-2x color-blanc" style="margin-right: 30px"></i>

                        </div>

                    </div>

                    <br>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<!-- Ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>


<!-- bootstrapcdn -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>

<!-- icone fontawesome -->
<script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>

<!-- scrollmagic -->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>

<!-- Captcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="../js/app.js"></script>





<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162725020-1"></script>

<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'UA-162725020-1');
</script>

<!--  script pour bouton remonter en haut de la page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.onscroll = function(ev) {
        document.getElementById("cRetour").className = (window.pageYOffset > 100) ? "cVisible" :
            "cInvisible";
    };
});
</script>



<!------------------------------------------------>
<!----------------  Modal show ------------------->
<!------------------------------------------------>
<?php $mon_compte =  isset($_GET["mon_compte"]) ?>


<!-- Administrateur-->

<!-- confirmation -->
<?php if (isset($_GET["msg_confirmation"])) {
    $relance = $_GET["msg_confirmation"];

    if ($relance == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg_confirmation').modal('show');
});
</script>

<?php }
} ?>

<!-- relance admin -->
<?php if (isset($_GET["relance"])) {
    $relance = $_GET["relance"];

    if ($relance == "true") { ?>

<script>
$(document).ready(function() {
    $('#relance').modal('show');
});
</script>

<?php }
} ?>

<!-- refuser admin -->
<?php if (isset($_GET["msg_refuser"])) {
    $msg_refuser = $_GET["msg_refuser"];

    if ($msg_refuser == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg_refuser').modal('show');
});
</script>

<?php }
} ?>

<!-- refuser admin -->
<?php if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];

    if ($msg == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg').modal('show');
});
</script>

<?php }
} ?>


<!-- Mon compte-->

<?php if ($mon_compte) { ?>
<script>
$(document).ready(function() {
    $('#modalConnect').modal('show');
});
</script>
<?php } ?>


<!-- message contact true -->

<?php if (isset($_GET["message_contact"])) {
    $message_contact = $_GET["message_contact"];

    if ($message_contact == "true") { ?>

<script>
$(document).ready(function() {
    $('#message_contact_true').modal('show');
});
</script>

<?php }
} ?>

<!-- message contact false -->

<?php if (isset($_GET["message_contact"])) {
    $message_contact = $_GET["message_contact"];

    if ($message_contact == "false") { ?>

<script>
$(document).ready(function() {
    $('#message_contact_false').modal('show');
});
</script>

<?php }
} ?>


<!-- login false = Mot de passe incorrect-->

<?php if (isset($_GET["message_login"])) {
    $message_login = $_GET["message_login"];

    if ($message_login == "false") { ?>

<script>
$(document).ready(function() {
    $('#message_login').modal('show');
});
</script>

<?php }
} ?>

<!-- login false = Votre login est faux-->

<?php if (isset($_GET["message_login"])) {
    $message_login = $_GET["message_login"];

    if ($message_login == "false2") { ?>

<script>
$(document).ready(function() {
    $('#message_login2').modal('show');
});
</script>

<?php }
} ?>

<!-- calendrier false produit déjà dans le panier -->

<?php if (isset($_GET["msg_calendrier"])) {
    $msg_calendrier = $_GET["msg_calendrier"];

    if ($msg_calendrier == "false") { ?>

<script>
$(document).ready(function() {
    $('#msg_calendrier').modal('show');
});
</script>

<?php }
} ?>

<!-- admin add code promo -->

<?php if (isset($_GET["message_code_promo"])) {
    $message_code_promo = $_GET["message_code_promo"];

    if ($message_code_promo == "true") { ?>

<script>
$(document).ready(function() {
    $('#message_code_promo').modal('show');
});
</script>

<?php }
} ?>

<!-- admin delete code promo -->

<?php if (isset($_GET["delete_code_promo"])) {
    $delete_code_promo = $_GET["delete_code_promo"];

    if ($delete_code_promo == "true") { ?>

<script>
$(document).ready(function() {
    $('#delete_code_promo').modal('show');
});
</script>

<?php }
} ?>

<!-- calendrier ajout au panier -->

<?php if (isset($_GET["msg_calendrier_ajoute"])) {
    $msg_calendrier_ajoute = $_GET["msg_calendrier_ajoute"];

    if ($msg_calendrier_ajoute == "true") { ?>

<script>
$(document).ready(function() {
    $('#msg_calendrier_ajoute').modal('show');
});
</script>

<?php }
} ?>
<!-- calendrier refus car doublon panier -->

<?php if (isset($_GET["msg_calendrier"])) {
    $msg_calendrier = $_GET["msg_calendrier"];

    if ($msg_calendrier == "false") { ?>

<script>
$(document).ready(function() {
    $('#msg_calendrier').modal('show');
});
</script>

<?php }
} ?>









<!------------------------------------------------>
<!--  Condition pour faire apparaitre le cookie -->
<!------------------------------------------------>

<script type="text/javascript" id="cookieinfo" src="https:///cookieinfoscript.com/js/cookieinfo.min.js"
    data-bg="#645862" data-fg="#FFFFFF" data-link="#F1D600" data-cookie="CookieInfoScript" data-text-align="left"
    data-closetext="Got it!" data-expires="1" data-message="Nous respectons votre vie privée
Nous (la société Mtevent44) et nos partenaires utilisons des technologies telles que les cookies sur notre site pour personnaliser le contenu et les annonces publicitaires, vous fournir des fonctionnalités de médias sociaux et pour analyser notre trafic sur le site et sur Internet. En cliquant sur le bouton « Ok » ou en poursuivant votre navigation via une action de défilement, vous acceptez le traitement de vos données personnelles (ex: adresse ip) pour servir ces différentes finalités.
Vous pouvez à tout moment modifier vos choix de consentement en vous rendant sur"
    data-moreinfo="https://www.mtevent44.fr/mention_legale/mention_legal.php" data-linkmsg="Nos mentions cookies"
    data-close-text="Ok">

</script>

</html>