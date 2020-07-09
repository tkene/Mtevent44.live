<?php

function img_load_articles($id_article)
{

    //if(isset($_POST['upload_photos'])){
    // Include the database configuration file
    include_once '../connect/connect.php';
    global $connection;

    // File upload configuration
    $targetDir = "../uploads/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if (!empty(array_filter($_FILES['photos']['name']))) {
        foreach ($_FILES['photos']['name'] as $key => $val) {
            // File upload path
            $fileName = basename($_FILES['photos']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["photos"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql
                    $insertValuesSQL .= "('" . $fileName . "', NOW(), $id_article),";
                } else {
                    $errorUpload .= $_FILES['photos']['name'][$key] . ', ';
                }
            } else {
                $errorUploadType .= $_FILES['photos']['name'][$key] . ', ';
            }
        }


        // à faire pour le delete
        // select images where $id_product
        // si vide insert
        // si plein delete

        // Sélection de l'image pour comparaison
        $sql_img = "SELECT * FROM images_article where id_article = $id_article ";
        $sth = $connection->prepare($sql_img);
        $sth->execute();

        $resultat = $sth->fetch(PDO::FETCH_OBJ);

        if ($resultat) {
            $sql_img = "DELETE FROM images_article WHERE id_article = $id_article";
            $sth = $connection->prepare($sql_img);
            $sth->execute();
        }



        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');

            // Insert image file name into database
            $insert = $connection->query("INSERT INTO images_article (name_photo, date_creat_article, id_article) VALUES $insertValuesSQL");

            //var_dump($insertValuesSQL);



            if ($insert) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . $errorUpload : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . $errorUploadType : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Les fichiers images sont téléchargés avec succés." . $errorMsg;
                return $statusMsg;
            } else {
                $statusMsg = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                return $statusMsg;
            }
        }
    } else {
        $statusMsg = 'Veuillez sélectionner votre fichier image.';
        return $statusMsg;
    }

    // Display status message
    echo $statusMsg;
}
//}