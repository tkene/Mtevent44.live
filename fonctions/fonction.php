<?php


// <!-------------------------------------------------------->
// <!--------------- // demmarage des sessions--------------->
// <!-------------------------------------------------------->

session_start();

// <!-------------------------------------------------------->
// <!---------------Verification des login ------------------>
// <!-------------------------------------------------------->

function verif_login($login, $passe)
{


    global  $connection;
    $sql =
        "SELECT * 
    FROM users 
    WHERE mail='$login'";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':mail' => $login
    ));

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    if ($login == isset($resultat->mail)) {
        if (password_verify($passe, $resultat->passeword)) {

            // redirection sur les pages 
            if ($resultat->niv == 1) {

                $_SESSION["id_user"] = $resultat->id_user;
                $_SESSION["niv"] = $resultat->niv;
                $_SESSION["nom"] = $resultat->nom;
                $_SESSION["prenom"] = $resultat->prenom;

                header('Location:../admin/admin_index.php');
                exit();
            } else {

                $_SESSION["id_user"] = $resultat->id_user;
                $_SESSION["niv"] = $resultat->niv;
                $_SESSION["nom"] = $resultat->nom;
                $_SESSION["prenom"] = $resultat->prenom;
                $_SESSION["civilite"] = $resultat->civilite;
                $_SESSION["mail"] = $resultat->mail;
                $_SESSION["tel"] = $resultat->phone;

                header('Location:../accueil_et_pages_reponse/accueil_user.php');
                exit();
            }
        } else {
            $erreur = "Mot de passe incorrect";
            return $erreur;
        }
    } else {
        $erreur = "Votre login est faux.";
        return $erreur;
    }
}

// Fonction pour crypter un mot de passe
function cryptage($password)
{
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    return $pass_hash;
}


//<!---------------------------------------------------------------->
//<!-----------------fonction inscription--------------------------->
//<!---------------------------------------------------------------->

function incription($civil, $nom, $prenom, $mail_visiteur, $tel, $pass_hash)
{

    // recup de la connection
    global $connection;
    // insert dans la table users
    $sql_ins =
        "INSERT INTO users(civilite, nom, prenom, mail, phone, passeword)
VALUES (:civilite, :nom, :prenom, :mail, :phone, :passeword)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':civilite' => $civil,
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':mail' => $mail_visiteur,
        ':phone' => $tel,
        ':passeword' => $pass_hash


    ));

    //var_dump($sth);
}




//<!---------------------------------------------------------------->
//<!-----fonction verifie si adresse mail déjà créer---------------->
//<!---------------------------------------------------------------->

function doublonclient($mail)
{
    global $connection;


    $sql =
        "SELECT *
FROM users
WHERE mail = :mail";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':mail' => $mail
    ));

    $resultat = $sth->fetch(PDO::FETCH_OBJ);



    return @$resultat->mail;
}


//<!---------------------------------------------------------------->
//<!------------------Doublon mot de passe oublié ------------------>
//<!---------------------------------------------------------------->

function motdepasse_oublie($adresse_mail)
{
    global $connection;


    $sql =
        "SELECT *
FROM users
WHERE mail = :mail";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':mail' => $adresse_mail
    ));

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    return @$resultat->mail;
}

function recup_id($adresse_mail)
{


    global  $connection;
    $sql =
        "SELECT * 
    FROM users 
    WHERE mail='$adresse_mail'";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return @$resultat->id_user;
}

function modifier_motdepasse($id_user, $mot_de_passe1)
{

    $cryptage =  cryptage($mot_de_passe1, PASSWORD_DEFAULT);

    global $connection;
    $sql = "UPDATE users
    SET passeword = :passeword
    WHERE id_user = :id_user";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':passeword' => $cryptage,
        ':id_user' => $id_user

    ));

    //var_dump($id_user);
}

function verification_id($var2)
{

    global $connection;
    $sql = "SELECT *
    FROM users
    WHERE id_user = $var2";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    return $resultat;
    // if ($var2 == isset($resultat->id_user)) {
    //     echo 'ok id existant';
    // } else {
    //     echo "id n'existent pas";
    // }

    //var_dump($resultat);
}




//<!-------------------------------------------------------->
//<!-------------------ajout des produits-------------------->
//!-------------------------------------------------------->

