<?php

define('AES_KEY',  'KHOzQvH8ED8Jt6JcOuDsO6whgwXwFPXt');
define('AES_IV',   '2WLvx9Hv9ZWXaEmC');

define("PDO_HOST", "mteventfkv568.mysql.db");
define("PDO_DBBASE", "mteventfkv568");
define("PDO_USER", "mteventfkv568");
define("PDO_PW", "Maevatuan1404");
try {
    $connection = new PDO(
        "mysql:host=" . PDO_HOST . ";" .
            "dbname=" . PDO_DBBASE,
        PDO_USER,
        PDO_PW,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}