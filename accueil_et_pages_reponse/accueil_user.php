<?php
include "../connect/connect.php";
include "../fonctions/fonction.php";
include "../header/header.php";




//var_dump($recup_des_users);

?>
<br>

<body class="accueil_user">
    <div class="text-center">
        <div class="bienvenue_user">

            <h1 class="animate">Bienvenue, <br> <?php echo $_SESSION["nom"]; ?></h1><br>
            <i class="far fa-smile-beam fa-3x"></i><br><br>
            <a href="https://www.mtevent44.fr/accueil_et_pages_reponse/accueil" type=""
                class="btn btn-outline color-143054 animate" style="font-size: 30px"><strong>
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