function insert_produit($titre_produit, $produit_court, $produit_long, $quantite, $prix_ttc, $choix_tva)
{
    // recup de la connection
    global $connection;
    // insert dans la table produits
    $sql_ins =
        "INSERT INTO produits(nom_produit,produit_court,produit_long,ref,prix,tva)
VALUES (:nom_produit, :produit_court, :produit_long, :ref, :prix, :tva) ";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':nom_produit' => $titre_produit,
        ':produit_court' => $produit_court,
        ':produit_long' => $produit_long,
        ':ref' => $quantite,
        ':prix' => $prix_ttc,
        ':tva' => $choix_tva


    ));

    //var_dump($commentaire);

    // // recuperation de id_produit
    $id_produit = $connection->lastInsertId();

    // $id_user = $_SESSION["id_user"];
    // // appel la function pour passer les id
    //produit_unique($id_produit);


    img_load($id_produit);

    // $sql = "UPDATE images
    // SET name_photo = '$filename'
    // WHERE id_produit = $id_produit";
    // $sth = $connection->prepare($sql);
    // $sth->execute();


    return $id_produit;

    //var_dump($filename);
}

// <!-------------------------------------------------------->
// <!---------------recuperation des id --------------------->
// <!-------------------------------------------------------->

function insert_liaison_produits($id_produit, $id_categorie)
{
    // recup de la connection
    global $connection;

    $sql_ins = "INSERT INTO  liaisons_produits(id_produit, id_categorie) VALUES (:id_produit, :id_categorie)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':id_produit' => $id_produit,
        ':id_categorie' => $id_categorie

    ));
}

function insert_categorie($titre_categorie)
{
    // recup de la connection
    global $connection;
    // insert dans la table produits
    $sql_ins =
        "INSERT INTO categories(nom_categorie)
        VALUES (:nom_categorie) ";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':nom_categorie' => $titre_categorie


    ));


    // // recuperation de id_categorie
    $id_produit = $connection->lastInsertId();
    return $id_produit;
}

//<!-------------------------------------------------------->
//<!---------récup un article demandé par id_article-------->
//<!-------------------------------------------------------->

function produit_unique($id_produit)
{

    global $connection;

    $sql =
        "SELECT *
FROM liaisons_produits
INNER JOIN produits ON produits.id_produit = liaisons_produits.id_produit
INNER JOIN categories ON  categories.id_categorie = liaisons_produits.id_categorie
WHERE liaisons_produits.id_produit = $id_produit
";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    return $resultat;

    $_SESSION["nom_produit"] = $resultat->nom_produit;
    $_SESSION["nom_court"] = $resultat->nom_court;
    $_SESSION["id_produit"] = $resultat->id_produit;
    $_SESSION["id_categorie"] = $resultat->id_categorie;

    //var_dump($resultat);


}





//<!-------------------------------------------------------->
//<!---------récup un article demandé par id_article-------->
//<!-------------------------------------------------------->

function image_unique($id_produit)
{
    global $connection;
    $sql =
        "SELECT *
FROM images
WHERE id_produit = $id_produit
";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;


    //var_dump($resultat);


    // //recuperation de l'image
    // $filename = img_load($id_produit);
    // if (isset($filename)) {
    //     //update pour le nom de l'image
    //     $sql = "UPDATE images
    // SET name_photo = '$filename'
    // WHERE id_produit = $id_produit";
    //     $sth = $connection->prepare($sql);
    //     $sth->execute();
    // }
}

//<!-------------------------------------------------------->
//<!---------------------récup user ------------------------>
//<!-------------------------------------------------------->

function user_unique()
{
    global $connection;

    $sql =
        "SELECT *
FROM users
WHERE id_user=''";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    return $resultat;
    var_dump($resultat);
}



//<!-------------------------------------------------------->
//<!--------- fonction qui permet de modifier--------------->
//<!-------------------------------------------------------->


function modif_compte($id_user, $civil, $nom, $prenom, $mail, $telephone)
{
    global $connection;

    //modification de l'article
    $sql = "UPDATE users
SET civilite='$civil',nom ='$nom', prenom='$prenom', mail='$mail', phone='$telephone'
WHERE id_user='$id_user'";
    $sth = $connection->prepare($sql);
    $sth->execute();


    $_SESSION["nom"] = $nom;
    $_SESSION["prenom"] = $prenom;
    $_SESSION["civilite"] = $civil;
    $_SESSION["mail"] = $mail;
    $_SESSION["tel"] = $telephone;
}

//<!-------------------------------------------------------->
//<!--------- fonction qui permet de modifier--------------->
//<!-------------------------------------------------------->


