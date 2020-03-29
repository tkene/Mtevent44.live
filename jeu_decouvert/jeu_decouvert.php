<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";
?>


<!-------------------------------------------------------->
<!-------------------------------------------------------->
<!--------------------------- titre----------------------->
<!-------------------------------------------------------->
<!-------------------------------------------------------->
<br>

<h1 class="jeux">Jeu de piste</h1>

<div class="container">
    <br>
    <p>Bonjour, tu vas te marier et tu souhaites faire participer tes convives. Nous te proposons un lien qui est à
        partager
        auprès de tes invités.</p>
    <p>Nous te proposons de concevoir ce lien où tu trouveras un Quizz, un jeu de piste ou une charade,... (seul ton
        imagination pourra donner des limites).</p>
    <p>A travers ce jeu tu pourras faire participer tes invités, pour leurs faire découvrir le lieu.</p>


    <!-------------------------------------------------------->
    <!-------------------------------------------------------->
    <!-------------------- les étapes du jeu------------------>
    <!-------------------------------------------------------->
    <!-------------------------------------------------------->

    <h3 class="location">La conception en 3 étapes !</h3>
    <br>

    <div class="row">
        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_selection.png" alt=""><br><br>
            <span class="step-number">
                <h3>1</h3>
            </span>
            <span class="step-label">Communiquez nous vos questions</span>
        </div>

        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_quantite.png" alt=""><br><br>
            <span class="step-number">
                <h3>2</h3>
            </span>
            <span class="step-label">Nous générons l'application</span>
        </div>

        <div class="col-md-4" style="text-align:center">
            <img class="img-responsive" src="https://www.options.fr/media/wysiwyg/icone_valider.png" alt=""><br><br>
            <span class="step-number">
                <h3>3</h3>
            </span>
            <span class="step-label">Tu partages à tes invités</span>
        </div>
    </div>


    <br>
    <br>



    <div class="text-center">
        Retrouve vite un exemple plus bas <i class="fas fa-arrow-down"></i>

    </div>

    <br>

    <div class="text-center">
        <h5 class="" style="text-align: center">Quizz</h5>
        <p class="card-text">Répond aux différentes questions concernant les futur marier pour découvrir le lieu en
            cliquant
            vite
            sur le bouton demarrer</p>
        <i class="fas fa-arrow-down"></i>
        <br>
        <p>Prochainement un exemple (bientôt disponible)</p>
        <!-- <a href="#" class="btn btn-primary">Demarrer le Quizz</a> -->
    </div>
</div>


<br>

<?php
include "../footer/footer.php";
?>