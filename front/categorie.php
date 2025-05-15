<?php
require_once '../include/database.php';
include 'front_nav.php';
$id=$_GET['id'];
$sqlstate= $pdo->prepare('SELECT * FROM categorie WHERE id=?');
$sqlstate->execute([$id]);
$categorie=$sqlstate->fetch(PDO::FETCH_ASSOC);

$sqlstate= $pdo->prepare('SELECT * FROM produit WHERE id_categorie=?');
$sqlstate->execute([$id]);
$produits=$sqlstate->fetchAll(PDO::FETCH_ASSOC);
//var_dump($produit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
<div class="container py-2">
    <div class="container-fluid">
        <h4><?php echo /*$categorie['icone'].*/$categorie['liballe'] ?> <span class="fa <?php echo $categorie['icone'] ?>"></span></h4>
        <div class="container">
            <div class="row">
                <?php
                foreach ($produits as $produit) {
                    $idproduit=$produit['id'];
                ?>
                    <div class="card mb-3 col-md-4"">
                        <img src="../upload/produit/<?php echo $produit['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                            <a href="produit.php?id=<?php echo $idproduit?>" class="btn stretched-link" >Affichier Detaill</a>
                            <h5 class="card-title"> <?php echo $produit['liballe'] ?></h5>
                            <p class="card-text"><?php echo $produit['prix'] ?> MAD</p>
                            <p class="card-text">Ajouté le : <?php echo date_format(date_create($produit['date_creation']),'y/m/j') ?></p>
                    </div>
                     <div class="card-footer" style="z-index: 10">
                         <?php include 'counter.php'; ?>

                    </div>
                    </div>
            <?php
            }
                if(empty($produits)){
                    ?>
            <div class="alert alert-info" >
                Pas de produits pour l'instant

            </div>
            <?php
                }
            ?>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="counter.js"></script>
</body>
</html>