function modif_article(
    $id_produit,
    $titre_produit,
    $produit_long,
    $produit_court,
    $quantite,
    $prix_ttc,
    $choix_tva

) {
    global $connection;

    //modification de l'article
    $sql = "UPDATE produits
SET produit_long = :text_long, produit_court = :text_court, nom_produit = :titre_produit, ref = :quantite,
prix = :prix_sans, tva = :choix_tva
WHERE id_produit = :id_produit";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':text_long' => $produit_long,
        ':text_court' => $produit_court,
        ':titre_produit' => $titre_produit,
        ':quantite' => $quantite,
        ':prix_sans' => $prix_ttc,
        ':choix_tva' => $choix_tva,
        ':id_produit' => $id_produit
    ));

    //modification de la liaisons
    // $sql = "UPDATE liaisons
    // SET id_categorie = '$id_categorie'
    // WHERE id_article = $id_article";
    // $sth = $connection->prepare($sql);
    // $sth->execute();


    // Sélection de l'image pour comparaison
    // $sql_img = "SELECT * FROM articles where id_article = $id_article ";
    // $sth = $connection->prepare($sql_img);
    // $sth->execute();

    // $resultat = $sth->fetch(PDO::FETCH_OBJ);

    // //detruire l'image si différente de l'image upload
    // if ($_FILES["image"]["name"] != "") {

    // if (isset($resultat->img)) {

    // if ($resultat->img != $_FILES["image"]["name"]) {

    // unlink("upload/" . @$resultat->img);
    // }
    // }
    // }
    //var_dump($sth_img);


    // //recuperation de l'image
    // $filename = img_load($id_produit);
    // if (isset($filename)) {
    //     //update pour le nom de l'image
    //     $sql = "UPDATE images
    // SET name_photo = '$filename'
    // WHERE id_produit = $id_produit";
    //     $sth = $connection->prepare($sql);
    //     $sth->execute();
    // }
}


function modif_categorie($titre_categorie, $id_categorie)
{

    global $connection;

    //modification de l'article
    $sql = "UPDATE categories
SET nom_categorie='$titre_categorie'
WHERE id_categorie = $id_categorie";
    $sth = $connection->prepare($sql);
    $sth->execute();

    //     //modification de la liaisons
    //     $sql = "UPDATE liaisons
    //     SET id_categorie = '$id_categorie'
    //     WHERE id_article = $id_article";
    //     $sth = $connection->prepare($sql);
    //     $sth->execute();
}

//<!-------------------------------------------------------->
//<!---------fonction permet de supprimer l'article -------->
//<!-------------------------------------------------------->

function supprimer_article($id_produit)
{
    global $connection;
    $sql = "UPDATE produits
            SET actif = 0
            WHERE id_produit = $id_produit";
    $sth = $connection->prepare($sql);
    $sth->execute();
    @header('Location:../admin/admin_produits.php');
}


// //
// <!-------------------------------------------------------->
// //
// <!---------------permet de changer les orders ------------>
// //
// <!-------------------------------------------------------->

function envoi_order($order, $id_produit)
{

    var_dump($id_produit);


    global $connection;
    $sql = "UPDATE produits
    SET ordernum=$order
    WHERE id_produit=$id_produit ORDER BY ordernum ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // header('Location:admin_disposition_produits.php');
}


// //
// <!-------------------------------------------------------->
// //
// <!---------------select liste des titres------------------>
// //
// <!-------------------------------------------------------->
// select liste des titres ---- ORDER BY "ASC ou DESC "--> permet de mettre dans l'ordre alphabétique

function liste_titre()
{
    global $connection;
    $sql = "SELECT id_produit, nom_produit, ordernum FROM produits WHERE actif=1 ORDER BY nom_produit ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

function liste_categorie()
{
    global $connection;
    $sql = "SELECT * FROM categories";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

// //
// <!-------------------------------------------------------->
// //
// <!----------------------recup l'image--------------------->
// //
// <!-------------------------------------------------------->


function recup_image($id_produit)
{
    global $connection;
    $sql = "SELECT * FROM images WHERE status=1 AND id_produit = $id_produit  ORDER BY name_photo ASC LIMIT 1";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    return $resultat;
}


// <!-------------------------------------------------------->
// <!----------------------recup l'image--------------------->
// <!-------------------------------------------------------->


function recup_image_index()
{
    global $connection;
    $sql = "SELECT name_photo FROM images WHERE status=1  RAND() LIMIT 4";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}





// //
// <!-------------------------------------------------------->
// //
// <!---------------select liste---------------------------->
// //
// <!-------------------------------------------------------->
// select liste des titres ---- ORDER BY "ASC ou DESC "--> permet de mettre dans l'ordre alphabétique

function liste_ordernum()
{
    global $connection;
    // $sql = "SELECT id_produit, nom_produit, ordernum, produit_court, prix, ref  FROM produits WHERE actif=1 ORDER BY ordernum ASC ";
    // $sth = $connection->prepare($sql);
    // $sth->execute();


    $sql =
        "SELECT *
        FROM liaisons_produits
        INNER JOIN produits ON produits.id_produit = liaisons_produits.id_produit
        INNER JOIN categories ON categories.id_categorie = liaisons_produits.id_categorie
        WHERE produits.actif =1  ORDER BY produits.ordernum ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;

    // global $connection;
    // $sql = "SELECT * FROM images WHERE actif=1 ORDER BY name_photo ASC LIMIT 1";
    // $sth = $connection->prepare($sql);
    // $sth->execute();

    // $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    // return $resultat;
}


// //
// <!-------------------------------------------------------->
// //
// <!---------------------récup user ------------------------>
// //
// <!-------------------------------------------------------->

function liste_produit()
{
    global $connection;

    $sql =
        "SELECT *
FROM produits
ORDER BY ordernum";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
    //var_dump($resultat);
}



//<!-------------------------------------------------------->
//<!-------------------ajout titre idee-------------------->
//!-------------------------------------------------------->



function insert_image_idee($titre_image, $id_image, $id_categorie)
{
    // recup de la connection
    global $connection;
    // insert dans la table articles
    $sql_ins = "INSERT INTO idee(titre_image)
                VALUES (:titre_image) ";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':titre_image' => $titre_image


    ));



    // recuperation de id_article
    $id_image = $connection->lastInsertId();

    //$id_user = $_SESSION["id_user"];
    // appel la function pour passer les id
    //image_idee_unique($id_image);
    insert_liaison($id_image, $id_categorie);
    //var_dump(insert_liaison($id_image, $id_categorie));
    $filename = img_load_idee($id_image);

    $sql = "UPDATE idee
    SET images_idee = '$filename'
    WHERE id_idee = $id_image";
    $sth = $connection->prepare($sql);
    $sth->execute();

    return $id_image;
}

