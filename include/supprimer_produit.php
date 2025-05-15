<?php
require_once "database.php";
$id = $_GET['id'];
$sqlstate = $pdo->prepare('DELETE FROM produit WHERE id=?');
$sqlstate->execute([$id]);

//header('location : list_produit.php');
header('location: list_produit.php');
?>

