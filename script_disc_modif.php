<?php

// Récup des valeurs
$id = (isset($_POST['id']) && $_POST['id'] !== "") ? $_POST['id'] : null;
$title = (isset($_POST['title']) && $_POST['title'] !== "") ? $_POST['title'] : null;
$artist = (isset($_POST['artist']) && $_POST['artist'] !== "") ? $_POST['artist'] : null;
$year = (isset($_POST['dyear']) && $_POST['dyear'] !== "") ? $_POST['dyear'] : null;
$genre = (isset($_POST['genre']) && $_POST['genre'] !== "") ? $_POST['genre'] : null;
$label = (isset($_POST['label']) && $_POST['label'] !== "") ? $_POST['label'] : null;
$price = (isset($_POST['price']) && $_POST['price'] !== "") ? $_POST['price'] : null;

// image
if(isset($_FILES['picture'])){
    $tmpName = $_FILES['picture']['tmp_name'];
    $name = $_FILES['picture']['name'];
    $size = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];

    // vérification de l'extension
    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));
    $extensions = ["gif", "jpg", "jpeg", "pjpeg", "png", "x-png", "tiff"];

    //Taille max que l'on accepte
    $maxSize = 600000;

    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
        // Si tout est ok, on enregistre l'image
        move_uploaded_file($tmpName, "./assets/images.".$name);
    } else {
        // Sinon, on affiche un message d'erreur et on arrête le script
        echo "Mauvaise extension ou taille trop grande";
        exit;
    }
}
// Insertion en BDD
require "db.php";
$db = connexionBase();


// Si erreur envoie vers form de modif.php 
if ($id == Null) {
    header("Location: disc.php");
}
elseif ($title == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $name == Null ) {
    //header("Location: disc_modif.php?id=".$id);
    exit;
}

try {
    $requete = $db->prepare("UPDATE disc SET disc_title = :title, disc_year = :dyear, disc_genre = :genre, disc_label = :label, disc_price = :price, disc_picture = :picture WHERE disc_id = :id");
    $requete->bindValue(":id", $id, PDO::PARAM_INT);
    $requete->bindValue(":title", $title, PDO::PARAM_STR);
    $requete->bindValue(":dyear", $year, PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":price", $price, PDO::PARAM_STR);
    $requete->bindValue(":picture", $name, PDO::PARAM_STR);


    $requete->execute();
    $requete->closeCursor();
} 
catch (Exception $e) {
    echo "Erreur :" . $e . "<br>";
   //("Fin du script)
}


//  valider -> disc_detail.php 
header("Location: disc_detail.php?id=".$id);
exit;