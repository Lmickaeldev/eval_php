<?php
if (isset($_POST['title']) && $_POST['title'] != "") {
    $title = $_POST['title'];
}
else {
    $title = null;
}
if (isset($_POST['selectArtist']) && $_POST['selectArtist'] != "") {
    $selectArtist = $_POST['selectArtist'];
}
else {
    $selectArtist = null;
}
if (isset($_POST['dyear']) && $_POST['dyear'] != "") {
    $dyear = $_POST['dyear'];
}
else {
    $dyear = null;
}
if (isset($_POST['genre']) && $_POST['genre'] != "") {
    $genre = $_POST['genre'];
}
else {
    $genre = null;
}
if (isset($_POST['label']) && $_POST['label'] != "") {
    $label = $_POST['label']; 
}
else {
    $label = null;
}
if (isset($_POST['price']) && $_POST['price'] != "") {
    $price = $_POST['price']; 
}
else {
    $price = null;
}
if (isset($_FILES['picture'])) {
    $picture = $_FILES['picture']['name']; 
}
else {
    $picture = null;
}

// On met les types autorisés dans un tableau (ici pour une image)
$aMimeTypes = array("image/gif", "image/jpg","image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");
// On extrait le type du fichier via l'extension FILE_INFO 
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimetype = finfo_file($finfo, $_FILES["picture"]["tmp_name"]);

finfo_close($finfo);
var_dump($mimetype);

if (in_array($mimetype, $aMimeTypes))
{
    
    move_uploaded_file($_FILES["picture"]["tmp_name"], "./assets/images/".$_FILES["picture"]["name"]);

} 
else 
{
   // Le type n'est pas autorisé, donc ERREUR

   echo "Type de fichier non autorisé";    
   exit;
}  
if ($title == Null || $selectArtist == Null || $dyear == Null || $genre == Null || $label == Null || $price == Null || $picture == Null) {
    header("Location: disc_new.php");
    
    exit;
}
     

require "db.php";
$db = connexionBase();
try {    
    $requete = $db->prepare("INSERT INTO disc (disc_title, artist_id, disc_year, disc_genre, disc_label, disc_price, disc_picture) VALUES (:title, :artist, :dyear, :genre, :label, :price, :picture)");

    $requete->bindValue(":title", $title, PDO::PARAM_STR);
    $requete->bindValue(":artist", $selectArtist, PDO::PARAM_INT);
    $requete->bindValue(":dyear", $dyear, PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":price", $price, PDO::PARAM_INT);
    $requete->bindValue(":picture", $picture, PDO::PARAM_STR);

    $requete->execute();

    $requete->closeCursor();

    var_dump($requete);


}
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_new.php)");
}


header("Location: index.php");

exit;

?>