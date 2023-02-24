<?php
include "db.php";
$db = connexionBase();
$requete = $db->query("SELECT * FROM `disc` JOIN `artist` ON disc.artist_id = artist.artist_id;");
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
    <title>liste des disque</title>
</head>
<body>

    <div class="container">
        <h1 class="logo">velvet record</h1>     
        <h2 class="complement">Liste des disques </h2>  
        <a href="disc_new.php" class="btn btn-primary">Ajouter</a>
        <div class="row ">
        
            
                
                <?php foreach ($tableau as $disc):?>
                    <div class="img-thumbnail col-md-6 ">
                <table> 
                    
                    <tbody>
                    <tr>
                    <td><img src="assets/images/<?=$disc->disc_picture?>" style="width:350px;height:400px;"></td>
                    <td class="descritpion">
                    <span class="disc">disque : N°<?=$disc->disc_id?></span><br>
                    <span class="titre"><?=$disc->disc_title?></span><br>
                    <span class="artiste"><?=$disc->artist_name?></span><br>              
                    <span class="label">Label : </span> <?=$disc->disc_label?><br>              
                    <span class="année">Year : </span> <?=$disc->disc_year?><br>               
                    <span class="genre">Genre :</span> <?=$disc->disc_genre?><br>
                    <span class="prix">prix :</span><?= $disc->disc_price?> €<br>
                    <a class="btn btn-primary text-center" role="button"href="disc_detail.php?id=<?= $disc->disc_id?>">Détails</a>
                    </tbody> 
                    </tr>
                    </td>
                </table>  
                </div> 
                <?php endforeach; ?> 
                    
            
        

        </div>    
    </div>


</body>
</html>