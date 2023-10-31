<?php
include('connexion.php');

$id =  $_GET['id'];

    $delete = $connexion->prepare("DELETE FROM `toto_user` WHERE id=$id");
    $delete->execute();
    header('location:afficher_root.php');

?>