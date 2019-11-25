<?php
$image = $_GET['fichier'];
if (file_exists('image/' . $image))
{
    unlink('image/' .$image);
}
else
{
    echo 'ERROR';
}
$dir = 'image';
$fichiers = array_slice(scandir($dir), 2);
if (!empty($fichiers)){
    header('location: list.php');
} else {
    header('location: index.php');
}