<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
<?php include 'Nav.php'; ?>

<?php
if(isset($_POST['connexion'])){
    $login =$_POST['login'];
    $pwd = $_POST['password'];

    if(!empty($login) && !empty($pwd)){
        require_once 'database.php';
        $sqlState = $pdo->prepare('SELECT * FROM utilisateur 
                                                WHERE login=?
                                                AND   password=?');
        $sqlState->execute([$login,$pwd]);
            if($sqlState->rowCount()>=1) {
                //session_start();
                $_SESSION['utilisateur'] = $sqlState->fetch();
                header('location: accueil.php');
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Login ou password incorrectes.
                </div>
                <?php
                }
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Login ou password incorrectes.
                </div>
                <?php
            }

//        if($sqlState-> rowCount()>= 1){
//            session_start();
            //$_SESSION['utilisateur'] = $sqlState-> fetch();
//            header('location : admin.php');
//        }
//        else{
//            echo "itulisator non valide";
//        }

}

?>

<div class="container py-2">
<h4>Connexion</h4>

<form method="post">
    <label class="form-label">Login : </label>
    <input type="text" class="form-control" name="login">

    <label class="form-label">Password : </label>
    <input type="password" class="form-control" name="password"><br>
    <input type="submit" value="Connexion" class="btn btn-primary my-2" name="connexion">
</form>
</div>
</body>
</html>