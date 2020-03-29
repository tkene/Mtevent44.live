<?php

require "../connect/connect.php";
require "../fonctions/fonction.php";
require "../header/header_admin.php";

if ($_SESSION["niv"] != 1) {
    header('Location:../clients/login.php');
}

?>


<body class="accueil_user">
    <div class="text-center">
        <div class="bienvenue_user">

            <h1 class="animate">Bienvenue, <br> <?php echo $_SESSION["nom"]; ?></h1><br>
            <i class="far fa-smile-beam fa-3x"></i><br><br>
            <a href="../accueil_et_pages_reponse/accueil.php" type="" class="btn btn-outline color-143054 animate"
                style="font-size: 30px"><strong>
                    Page
                    d'accueil</strong> </a>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>

</html>