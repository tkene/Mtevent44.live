<?php

include "../connect/connect.php";
include "../fonctions/fonction.php";

@$id_user = $_GET["id"];


if ($id_user) {

    header('location:https://www.mtevent44.fr/clients/panier.php');
}