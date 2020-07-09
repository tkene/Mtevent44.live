<?php

$no_cache = uniqid();


if (isset($_POST["verifier"])) {
    $login = $_POST["login"];
    $passe = $_POST["passe"];
    $erreur =  verif_login($login, $passe);
}

//var_dump($_POST);

$nom = $prenom = $message = $mail = "";

@$id_user1 = $_GET["id_user1"];





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicone header -->
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../images/logo/favicon.ico" type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



    <!-- CSS après le point ? permet de rafraichir plus rapidement et avec le css -->
    <link rel="stylesheet" href="../css/style.css?nocache=<?php echo $no_cache; ?>" />



    <!-- CDN pour mettre la case texte -> "jodit" -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.css">

    <!-- il faut mettre dans le header car il fait appel avant le CSS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.js"></script>

    <!-- font-wesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- lien pour animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <!--  google font permet de changer la typographie de l'ecriture -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">

    <!-- Police de Caractère -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <!-- scrollmagic -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
    <!-- permet à scroll magic de savoir ou s'active la bulle -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/debug.addIndicators.min.js"></script> -->

    <title>Mt Event</title>
</head>


<body>




    <nav class="navbar navbar-expand-lg">

        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span><i class="fas fa-align-justify"></i>
        </button>

        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText" style="color: white">


                <div class="col-md-8">

                    <ul class="navbar-nav mr-auto" style="z-index: 7;">

                        <?php if ($_SESSION["niv"] == 1) { ?>
                        <!-- retour admin -->

                        <a class="nav-link"
                            href="../admin/admin_tableau_bord_client.php?id_user1=<?php echo $recup_id_user ?>"><i
                                class="fas fa-arrow-left fa-3x"></i>
                            <span class="sr-only">(current)</span></a>

                        <?php } else { ?>

                        <a class="nav-link" href="../clients/mon_compte"><i class="fas fa-arrow-left fa-3x"></i>
                            <span class="sr-only">(current)</span></a>

                        <?php } ?>

                        <!-- <li class="nav-item active">
                            <a class="nav-link" href="accueil.php">Accueil <span class="sr-only">(current)</span></a>
                        </li> -->

                        <li class="nav-item">
                            <a class="nav-link imprimer" style=" margin-left: 280px;"><i
                                    class="fas fa-print fa-2x"></i></a>
                        </li>

                    </ul>
                </div>
                <!-- <div class="col-md-4">
                    <div class="text-center">
                        <a class="navbar-brand" href="../accueil_et_pasges_reponse/accueil.php"><img class="logo"
                                src="../images/logo/Logo_simplifie.png"></a>
                    </div>
                </div> -->

            </div>
        </div>
    </nav>