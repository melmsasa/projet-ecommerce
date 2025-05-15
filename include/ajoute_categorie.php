<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title>Ajoute Categorie</title>
</head>
<body>
<?php include 'Nav.php'; ?>
<div class="container py-2">
    <h4>Ajouter catégorie</h4>
<?php
if(isset($_POST['ajoute'])){
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $icone = $_POST['icone'];


    if(!empty($libelle) && !empty($description)){
        require_once 'database.php';
        $sqlState = $pdo->prepare('INSERT INTO categorie(liballe,description,icone) VALUES(?,?,?)');
        $sqlState->execute([$libelle,$description,$icone]);
        //header('location: categories.php');
        ?>
        <div class="alert alert-success" role="alert">
            la catégorie <?php  echo $libelle?> est bien ajouté
        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-danger" role="alert">
            Libelle , description sont obligatoires
        </div>
        <?php
    }
}
?>

<form method="post">
    <label class="form-label">Libelle : </label>
    <input type="text" class="form-control" name="libelle"><br>

    <label class="form-label">Description : </label>
    <textarea class="form-control" name="description"></textarea>

    <label class="form-label">Icône</label>
    <input type="text" class="form-control" name="icone">

    <input type="submit" value="Ajoute categorie" class="btn btn-primary my-2" name="ajoute">
</form>
</div>
</body>
</html>