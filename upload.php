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
        if ($_FILES['fichier']['size'][$i] > 1048576)
        {
            $error = "Max size file is 1MO ";
        }
        if (!in_array($fichier_ext,$allowed))
        {
            $error = "File must be (jpg) (png) or (gif)";
        }
        if(!isset($error)){
            // on génère un nom de fichier à partir du nom de fichier sur le poste du client (mais vous pouvez générer ce nom autrement si vous le souhaitez)
            $uploadFile = $uploadDir . basename($_FILES['fichier']['name'][$i]);
            move_uploaded_file($_FILES['fichier']['tmp_name'][$i], $uploadFile);
            header('location: list.php');
        }else {
            echo "Echec de l'upload .$error";
        }

    }

    // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ca y est, le fichier est uploadé


}

