<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet"> 
    <title>Ajouté produits</title>
</head>
<body>
<?php
require_once 'database.php';
include 'nav.php' ?>
<div class="container py-2">
    <h4>Modifier produit</h4>
    <?php
    $id = $_GET['id'];
    require_once 'database.php';
    $sqlState = $pdo->prepare('SELECT * from produit WHERE id=?');
    $sqlState->execute([$id]);
    $produit = $sqlState->fetch(PDO::FETCH_OBJ);;
    if (isset($_POST['modifier'])) {
        $liballe = $_POST['liballe'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $categorie = $_POST['categorie'];
        $description = $_POST['description'];

        $filename = '';
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $filename = uniqid() . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], '../upload/produit/' . $filename);
        }


        if (!empty($liballe) && !empty($prix) && !empty($categorie)) {

            if (!empty($filename)) {
                $query = "UPDATE produit SET liballe=? ,
                                                    prix=? ,
                                                    discount=? ,
                                                    id_categorie=?,
                                                    description=?,
                                                    image=?
                                                WHERE id = ? ";
                $sqlState = $pdo->prepare($query);
                $updated = $sqlState->execute([$liballe, $prix, $discount, $categorie, $description, $filename, $id]);
            } else {
                $query = "UPDATE produit 
                                                SET liballe=? ,
                                                    prix=? ,
                                                    discount=? ,
                                                    id_categorie=?,
                                                    description=?
                                                WHERE id = ? ";
                $sqlState = $pdo->prepare($query);
                $updated = $sqlState->execute([$liballe, $prix, $discount, $categorie, $description, $id]);
            }
            if ($updated) {
                header('location: produits.php');
            } else {

                ?>
                <div class="alert alert-danger" role="alert">
                    Database error (40023).
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Libelle , prix , catégorie sont obligatoires.
            </div>
            <?php
        }

    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $produit->id ?>">
        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="liballe" value="<?= $produit->liballe ?>">

        <label class="form-label">Prix</label>
        <input type="number" class="form-control" step="0.1" name="prix" min="0" value="<?= $produit->prix ?>">

        <label class="form-label">Discount</label>
        <input type="range" value="0" class="form-control" name="discount" min="0" max="90"
               value="<?= $produit->discount ?>">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"><?= $produit->description ?></textarea>

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image">
        <img width="250" class="img img-fluid" src="../upload/produit/<?= $produit->image ?>"><br>
        <?php

        ?>

        <?php
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="form-label">Catégorie</label>
        <select name="categorie" class="form-control">
            <option value="">Choisissez une catégorie</option>
            <?php
            foreach ($categories as $categorie) {
                $selected = $produit->id_categorie == $categorie['id'] ? ' selected ' : '';
                echo "<option $selected value='" . $categorie['id'] . "'>" . $categorie['liballe'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Modifier produit" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>