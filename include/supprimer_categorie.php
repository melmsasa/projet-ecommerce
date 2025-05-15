<?php
require_once "database.php";
$id=$_GET['id'];
$sqlstate=$pdo->prepare('DELETE FROM categorie WHERE id=?');
$sqlstate->execute([$id]);

header('location: list_categorie.php');
?>