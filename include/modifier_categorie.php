<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title>Modifier categories</title>
</head>
<body>
<?php include 'Nav.php'; ?>
<?php require_once "database.php";?>
<div class="container py-2">
    <h4>Modifier Categorie</h4>
<?php
$sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
$id=$_GET['id'];
$sqlState->execute([$id]);
$categorie =$sqlState->fetch(PDO::FETCH_ASSOC);
//var_dump($categorie);

if (isset($_POST['modifier'])) {
    $liballe = $_POST['liballe'];
    $description = $_POST['description'];
    $icone = $_POST['icone'];


    if (!empty($liballe) && !empty($description) && !empty($icone) ) {
        $sqlState = $pdo->prepare('UPDATE categorie
                                                SET liballe = ? ,
                                                    description = ? ,
                                                    icone = ?
                                            WHERE id = ?
                                            ');
        $sqlState->execute([$liballe, $description, $icone, $id]);
        header('location: list_categorie.php');
    } else {
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
    <input type="hidden" class="form-control" name="id" value=" <?php echo $categorie['id']?> " ><br>
    <input type="text" class="form-control" name="liballe" value=" <?php echo $categorie['liballe']?> " ><br>

    <label class="form-label">Description : </label>
    <textarea name="description" class="form-control"><?php echo $categorie['description']?></textarea><br>

    <label class="form-label">Icône : </label>
    <input type="text" class="form-control" name="icone" value="<?php echo $categorie['icone']?>">
    <input type="submit" value="modifier categorie" class="btn btn-primary my-2" name="modifier">
</form>
</div>

</body>
</html>