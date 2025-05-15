<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title>list categories</title>
</head>
<body>
<?php include 'Nav.php';
require_once 'database.php';
?>
<div class="container py-2">
    <h4>List de Categorie</h4>
<br><a href="ajoute_categorie.php" class="btn btn-primary">Ajouter catégorie</a>
<form method="post">
    <table class="table table-hover">
        <tr>
            <th>id</th>
            <th>labelle</th>
            <th>description</th>
            <th>date</th>
            <th>Icone</th>
        </tr>
        <?php
        $categories= $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $categorie){
        ?>
        <tr>
            <td><?php echo $categorie['id']?></td>
            <td><?php echo $categorie['liballe']?></td>
            <td><?php echo $categorie['description']?></td>
            <td><?php echo $categorie['date_creation']?></td>
            <td><i class="<?php echo $categorie['icone'] ?>"></i></td>
            <td>
                <a href="modifier_categorie.php?id=<?php echo $categorie['id'] ?>" class="btn btn-primary">Modifier</a>
                <a href="supprimer_categorie.php?id=<?php echo $categorie['id'] ?>" onclick="return confirm('Voulez vous vraiment supprimer la catégorie <?php echo $categorie['liballe'] ?>');" class="btn btn-danger">Supprimer</a>

            </td>
        </tr>
        <?php
        }
        ?>
    </table>

</form>
</div>
</body>
</html>