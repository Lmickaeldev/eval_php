<?php
require "db.php";
$db = connexionBase();
$requete = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id=?");
$requete ->execute(array($_GET["id"]));
$detdisc = $requete ->fetch(PDO::FETCH_OBJ);
$requete->closeCursor();
// var_dump($detdisc);
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
    <title>modifier un disque</title>
</head>
<body>
    <div class="container site">
    <h1 class="logo">velvet record</h1>   
        <div class="row">
            <h1 class="col-10">Disque n°<?=$detdisc->disc_id?></h1>
            <a href="disc_detail.php?id=<?=$detdisc->disc_id?>" class="btn btn-primary col-2">Retour</a>
        </div>

        
        <form action="script_disc_modif.php" method="post" enctype="multipart/form-data">            
            <div class="row">
            <div class="col-md-6">
            <label for="title">Titre :</label><br>
            <input type="text" name="id" value="<?=$detdisc->disc_id?>" hidden>
            <input type="text" placeholder="Entrez un titre" class="col-12" name="title" value="<?= $detdisc->disc_title?>">
            <label for="artist" class="mt-1">Artiste :</label><br>
            <input type="text" placeholder="Entrez un artiste" class="col-12" name="artist" value="<?= $detdisc->artist_name?>">
            <label for="year" class="mt-1">Année :</label><br>
            <input type="text" placeholder="Entrez une année" class="col-12" name="dyear" value="<?= $detdisc->disc_year?>">
            <label for="genre" class="mt-1">Genre :</label><br>
            <input type="text" placeholder="Entrez un genre" class="col-12" name="genre" value="<?= $detdisc->disc_genre?>">
            <label for="label" class="mt-1">Label :</label><br>
            <input type="text" placeholder="Entrez un label" class="col-12" name="label" value="<?= $detdisc->disc_label?>">
            <label for="price" class="mt-1">Prix :</label><br>
            <input type="text" class="col-12" name="price" value="<?= $detdisc->disc_price?>">
            <label for="price" class="mt-1">image :</label><br>
            <input type="file" name="picture"><br>
            </div>
            <div class="col-md-6">
            <?php 
                $req = $db->query('SELECT disc_picture FROM disc');
                    echo "<img class='image_M' src='/assets/images/".$detdisc->disc_picture."'>";
            ?>
            <br><br>
            <input class="btn btn-warning" type="submit" value="Modifier">
            <input class="btn btn-danger" type="reset" value="Annuler">
            </div>
        </div>
        </form>  
        
    </div>
</body>
</html>