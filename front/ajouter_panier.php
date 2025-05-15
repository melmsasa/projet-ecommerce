<?php
session_start();
//var_dump($_POST);
$id=$_POST['id'];
$qty=$_POST['qty'];

if(!empty($id) && !empty($qty)){

    //var_dump($_SESSION['utilisateur']);
}else {
    header("location:produit.php?id=$id");
}

