<?php
include('connexion.php');

$id =  $_GET['id'];

 $sql = $connexion->prepare("SELECT * FROM `toto_user` WHERE id=$id");
 $sql->execute();

 $afficher=$sql->fetch();

    if(isset($_POST['modifier'])){
          if(!empty($_POST['nom']) && !empty($_POST['prenom']) 
           || !empty($_POST['email']) && !empty($_POST['profil']) 
           || !empty($_POST['pass']) ) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $profil = $_POST['profil'];
            $pass = $_POST['pass'];

            $update = $connexion->prepare("UPDATE toto_user SET nom='$nom',
            prenom='$prenom',email='$email',profil='$profil',pass='$pass' WHERE id=$id");
            $update->execute();
            header('location:afficher_root');
    } else{
        echo "Echec de modification !";
    }
 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>
<body>
    <h2>Modification admin</h2>

    <form action="#" method="post">
        <input type="text" name ="id" value="<?php echo $afficher['id'] ?>">
        <input type="text" name ="nom" value="<?php echo $afficher['nom'] ?>">
        <input type="text" name ="prenom" value="<?php echo $afficher['prenom'] ?>">
        <input type="text" name ="email" value="<?php echo $afficher['email'] ?>">
        <input type="text" name ="profil" value="<?php echo $afficher['profil'] ?>">
        <input type="text" name ="pass" value="<?php echo $afficher['pass'] ?>">
        <input type="submit" name="modifier" value="Modifier" >
    </form>
</body>
</html>