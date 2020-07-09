<?php
require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header.php";

?>

<body class="reponse_mail">

    <div class="message_mail_KO">
        <p class="text_reponse">Bonjour,<br></p>
        <p class="text_reponse"> <strong>Une erreur s'est produite.</strong></p>
        <p class="text_reponse">Merci de remplir tout les champs </p>
        <p class="text_reponse">ou</p>
        <p class="text_reponse">Nous ecrire directement par mail à "MTevenement44@gmail.com" <br></p>
        <p class="text_reponse">Merci
            de votre compréhension.</p>



        <a href="../accueil_et_pages_reponse/accueil.php" type="" class="btn btn-outline color-143054"
            style="font-size: 30px"><strong> Page
                d'accueil</strong> </a>

    </div>

    <?php

    include "../footer/footer.php";
    ?>