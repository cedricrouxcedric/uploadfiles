<?php

if (isset($_FILES)) {
    $files = $_FILES['fichier'];
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
    $uploadDir = 'image/image';
    $allowed = ['jpg', 'png', 'gif'];

    // creation des verifications pour chaque fichier
    $nbrOfFiles = sizeof($_FILES['fichier']['name']);
    for ($i = 0; $i < $nbrOfFiles; $i++) {
        $fichier_tmp = $files['tmp_name'][$i];
        $fichier_size = $files['size'][$i];
        $fichier_error = $files['error'][$i];
        $fichier_ext = pathinfo($_FILES['fichier']['name'][$i], PATHINFO_EXTENSION);
        // creation des verifications pour chaque fichier
        if ($_FILES['fichier']['size'][$i] > 1048576) {
            $error = "Max size file is 1MO ";
        }
        if (!in_array($fichier_ext, $allowed)) {
            $error = "File must be (jpg) (png) or (gif)";
        }
        if (!isset($error)) {
            $fichierNewName = uniqid() . '.' . $fichier_ext;
            $fichierDirection = $uploadDir . $fichierNewName;
            if (move_uploaded_file($fichier_tmp, $fichierDirection)) {
                header('location: list.php');
            } else {
                echo "Echec de l'upload .$error";
            }
        } else {
            echo $error;
        }
    }
    // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ca y est, le fichier est uploadé


}

