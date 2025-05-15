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
    <h4>List de Produit</h4>
<br><a href="ajoute_produit.php" class="btn btn-primary">Ajouter produit</a>
<form method="post">
    <table class="table table-hover">
        <tr>
            <th>id</th>
            <th>labelle</th>
            <th>prix</th>
            <th>discount</th>
            <th>categorie</th>
            <th>date</th>
        </tr>
        <?php
        require_once 'database.php';
        $produits= $pdo->query("SELECT produit.*,categorie.liballe as 'categorie_libelle' FROM produit INNER JOIN categorie ON produit.id_categorie = categorie.id")->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($produits);
        foreach ($produits as $produit){
            //$prix=$produit['prix'];
            //$disc=$produit['discount'];
            //$prixf=($prix * $disc)/100;
            //$prix-=$prixf;
            ?>
            <tr>
                <td><?php echo $produit['id']?></td>
                <td><?php echo $produit['liballe']?></td>
                <td><?php echo $produit['prix'] ?> MAD</td>
                <td><?php echo $produit['discount']?> %</td>
                <td><?php echo $produit['categorie_libelle']?></td>
                <td><?php echo $produit['date_creation']?></td>

                <td>
                    <a href="modifier_produit.php?id=<?php echo $produit['id'] ?>" class="btn btn-primary">Modifier</a>
                    <a href="supprimer_produit.php?id=<?php echo $produit['id'] ?>" onclick="return confirm('Voulez vous vraiment supprimer la produit <?php echo $produit['liballe'] ?>');" class="btn btn-danger">Supprimer</a>

                </td>
            </tr>
            <?php
        }
        ?>
    </table>

</form>

</body>
</html>