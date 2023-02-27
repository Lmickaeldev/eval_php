 <?php
 //connect bdd + requete
include "db.php";
$db = connexionBase();
$requete = $db->query("SELECT * FROM `disc`  JOIN `artist`  ON disc.artist_id = artist.artist_id; ");
$tableau = $requete->fetchAll(PDO::FETCH_OBJ);
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
    <title>ajouter un disque</title>
</head>
<body>
    <div class="container site">
    <h1 class="logo">velvet Record</h1>
        <div class="row">
            <h1 class="col-md-10">Ajouter un disque</h1>
            <a href="index.php" class="btn btn-primary col-md-2">Retour</a>
        </div>
        <!-- form d'ajout  -->
        <form action="script_disc_new.php" method="post" enctype="multipart/form-data">    
            <label for="title">Titre :</label><br>
            <input type="text" placeholder="Entrez un titre" class="col-12" name="title">
            <label for="artist" class="mt-1">Artiste :</label><br>
            <select name="selectArtist" id="selectArtist" class="col-12">
                <option disabled selected>Selectionnez un artiste</option>
                <?php foreach ($tableau as $disc):?>
                    <option value="<?=$disc->artist_id?>"><?=$disc->artist_name?></option>
                <?php endforeach; ?>
            </select>
            <label for="year" class="mt-1">Année :</label><br>
            <input type="text" placeholder="Entrez une année" class="col-12" name="dyear">
            <label for="genre" class="mt-1">Genre :</label><br>
            <input type="text" placeholder="Entrez un genre" class="col-12" name="genre">
            <label for="label" class="mt-1">Label :</label><br>
            <input type="text" placeholder="Entrez un label" class="col-12" name="label">
            <label for="price" class="mt-1">Price :</label><br>
            <input type="text" class="col-12" name="price">
            <label for="price" class="mt-1">Picture :</label><br>
            <input type="file" name="picture">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Ajouter">
        </form>
        
    </div>
</body>
</html>