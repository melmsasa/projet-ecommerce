<?php
require_once '../include/database.php';
include 'front_nav.php';
$id=$_GET['id'];
//var_dump($id);die();

$sqlstate= $pdo->prepare('SELECT * FROM produit WHERE id=?');
$sqlstate->execute([$id]);
$produit=$sqlstate->fetch(PDO::FETCH_ASSOC);
//var_dump($produits);die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title> Produit | <?php echo $produit['liballe'] ?></title>
</head>
<body>
<div class="container py-2">
    <div class="container-fluid">
        <h4><?php echo $produit['liballe'] ?></h4>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img img-fluid w-75" src="../upload/produit/<?php echo $produit['image']?>" alt="<?php echo $produit['liballe'] ?>">
                </div>
                <div class="col-md-6">
                    <?php
                    $discount = $produit['discount'];
                    $prix = $produit['prix'];
                    ?>
                    <div class="d-flex align-items-center">
                        <h1 class="w-100"><?php echo $produit['liballe'] ?></h1>
                        <?php if (!empty($discount)) {
                            ?>
                            <span class="badge text-bg-success">- <?php echo $discount ?> %</span>
                            <?php
                        } ?>
                    </div>
                    <hr>

                    <p class="text-justify">
                        <?php echo $produit['description'] ?>
                    </p>

                    <hr>
                    <div class="d-flex">
                        <?php
                        if (!empty($discount)) {
                            $total = $prix - (($prix * $discount) / 100);
                            ?>
                            <h5 class="mx-1">
                                <span class="badge text-bg-danger"><strike> <?php echo $prix ?> <i class="fa fa-solid fa-dollar"></i> </strike></span>
                            </h5>
                            <h5 class="mx-1">
                                <span class="badge text-bg-success"><?php echo $total ?> <i class="fa fa-solid fa-dollar"></i></span>
                            </h5>

                            <?php
                        } else {
                            $total = $prix;
                            ?>
                            <h5>
                                <span class="badge text-bg-success"><?php echo $total ?> <i class="fa fa-solid fa-dollar"></i></span>
                            </h5>

                            <?php
                        }
                        ?>
                </div>
                    <form method="post" class="counter d-flex" action="ajouter_panier.php">
                    <hr>
                    <div class="d-flex align-items-center">
                        <?php include 'counter.php'; ?>
                    </div>
                    <hr>

                        <input type="hidden" name="id" value="<?php echo $produit['id'] ?>">
                        <button type="submit"  name="ajoute" class="btn btn-success"> Ajoute au panier </button>
                    </form>
                </div>

        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="counter.js"></script>
</body>
</html>