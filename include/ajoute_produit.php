<!DOCTYPE html>
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
<?php include 'Nav.php';
require_once 'database.php';
?>
<div class="container py-2">
    <h4>Ajouter produit</h4>
<?php
if (isset($_POST['ajouter'])) {
    $liballe = $_POST['libelle'];
    $prix = $_POST['prix'];
    $discount = $_POST['discount'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $date	 = date('Y-m-d');

    //echo "<pre>";
    //print_r ($_FILES);
    $filename="produit.jpg";
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $filename=uniqid().$image;
        move_uploaded_file($_FILES['image']['tmp_name'], '../upload/produit/' . $filename);

    }
    //echo "</pre>";
    //die();


    if (!empty($liballe) && !empty($prix) && !empty($categorie) && !empty($description)) {
        $sqlState = $pdo->prepare('INSERT INTO produit VALUES (null,?,?,?,?,?,?,?)');
        $sqlState->execute([$liballe, $prix, $discount, $categorie, $date,$description,$filename]);
            ?>
            <div class="alert alert-success" role="alert">
                la produit <?php  echo $liballe?> est bien ajouté
            </div>
            <?php
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
    <label class="form-label">Libelle : </label>
    <input type="text" class="form-control" name="libelle"><br>

    <label class="form-label">price : </label>
    <input type="number" class="form-control" min="0" max="500" name="prix"><br>

    <label class="form-label">Discount : </label>
    <input type="number" class="form-control" min="0" max="70" name="discount"><br>

    <label class="form-label">description : </label>
    <textarea class="form-control" name="description"></textarea>

    <label class="form-label" >image : </label>
    <input type="file" class="form-control" name="image"><br>

    <?php
    $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
    //$categories->execute();
    //var_dump($categories->fetchAll(PDO::FETCH_ASSOC));

    ?>
    <label class="form-label">Catégorie</label>
    <select name="categorie" class="form-control">
        <option value="">select une categirie</option>

        <?php
        foreach ($categories as $categorie){
            echo "<option value=".$categorie['id'].">".$categorie['liballe']."</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" value="Ajoute produit" class="btn btn-primary my-2" name="ajouter">

</form>
</div>
</body>
</html>