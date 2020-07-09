<?php

$no_cache = uniqid();

if ($_SESSION["niv"] != 1) {
    header('Location: login.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.css">

    <!-- il faut mettre dans le header car il fait appel avant le CSS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.js"></script>

    <!-- lien pour animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <!--  google font permet de changer la typographie de l'ecriture -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">

    <title>Mt Event</title>
</head>


<body>




    <nav class="navbar navbar-expand-lg">



        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span><i class="fas fa-align-justify"></i>
        </button>

        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">

                <div class="col-md-8">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item active">
                            <a class="btn btn-outline-light " href="../accueil_et_pages_reponse/accueil.php"
                                value="">Site marchand</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="../admin/admin_blog.php">Blog <span
                                    class="sr-only">(current)</span></a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Gestion produits
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="../admin/admin_produits.php">Gestion des produits</a>
                                <a class="dropdown-item" href="../admin/admin_disposition_produits.php">Disposition
                                    produits</a>
                                <a class="dropdown-item" href="../admin/admin_disposition_image_index.php">Produits page
                                    d'accueil</a>

                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../admin/admin_commentaire.php">Commentaire</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../admin/admin_tableau_bord_client.php">Tableau client</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/admin_compte_client.php">Compte client</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/admin_code_reduction.php">code reduction</a>
                        </li>

                    </ul>
                </div>

                <div><a id="cRetour" class="cInvisible" href="#haut"></a></div>


                <div class="col-md-4">

                    <div class="text-center">

                        <?php if (@$_SESSION["id_user"]) { ?>

                        <p class="bienvenue_admin">Bienvenue <?php echo @$_SESSION["nom"]; ?> </p>
                        <p style="color:white;">Date du jour : <?php echo date('d-m-Y'); ?></p>

                        <!-- <a class="btn btn-outline-light" href="mon_compte.php" value="">mon
                            compte</a> -->
                        <a class="btn btn-outline-light" href="../clients/login_out.php" value="">Déconnexion</a>

                        <?php } ?>
                    </div>

                    <!-- <div class="col-md-6">
                                <form class=" form-inline" action="header_admin.php" method="POST">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Recherche</button>
                                </form>
                            </div> -->


                </div>
            </div>
        </div>
        </div>


    </nav>