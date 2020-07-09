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
    <meta name="Description"
        content="MTevent44 Location matériel à Nantes, pour les événements de mariage, baptême et cousinade avec photos prix et paiement sécurisé sur MTEVENT44.fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name=" theme-color" content="#FFFFFF">

    <!-- Favicone header -->
    <link rel="shortcut icon" href="https://www.mtevent44.fr/images/logo/favicon.ico" type="image/x-icon">
    <link rel="icon" href="https://www.mtevent44.fr/images/logo/favicon.ico" type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- CSS après le point ? permet de rafraichir plus rapidement et avec le css -->
    <link rel="stylesheet" href="../css/style.css?nocache=<?php echo $no_cache; ?>" />

    <!-- Balise canonical -->
    <link rel="canonical" href="http://www.mtevent44.fr" />

    <!-- il faut mettre dans le header car il fait appel avant le CSS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.js"></script>

    <!-- font-wesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--  google font permet de changer la typographie de l'ecriture -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">

    <!-- Police de Caractère -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <!-- ajouter une icône tactile Apple -->
    <link rel="apple-touch-icon" href="https://www.mtevent44.fr/images/logo/logo.png">

    <!-- scrollmagic -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script> -->
    <!-- permet à scroll magic de savoir ou s'active la bulle -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/debug.addIndicators.min.js"></script> -->

    <!-- Captcha -->
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

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


                <div class="col-md-4" id="menu_header">

                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">

                            <?php if (@$_SESSION["niv"] == 1) { ?>
                            <a class="btn btn-outline-light" href="https://www.mtevent44.fr/admin/admin_index.php"
                                value="">Admin</a>
                            <?php } ?>
                        </li>

                        <!-- Page Accueil -->
                        <li class="nav-item active">
                            <a class="nav-link" href="https://www.mtevent44.fr/accueil_et_pages_reponse/accueil"
                                aria-label="accueil">Accueil
                                <span class="sr-only">(current)</span></a>
                        </li>

                        <!-- Page Application -->
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.mtevent44.fr/jeu_decouvert/jeu_decouvert"
                                aria-label="application">Jeux</a>
                        </li>

                        <!-- Page Produits -->
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.mtevent44.fr/produits/produits"
                                aria-label="produits">Produits</a>
                        </li>

                        <!-- Page Idées -->
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.mtevent44.fr/page_idee/idees"
                                aria-label="idees">Blog</a>
                        </li>

                        <!-- Boutton modal -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#exampleModal"
                                aria-label="contact">Contact </a>
                        </li>

                        <!-- Boutton Recherche -->
                        <!-- <li class="nav-item">
                            <a class="nav-link " href="#collapseExample" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="collapseExample" aria-label="rechercher">
                                <i class="fas fa-search fa-1x"></i>
                            </a>
                        </li> -->

                    </ul>
                </div>

            </div>
            <div class="col-md-4" id="image_header">
                <div class="text-center">
                    <!-- Logo -->
                    <a class="navbar-brand" id="haut" href="https://www.mtevent44.fr/accueil_et_pages_reponse/accueil"
                        aria-label="accueil"><img class="logo" src="https://www.mtevent44.fr/images/logo/logo.png"
                            alt="logo"></a>

                    <!-- Input permet de revenir vers le haut de la page -->
                    <div><a id="cRetour" class="cInvisible" href="#haut" aria-label="haut_page"></a></div>

                </div>
            </div>


            <div class="col-md-4">

                <div class="text-center">

                    <?php if (@$_SESSION["id_user"]) { ?>
                    <p class="bienvenue mt-2">Bienvenue <?php echo @$_SESSION["nom"]; ?> </p>
                    <!-- mon compte, deconnexion,Panier, bouton recherche -->

                    <a class="btn btn-outline-light mr-sm-2" href="https://www.mtevent44.fr/clients/mon_compte"
                        aria-label="mon compte">Mon
                        compte</a>

                    <a class="btn btn-outline-light mr-sm-2" href="https://www.mtevent44.fr/clients/login_out.php"
                        aria-label="login">Déconnexion</a>

                    <br>

                    <!-- Affiche la date du jour  -->
                    <p class="nav-link " style="margin-bottom: 0px;">Date du jour : <?php echo date('d-m-Y'); ?> </p> <a
                        class="nav-link " href="https://www.mtevent44.fr/clients/panier" aria-label="panier"><i
                            class="fas fa-shopping-cart fa-2x"></i></a>


                    <?php } else { ?>

                    <!-- login -->
                    <p class="seconnecter">Se connecter</p> <a class="nav-link" href="../clients/login"><i
                            class="fas fa-user fa-2x"></i></a><br>
                    <?php } ?>

                </div>

            </div>


        </div>




    </nav>





    <form action="recherche.php" method="POST">


        <div class="collapse" id="collapseExample">
            <div class=" container">
                <div class="row">

                    <input class="form-control btn-sm" type="text" placeholder="Recherche" name="recherche"
                        aria-label="Recherche" style="width:75%">
                    <button class="btn btn-outline color-143054 my-2 my-sm-0" name="recherche_input" type="submit"
                        value="recherche_input"><i class="fas fa-search-location"> Recherche</i></button>

                </div>

            </div>
        </div>


    </form>