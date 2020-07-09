<?php

$no_cache = uniqid();


if (isset($_POST["verifier"])) {
    $login = $_POST["login"];
    $passe = $_POST["passe"];
    $erreur =  verif_login($login, $passe);
}




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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.css"> -->

    <!-- il faut mettre dans le header car il fait appel avant le CSS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.js"></script>

    <!-- font-wesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--  google font permet de changer la typographie de l'ecriture -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">

    <!-- Police de Caractère -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <title>Mt Event</title>

</head>


<body>


    <nav class="navbar navbar-expand-lg">

        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span><i class="fas fa-align-justify"></i>
        </button>



        <div class="collapse navbar-collapse" id="navbarText" style="color: white">
            <div class="container-fluid">

                <div class="col-md-4" id="menu_header">

                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">

                            <?php if (@$_SESSION["niv"] == 1) { ?>
                            <a class="btn btn-outline-light" href="../admin/admin_index.php" value="">Admin</a>
                            <?php } ?>
                        </li>

                    </ul>
                </div>


                <div class="col-md-4" id="image_header">
                    <div class="text-center">
                        <!-- Logo -->
                        <a class="navbar-brand" id="haut"
                            href="https://www.mtevent44.fr/accueil_et_pages_reponse/accueil.php"
                            aria-label="accueil"><img class="logo" src="https://www.mtevent44.fr/images/logo/logo.png"
                                alt="location"></a>

                        <!-- Input permet de revenir vers le haut de la page -->
                        <div><a id="cRetour" class="cInvisible" href="#haut" aria-label="haut_page"></a></div>

                    </div>
                </div>


                <div class="col-md-4">

                    <div class="text-center">

                        <?php if (@$_SESSION["id_user"]) { ?>
                        <p class="bienvenue">Bienvenue <?php echo @$_SESSION["nom"]; ?> </p>
                        <!-- mon compte, deconnexion,Panier, bouton recherche -->

                        <!-- Affiche la date du jour  -->
                        <p>Date du jour : <?php echo date('d-m-Y'); ?></p> <a class="nav-link "
                            href="../clients/panier.php" aria-label="panier"><i
                                class="fas fa-shopping-cart fa-2x"></i></a>


                        <?php } else { ?>

                        <!-- login -->
                        <p class="seconnecter">Se connecter</p> <a class="nav-link" href="../clients/login.php"><i
                                class="fas fa-user fa-2x"></i></a><br>
                        <?php } ?>

                    </div>

                </div>

            </div>
        </div>

    </nav>