//<!-------------------------------------------------------->
//<!-------------------ajout index image-------------------->
//!-------------------------------------------------------->



function insert_image_index($titre_image, $id_image)
{
    // recup de la connection
    global $connection;
    // insert 
    $sql_ins = "INSERT INTO index_image(titre_image)
                VALUES (:titre_image) ";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':titre_image' => $titre_image


    ));



    // recuperation de id_article
    $id_image = $connection->lastInsertId();

    //$id_user = $_SESSION["id_user"];
    // appel la function pour passer les id
    //image_idee_unique($id_image);
    //insert_liaison($id_image, $id_categorie);
    //var_dump(insert_liaison($id_image, $id_categorie));
    $filename  = img_load_index();

    $sql = "UPDATE index_image
    SET images_index = '$filename'
    WHERE id_index_image = $id_image";
    $sth = $connection->prepare($sql);
    $sth->execute();

    return $id_image;
}




//<!-------------------------------------------------------->
//<!---------récup un article demandé par id_article-------->
//<!-------------------------------------------------------->

function image_idee_unique($id_image)
{

    global  $connection;

    $sql =  "SELECT *  FROM liaisons 
    INNER JOIN idee ON idee.id_idee = liaisons.id_idee
    INNER JOIN categories ON categories.id_categorie = liaisons.id_categorie
    -- INNER JOIN users ON users.id_user = liaisons.id_user
    -- LEFT JOIN tag ON tag.id_article = articles.id_article
    WHERE liaisons.id_idee = $id_image";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;

    var_dump($resultat);
}

//<!-------------------------------------------------------->
//<!---------récup une image demandé par id_article-------->
//<!-------------------------------------------------------->

function image_idee_unique_index($id_image)
{

    global  $connection;

    $sql =  "SELECT *  FROM index_image WHERE id_index_image = $id_image";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;

    //var_dump($resultat);
}




// <!-------------------------------------------------------->
// <!---------------select liste des images------------------>
// <!-------------------------------------------------------->
// select liste des titres  ---- ORDER BY  "ASC ou DESC "--> permet de mettre dans l'ordre alphabétique

function liste_image()
{
    global  $connection;
    $sql = "SELECT id_idee, titre_image FROM idee WHERE actif=1 ORDER BY titre_image ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

// <!-------------------------------------------------------->
// <!---------------select index liste des images------------------>
// <!-------------------------------------------------------->
// select liste des titres  ---- ORDER BY  "ASC ou DESC "--> permet de mettre dans l'ordre alphabétique

function liste_image_index()
{
    global  $connection;
    $sql = "SELECT id_index_image, titre_image FROM index_image WHERE actif=1";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}


// <!-------------------------------------------------------->
// <!---------------liste des categories -------------------->
// <!-------------------------------------------------------->

function liste_cat()
{
    global  $connection;
    $sql = "SELECT * FROM categories";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

// <!-------------------------------------------------------->
// <!---------------recuperation des id --------------------->
// <!-------------------------------------------------------->

function insert_liaison($id_image, $id_categorie)
{
    // recup de la connection
    global $connection;

    $sql_ins = "INSERT INTO  liaisons(id_idee, id_categorie) VALUES (:id_idee, :id_categorie)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':id_idee' => $id_image,
        ':id_categorie' => $id_categorie

    ));
}


// <!-------------------------------------------------------->
// <!-- fonction qui permet de modifier titre / choix des catégories / article--------------->
// <!-------------------------------------------------------->
//

