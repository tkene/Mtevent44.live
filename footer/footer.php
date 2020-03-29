</body>

<nav class="navbar navbar-expand-lg">

    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarText2"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span><i class="fas fa-align-justify"></i>
    </button>

    <br>

    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarText2">

            <div class="col-4">
                <p class="color-blanc"><span style="text-decoration: underline;">Lien du site :</span></p>
                <a class="color-blanc" href="../accueil_et_pages_reponse/accueil.php" aria-label="accueil">Accueil <span
                        class="sr-only">(current)</span></a><br>
                <a class="color-blanc" href="../produits/produits.php" aria-label="produits">Produits</a><br>
                <a class="color-blanc" href="../page_idee/idees.php" aria-label="idee">Des Idées</a><br>
                <!-- Button trigger modal -->
                <a class="color-blanc" href="#" data-toggle="modal" data-target="#exampleModal">Contact </a>

            </div>

            <div class="col-4">

                <p class="color-blanc"><span style="text-decoration: underline;">Mention légale :</span></p>
                <a class="color-blanc" href="../mention_legale/mention_legal.php" aria-label="mention legal">Cookies
                    <span class="sr-only">(current)</span></a><br>
                <a class="color-blanc" href="https://www.mtevent44.fr/mention_legale/CGV.php"
                    aria-label="CGV">Conditions Générales de
                    ventes</a><br>
            </div>

            <div class="col-4" style="text-align: center">

                <div class="text-center">
                    <p class="color-blanc mt-3"> Retrouvez nous aussi sur : </p>

                    <i class="fab fa-facebook-square fa-2x color-blanc" style="margin-right: 30px"></i>
                    <i class="fab fa-instagram fa-2x color-blanc" style="margin-right: 30px"></i>
                    <i class=" fab fa-pinterest-square fa-2x color-blanc" style="margin-right: 30px"></i>

                </div>

            </div>

            <br>
        </div>
    </div>
</nav>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<!-- bootstrapcdn -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<!-- icone fontawesome -->
<script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>

<!-- scrollmagic -->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>

<!-- Captcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="../js/app.js"></script>

<!-- <script>
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}
</script> -->

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