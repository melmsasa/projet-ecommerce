<!DOCTYPE html>
<?php include 'front_nav.php' ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title></title>
</head>
<body>
<div class="container py-2">

    <div class="container-fluid">
      <h4><i class="fa-solid fa-list-ul"></i> List Categorie </h4>
        <?php

        require_once '../include/database.php';
        $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);
        ?>
        <ul class="list-group">
            <?php
            foreach ($categories as $categorie){
                ?>
                <li class="list-group-item">
                    <a class="btn btn-default w-100"
                       href="categorie.php?id=<?php echo $categorie->id ?>">
                        <i class="<?php echo $categorie->icone ?>"></i> <?php echo $categorie-> liballe ?>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

</div>

</body>
</html>