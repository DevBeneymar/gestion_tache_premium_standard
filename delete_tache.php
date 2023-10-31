<?php
        include('connexion.php');
        $id = $_GET['id'];

        $delete = $connexion->prepare("DELETE FROM `tache` WHERE id=$id");
        $delete->execute();

        header('location:afficher_premium.php');

?>