function modif_image_idee($id_image, $id_categorie, $titre_image)
{
    global $connection;

    //modification de l'article
    $sql = "UPDATE idee
    SET titre_image = '$titre_image'
    WHERE id_idee = $id_image";
    $sth = $connection->prepare($sql);
    $sth->execute();

    //modification de la liaisons
    $sql = "UPDATE liaisons
    SET id_categorie = '$id_categorie'
    WHERE id_idee = $id_image";
    $sth = $connection->prepare($sql);
    $sth->execute();


    // Sélection de l'image pour comparaison
    $sql_img = "SELECT * FROM idee where id_idee = $id_image ";
    $sth = $connection->prepare($sql_img);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    //detruire l'image si différente de l'image upload
    if ($_FILES["image"]["name"] != "") {

        if (isset($resultat->images_idee)) {

            if ($resultat->images_idee != $_FILES["image"]["name"]) {

                unlink("uploads/" . @$resultat->images_idee);
            }
        }
    }
    //var_dump($sth_img);


    //recuperation de l'image
    $filename =  img_load_idee($id_image);
    if (isset($filename)) {
        //update pour le nom de l'image
        $sql = "UPDATE idee
    SET images_idee = '$filename'
    WHERE id_idee = $id_image";
        $sth = $connection->prepare($sql);
        $sth->execute();
    }
}


// <!-------------------------------------------------------->
// <!-- fonction qui permet de modifier titre / choix des catégories / article--------------->
// <!-------------------------------------------------------->
//

function modif_image_index($id_image, $titre_image)
{
    global $connection;

    //modification de l'article
    $sql = "UPDATE index_image
    SET titre_image = '$titre_image'
    WHERE id_index_image = $id_image";
    $sth = $connection->prepare($sql);
    $sth->execute();

    // //modification de la liaisons
    // $sql = "UPDATE liaisons
    // SET id_categorie = '$id_categorie'
    // WHERE id_idee = $id_image";
    // $sth = $connection->prepare($sql);
    // $sth->execute();


    // Sélection de l'image pour comparaison
    $sql_img = "SELECT * FROM index_image where id_index_image = $id_image ";
    $sth = $connection->prepare($sql_img);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    //detruire l'image si différente de l'image upload
    if ($_FILES["image"]["name"] != "") {

        if (isset($resultat->images_idee)) {

            if ($resultat->images_idee != $_FILES["image"]["name"]) {

                unlink("uploads/" . @$resultat->images_idee);
            }
        }
    }
    //var_dump($sth_img);


    //recuperation de l'image
    $filename =  img_load_index($id_image);
    if (isset($filename)) {
        //update pour le nom de l'image
        $sql = "UPDATE index_image
    SET images_index = '$filename'
    WHERE id_index_image = $id_image";
        $sth = $connection->prepare($sql);
        $sth->execute();
    }
}

// <!-------------------------------------------------------->
// <!---------fonction permet de supprimer l'article -------->
// <!-------------------------------------------------------->

