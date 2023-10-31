<?php 
        include('connexion.php');

        $id = $_GET['id'];

        $recuperation = $connexion->prepare("SELECT * FROM `tache` WHERE  id=$id");
        $recuperation->execute();
        $afficher=$recuperation->fetch();

        if(isset($_POST['modifier'])){
            if(!empty($_POST['description']) && !empty($_POST['db']) && !empty($_POST['df']) ){
                
                $type = $_POST['type'];
                $description = $_POST['description'];
                $db = $_POST['db'];
                $df = $_POST['df'];

                $update= $connexion->prepare("UPDATE tache SET type='$type',
                description='$description',db='$db',df='$df' WHERE id=$id");
                $update->execute();
                header('location:afficher_premium.php');

            } else{
                echo "Echec de mise à jour!";
            }
        
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
</head>
<body>
    <h2>Veuillez effectuer une modification . </h2> <br> <br>
    <form action="" method="post">
        <input type="text"  name="id" value ="<?php echo $afficher['id']; ?>" >
        <input type="text" name="type"  value ="<?php echo $afficher['type'];?>" >
        <input type="text" name="description" value ="<?php echo$afficher['description']; ?>" >
        <input type="text" name="db" value ="<?php echo $afficher['db']; ?>" >
        <input type="text" name="df" value ="<?php echo  $afficher['df']; ?> ">
        <input type="submit" name="modifier" value="Modifier">
    </form>

</body>
</html>