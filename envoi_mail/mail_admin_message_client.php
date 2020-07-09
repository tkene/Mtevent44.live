<?php
@$nom = $_GET['nom'];
@$prenom = $_GET['prenom'];
@$text_message_client = urldecode($_GET['text_message_client']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Message MTevent44 </h1>
    <p>Bonjour <?php echo  @$prenom . " " . @$nom ?>,</p>



    <p>
        <?php echo $text_message_client ?>
    </p>

    <p>Lien sur le site de location : </p><a href="www.MTevent44.fr">www.MTevent44.fr</a>
    <br>
    <!-- <img class="" src="https://www.mtevent44.fr/images/logo/redimensionne/LogoMT.jpg"> -->

</body>

</html>