function supprimer_image_idee($id_image)
{
    global $connection;
    $sql = "UPDATE idee
    SET actif = 0
    WHERE id_idee = $id_image";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

// <!-------------------------------------------------------->
// <!---------fonction permet de supprimer l'article -------->
// <!-------------------------------------------------------->

function supprimer_image_index($id_image)
{
    global $connection;
    $sql = "UPDATE index_image
    SET actif = 0
    WHERE id_index_image = $id_image";
    $sth = $connection->prepare($sql);
    $sth->execute();
}


// //
// <!-------------------------------------------------------->
// //
// <!---------------permet de changer les orders ------------>
// //
// <!-------------------------------------------------------->

function envoi_order_idee($order_idee, $id_idee)
{

    //var_dump($id_produit);


    global $connection;
    $sql = "UPDATE idee
    SET ordernum=$order_idee
    WHERE id_idee=$id_idee ORDER BY ordernum ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // header('Location:admin_disposition_produits.php');
}





// <!-------------------------------------------------------->
// <!---------récup un article demandé par id_produit-------->
// <!-------------------------------------------------------->

function produit_unique_entier($id_product)
{

    global  $connection;

    // $sql =  "SELECT *  FROM produits 
    // WHERE id_produit = $id_product";



    $sql =
        "SELECT *
        FROM liaisons_produits
        INNER JOIN produits ON produits.id_produit = liaisons_produits.id_produit
        INNER JOIN categories ON categories.id_categorie = liaisons_produits.id_categorie
        WHERE produits.id_produit =$id_product ";



    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;

    //var_dump(article_unique($id_article));
}

// //
// <!-------------------------------------------------------->
// //
// <!----------------------recup l'image--------------------->
// //
// <!-------------------------------------------------------->


function recup_des_images($id_product)
{
    global $connection;
    $sql = "SELECT * FROM images WHERE status=1 AND id_produit = $id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}





// <!-------------------------------------------------------->
// //
// <!---------------select liste---------------------------->
// //
// <!-------------------------------------------------------->
// select liste des titres ---- ORDER BY "ASC ou DESC "--> permet de mettre dans l'ordre alphabétique

function liste_idee()
{
    global $connection;
    $sql = "SELECT * FROM idee WHERE actif=1 ORDER BY images_idee ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}


// <!-------------------------------------------------------->
// <!----------------------Page index------------------------>
// <!-------------------------------------------------------->


function recup_produit_index_random()
{
    global $connection;
    $sql = "SELECT * FROM index_image 
    -- INNER JOIN images ON images.id_produit = produits.id_produit
    ";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}


// <!-------------------------------------------------------->
// <!----------------------Calendrier------------------------>
// <!-------------------------------------------------------->

function calendrier($id_product, $id_user)
{
    // recup de la connection
    global $connection;

    $sql_ins = "INSERT INTO  calendrier(id_produit, id_user) VALUES (:id_produit, :id_user) ";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':id_produit' => $id_product,
        ':id_user ' => $id_user

    ));
}


// <!---------------------------------------------------------------------------->
// <!----------------------salect toutes les informations------------------------>
// <!---------------------------------------------------------------------------->

function liste_locative_client($id_user)
{

    global $connection;
    $sql = "SELECT * FROM panier
    INNER JOIN users ON users.id_user = panier.id_user
    INNER JOIN produits ON produits.id_produit = panier.id_produit
    INNER JOIN liaisons_produits ON liaisons_produits.id_produit = produits.id_produit
    WHERE users.id_user = $id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

// <!---------------------------------------------------------------------------->
// <!----------------------Liste des clients en attente-------------------------->
// <!---------------------------------------------------------------------------->

function liste_client_attente()
{

    global $connection;
    $sql = "SELECT * FROM panier
     INNER JOIN users ON users.id_user = panier.id_user
    INNER JOIN produits ON produits.id_produit = panier.id_produit";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}



// <!---------------------------------------------------------------------------->
// <!----------------------Liste des clients en attente-------------------------->
// <!---------------------------------------------------------------------------->

function liste_paiement($id_paiement)
{

    global $connection;
    $sql = "SELECT * FROM panier
    INNER JOIN users ON users.id_user = panier.id_user
    INNER JOIN produits ON produits.id_produit = panier.id_produit
    INNER JOIN paiement ON paiement.id_paiement = panier.id_paiement
    INNER JOIN liaisons_produits ON liaisons_produits.id_produit = panier.id_produit
    WHERE panier.id_paiement = $id_paiement";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}



// <!---------------------------------------------------------------------------->
// <!----------------------Liste des clients en attente-------------------------->
// <!---------------------------------------------------------------------------->

function affiche_produit_facture($id_user)
{

    global $connection;
    $sql = "SELECT * FROM panier
        WHERE panier.id_user = $id_user AND id_paiement";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}




//<!---------------------------------------------------------------------->
//<!--------- fonction qui permet de update la confirmation--------------->
//<!---------------------------------------------------------------------->


function attente_gestion_locative_2($id_produit, $id_user)
{
    global $connection;


    $sql = "UPDATE panier
SET confirmation_panier= 2
WHERE id_produit='$id_produit' AND id_user='$id_user' AND confirmation_panier = 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

//<!---------------------------------------------------------------------->
//<!-----------------------------Relance---------------------------------->
//<!---------------------------------------------------------------------->


function relance($id_produit, $id_user)
{
    global $connection;

    $sql = "UPDATE panier
SET relance = 'oui'
WHERE id_produit=$id_produit AND id_user=$id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    //var_dump($sth);
}


//<!---------------------------------------------------------------------->
//<!-----------------------message tableau de bord------------------------>
//<!---------------------------------------------------------------------->


function message_tableau_bord($id_produit, $id_user, $message)
{
    global $connection;

    $sql = "UPDATE panier
SET commentaire = '$message'
WHERE id_produit=$id_produit AND id_user=$id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    //var_dump($sth);
}

//<!---------------------------------------------------------------------->
//<!-----------------------table paiement commentaire------------------------>
//<!---------------------------------------------------------------------->


function table_paiement_commentaire($id_user, $id_paiement, $message_location, $check)
{
    global $connection;

    $sql = "UPDATE paiement
SET commentaire = '$message_location', recup_par_client = '$check' 
WHERE  id_user=$id_user AND id_paiement=$id_paiement";
    $sth = $connection->prepare($sql);
    $sth->execute();
    //var_dump($sth);
}

//<!---------------------------------------------------------------------->
//<!--------- fonction qui permet de update la confirmation--------------->
//<!---------------------------------------------------------------------->


function delete_produit($id_produit, $id_user)
{
    global $connection;


    $sql = "DELETE FROM panier
WHERE id_produit='$id_produit' AND id_user='$id_user' AND confirmation_panier = 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

function delete_produit_apres_validation($id_produit, $id_user)
{
    global $connection;


    $sql = "DELETE FROM panier
WHERE id_produit='$id_produit' AND id_user='$id_user' AND confirmation_panier = 2";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

//<!---------------------------------------------------------------------->
//<!--------- fonction qui permet de update la confirmation--------------->
//<!---------------------------------------------------------------------->


function attente_gestion_locative_3($id_produit, $id_user)
{
    global $connection;
    $sql = "UPDATE panier
SET confirmation_panier = 3
WHERE id_produit=$id_produit AND id_user=$id_user AND confirmation_panier = 2";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

//<!------------------------------------------------------------------------->
//<!---------fonction permet de supprimer supprimer la demande client-------->
//<!------------------------------------------------------------------------->

function supprimer_demande_client($id_produit, $id_user)
{
    global $connection;
    $sql = "UPDATE demande_location_client
SET confirmation = 0
WHERE id_produit=$id_produit AND id_user=$id_user AND confirmation = 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
}



// <!---------------------------------------------------------------------------->
// <!----------------------salect toutes les informations------------------------>
// <!---------------------------------------------------------------------------->

function recup_panier($id_user)
{
    global $connection;
    $sql = "SELECT * FROM panier
    INNER JOIN users ON users.id_user = panier.id_user
    INNER JOIN produits ON produits.id_produit = panier.id_produit
    -- INNER JOIN images ON images.id_produit = panier.id_produit
    WHERE users.id_user = $id_user
    
    ORDER BY id_panier ASC 
    ";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;

    $_SESSION["nom_user"] = $resultat->nom;
    $_SESSION["nom_prenom"] = $resultat->prenom;
}



// <!------------------------------------------------------------------------------------------------------------>
// <!---------------------------------page produit entier fonction ajouter produit------------------------------->
// <!------------------------------------------------------------------------------------------------------------>


function ajout_produit($id_product, $id_user, $demande)
{
    global $connection;

    $sql = "INSERT INTO panier SET id_produit='$id_product', id_user='$id_user', date_demande='$demande'";
    $sth = $connection->prepare($sql);
    $sth->execute();
}


//<!----------------------------------------------------------------------------->
//<!-----fonction verifie si produit déjà existant dans le panier---------------->
//<!----------------------------------------------------------------------------->

function verif_doublon_article_user($id_user, $id_produit)
{
    global $connection;


    $sql =
        "SELECT *
FROM panier
WHERE id_user = :id_user AND id_produit = :id_produit AND confirmation_panier != :num";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':id_user' => $id_user,
        ':id_produit' => $id_produit,
        ':num' => 3

    ));

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    //var_dump($resultat);
    return @$resultat;
}


// function verif_doublon_article_produit($id_produit)
// {
//     global $connection;


//     $sql =
//         "SELECT *
// FROM panier
// WHERE id_produit = :id_produit";
//     $sth = $connection->prepare($sql);
//     $sth->execute(array(
//         ':id_produit' => $id_produit

//     ));

//     $resultat = $sth->fetch(PDO::FETCH_OBJ);
//     return @$resultat->id_produit;
// }



//<!---------------------------------------------------------------->
//<!--------------------------Bouton retirer------------------------>
//<!---------------------------------------------------------------->

function retirer($id_produit)
{
    global $connection;
    $sql =
        "DELETE FROM panier
        WHERE id_produit = :id_produit";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':id_produit' => $id_produit
    ));
    header('location:../clients/panier_out.php');
}



//<!---------------------------------------------------------------->
//<!--------------------------Bouton envoyer------------------------>
//<!---------------------------------------------------------------->

function attente_de_traitement($id_user, $id_produit)

{
    // var_dump($id_produit);
    // die($id_user);


    global $connection;
    $sql = "UPDATE panier
    SET confirmation_panier = 1
    WHERE id_produit = $id_produit AND id_user = $id_user AND confirmation_panier = 0";
    $sth = $connection->prepare($sql);
    $sth->execute();
}





function recup_produit_calendrier($id_produit, $id_categorie)
{

    global $connection;
    $sql =
        "SELECT *
        FROM liaisons_produits
        INNER JOIN produits ON produits.id_produit = liaisons_produits.id_produit
        INNER JOIN categories ON categories.id_categorie = liaisons_produits.id_categorie
        WHERE  liaisons_produits.id_categorie=$id_categorie";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return @$resultat;
    //$_SESSION["id_categorie"] = $resultat->id_categorie;
}





//<!------------------------------------------------------------------------->
//<!---------fonction permet de supprimer supprimer la demande client-------->
//<!------------------------------------------------------------------------->

function paiement_paypal_success($id_user)
{

    global $connection;


    // insert
    // fonction qui génére un numéro aléatoire 
    $unic = uniqid();

    $sql_ins = "INSERT INTO  paiement(id_user,numero_facture) VALUES (:id_user,:numero_facture)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':id_user' => $id_user,
        ':numero_facture' => $unic
    ));

    $id_paiement = $connection->lastInsertId();



    $sql = "UPDATE panier
    SET confirmation_panier = 3 , id_paiement = $id_paiement
    WHERE id_user=$id_user AND confirmation_panier = 2";
    $sth = $connection->prepare($sql);
    $sth->execute();




    $sql = "SELECT * FROM panier
    INNER JOIN paiement ON paiement.id_paiement = paiement.id_paiement
    INNER JOIN users ON users.id_user = panier.id_user
    WHERE panier.id_user=$id_user AND panier.id_paiement = $id_paiement AND confirmation_panier = 3";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;

    // $_SESSION["nom_produit"] = $resultat->nom_produit;
    // $_SESSION["date_demande"] = $resultat->date_demande;

}



// <!---------------------------------------------------------------------------->
// <!---------------------header barre de recherche ----------------------------->
// <!---------------------------------------------------------------------------->


function recherche($recherche_input)
{

    global $connection;

    $sql  = "SELECT * FROM liaisons_produits
INNER JOIN
  categories ON categories.id_categorie = liaisons_produits.id_categorie
INNER JOIN
  produits ON produits.id_produit = liaisons_produits.id_produit
WHERE
   produits.produit_long LIKE '$recherche_input%' AND  produits.actif=1 OR produits.produit_court LIKE '$recherche_input%' AND  produits.actif=1 OR produits.nom_produit LIKE '$recherche_input%' AND produits.actif=1 OR categories.nom_categorie LIKE '%$recherche_input%'";

    //  var_dump($sql);



    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}



// <!---------------------------------------------------------------------------->
// <!---------------------header barre de recherche ----------------------------->
// <!---------------------------------------------------------------------------->


function liste_user()
{

    global $connection;
    $sql =
        "SELECT *
FROM users WHERE actif=1 ORDER BY nom ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($resultat);

    return @$resultat;
}



// <!---------------------------------------------------------------------------->
// <!---------------------header barre de recherche ----------------------------->
// <!---------------------------------------------------------------------------->


function recup_id_user($id_user)
{

    global $connection;
    $sql =
        "SELECT *
FROM users WHERE id_user = $id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    //var_dump($resultat);

    return @$resultat;
}




// <!---------------------------------------------------------------------------->
// <!---------------------header barre de recherche ----------------------------->
// <!---------------------------------------------------------------------------->


function recup_info_facture($id_paiement)
{

    global $connection;
    $sql =
        "SELECT *
FROM paiement 
WHERE id_paiement = $id_paiement";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    //var_dump($resultat);

    return @$resultat;
}
// <!---------------------------------------------------------------------------->
// <!---------------------header barre de recherche ----------------------------->
// <!---------------------------------------------------------------------------->


function recup_paiement($id_user)
{

    global $connection;
    $sql =
        "SELECT *
FROM paiement 
WHERE id_user = $id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($resultat);

    return $resultat;
}

// <!---------------------------------------------------------------------------->
// <!---------------------facturation edition------------------------------------>
// <!---------------------------------------------------------------------------->


function recup_paiement_edition($recup_id_user, $recup_id_paiement)
{

    global $connection;
    $sql =
        "SELECT *
FROM panier 
INNER JOIN
  produits ON produits.id_produit = panier.id_produit
WHERE id_user = $recup_id_user AND id_paiement = $recup_id_paiement";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($resultat);

    return $resultat;
}



// <!-------------------------------------------------------------------------------------->
// <!---------------------Facturation page edition recup user ----------------------------->
// <!-------------------------------------------------------------------------------------->


function recup_user_edition($recup_id_user)
{

    global $connection;
    $sql =
        "SELECT *
FROM users WHERE id_user = $recup_id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($resultat);

    return @$resultat;
}

// <!---------------------------------------------------------------------------->
// <!---------------------facturation edition------------------------------------>
// <!---------------------------------------------------------------------------->


function recup_facture_edition($recup_id_user, $recup_id_paiement)
{

    global $connection;
    $sql =
        "SELECT *
FROM paiement 
WHERE id_user = $recup_id_user AND id_paiement = $recup_id_paiement";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($resultat);

    return $resultat;
}


// <!---------------------------------------------------------------------------->
// <!------------------------------Mes commandes--------------------------------->
// <!---------------------------------------------------------------------------->

function mes_commandes($id_user)
{
    global $connection;
    $sql = "SELECT * FROM panier
    INNER JOIN produits ON produits.id_produit = panier.id_produit
    WHERE panier.id_user=$id_user ORDER BY date_demande ASC; 
    ";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}