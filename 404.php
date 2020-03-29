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

    <title>Mt Event</title>

</head>

<div class="container">
    <div class="text-center">
        <h1>PAGE 404</h1>
        <p>Votre page n'a pas été retrouvée</p>
        <p>Nous t'invitons à retourner sur notre site internet en cliquant sur le lien suivant : <a
                href="https://www.mtevent44.fr/">www.mtevent44.fr</a></p>
    </div>
</div>



<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<!-- bootstrapcdn -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<!-- icone fontawesome -->
<script src="https://kit.fontawesome.com/1e0121b17c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>

<!-- scrollmagic -->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>

<!-- Captcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="../js/app.js"></script>

<!--  script pour bouton remonter en haut de la page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.onscroll = function(ev) {
        document.getElementById("cRetour").className = (window.pageYOffset > 100) ? "cVisible" :
            "cInvisible";
    };
});
</script>