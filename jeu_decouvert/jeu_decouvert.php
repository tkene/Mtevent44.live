<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";
?>



<!-------------------------------------------------------->
<!--------------------------- Title----------------------->
<!-------------------------------------------------------->

<br>

<h1 class="titre">Jeu de piste</h1>

<div class="container">
    <br>
    <p class="presentation">Nous proposons de créer sur mesure une application dans le cadre de votre événement.<br>
        Voici des exemples pour t'aider à imaginer ton propre concept :
        un quizz sur les mariés pour faire deviner le lieu de réception,
        une charade pour lancer l'invitation à ton événement... Les possibilités sont infinies.<br>

    </p>
    <p class="presentation">Comment cela fonctionne ? On se charge de créer le contenu web selon vos demandes, on
        vous
        transmet le lien web
        et
        vous pourrez ainsi le diffuser à vos invités.</p>
    <p class="presentation">Intéressés? Le tarif se veut abordable et variera selon la complexité du projet. Le
        mieux reste de nous
        contacter. </p>

</div>
<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!-------------------- les étapes du jeu------------------>
<!-------------------------------------------------------->
<!-------------------------------------------------------->
<div class="container-fluid bg-light">
    <div class="container">
        <h3 class="location">La conception en 3 étapes !</h3>
        <br>

        <div class="row">
            <div class="col-md-4" style="text-align:center">
                <span class="fa-stack fa-4x"> <i class="fas fa-circle fa-stack-2x " style="color: #FFC848;"></i><i
                        class="fas fa-comment fa-stack-1x fa-inverse"></i>
                </span><br><br>
                <span class="step-number">
                    <h3>1</h3>
                </span>
                <span class="step-label">Communiquez nous vos questions</span>
            </div>

            <div class="col-md-4" style="text-align:center">
                <span class="fa-stack fa-4x"> <i class="fas fa-circle fa-stack-2x " style="color: #FFC848;"></i><i
                        class="fas fa-desktop fa-stack-1x fa-inverse"></i></span><br><br>
                <span class="step-number">
                    <h3>2</h3>
                </span>
                <span class="step-label">Nous créeons le jeux</span>
            </div>

            <div class="col-md-4" style="text-align:center">
                <span class="fa-stack fa-4x"> <i class="fas fa-circle fa-stack-2x " style="color: #FFC848;"></i><i
                        class="fas fa-paper-plane fa-stack-1x fa-inverse"></i></span><br><br>
                <span class="step-number">
                    <h3>3</h3>
                </span>
                <span class="step-label">Partage le à tes invités</span>
            </div>
        </div>
    </div>

    <br>
    <br>



    <div class="text-center">
        <p class="presentation">Retrouve vite un exemple plus bas </p>

    </div>

    <br>

    <div class="text-center">
        <h5 class="" style="text-align: center">Quizz</h5>
        <p class="presentation">Répond aux différentes questions concernant les futurs mariés pour découvrir le lieu
            du mariage en cliquant vite
            sur le bouton démarrer</p>
        <i class="fas fa-arrow-down"></i>
        <br>
        <p class="presentation">Prochainement un exemple (bientôt disponible)</p>
        <!-- <a href="#" class="btn btn-primary">Demarrer le Quizz</a> -->
    </div>
</div>

<div class="container mt-3">
    <div class="text-center">
        <h2 class="titre_bienvenue">Contact</h2>
        <h3 class="location_particulier text-muted">Application pour les particuliers</h3>
    </div>
    <div class="text-center">
        <a class="btn btn-primary-accueil btn-xl text-uppercase js-scroll-trigger" data-toggle="modal"
            data-target="#exampleModal" aria-label="contact" style="color:white;">Nous
            contacter</a>

    </div>
</div>
<br>
<?php
require "../footer/footer.php";
require "../footer/modal.php";
?>