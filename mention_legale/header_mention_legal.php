<?php

$no_cache = uniqid();


// if (isset($_POST["verifier"])) {
//     $login = $_POST["login"];
//     $passe = $_POST["passe"];
//     $erreur =  verif_login($login, $passe);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script> -->
    <!-- permet à scroll magic de savoir ou s'active la bulle -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/debug.addIndicators.min.js"></script> -->

    <!-- Captcha -->
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

    <title>Mt Event</title>
</head>


<body>




    <div class="container">

        <div class="text-center">


            <a class="" id="haut" href=""><img class="text-center"
                    src="https://www.mtevent44.fr/images/logo/logo_header_mention_legal.jpg"></a>
            <div><a id="cRetour" class="cInvisible" href="#haut"></a></div>
            <br>
            <div> <a class="" href="https://www.mtevent44.fr/accueil_et_pages_reponse/accueil.php"
                    style="color:#143054"><i class="fas fa-arrow-left fa-2x" style="color:#143054"></i> Retour</a></div>
        </div>

    </div>

</body>

</html>