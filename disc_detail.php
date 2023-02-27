<?php
require "db.php";
$db = connexionBase();
$id = $_GET["id"];
$requete = $db->prepare("SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE disc_id=?");
$requete->execute(array($id));
$detdisc = $requete->fetch(PDO::FETCH_OBJ);

$requete->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" type="image/png" href="./assets/images/icons8-90s-music-50.png" />
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <title>dtails du disque</title>
</head>
<body>
  <div class="container site">
  <h1 class="logo">velvet Record</h1>
        <div class="row">
          <h2 class=col-md-10>Détail des disques</h2>
          <a href="index.php" class="btn btn-primary col-md-2">Retour</a>
        </div>
        <div class="row">
              <div class="col-md-6">
                <img src="assets/images/<?=$detdisc->disc_picture?>" class="w-250">
              </div>
              <div class="description col-md-6">
                <p><span class="titre"><?=$detdisc->disc_title?></span></p><br>
                <p><span class="artiste"><?=$detdisc->artist_name?></span></p><br>
                <p><span >Label : </span><?=$detdisc->disc_label?></p>
                <p><span >Year : </span><?=$detdisc->disc_year?></p> 
                <p><span >Genre :</span><?=$detdisc->disc_genre?></p>
                <p><span >Prix :</span><?=$detdisc->disc_price?>€</p> 
                <a href="disc_modif.php?id=<?= $detdisc->disc_id ?>" class="btn btn-warning m-1">Modifier</a>
                <a href="script_disc_delete.php?id=<?= $detdisc->disc_id?>" class="btn btn-danger m-1" onClick="return confirm('supprimer le disque ?')">Supprimer</a>
              </div> 
        </div>
        
  </div>
       
           
</body>
</html>