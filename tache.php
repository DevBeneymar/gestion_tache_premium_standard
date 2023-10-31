<?php
session_start();
include('connexion.php');

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['userkonekte'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}
        $errors=[];
        $success='';
        if(isset($_POST['ajouter'])){
            if(!empty($_POST['description']) && !empty($_POST['db']) && !empty($_POST['df'])){

                $type = $_POST['type'];
                $description = $_POST['description'];
                $db = $_POST['db'];
                $df = $_POST['df'];
                $type_compte = $_SESSION['userkonekte']['profil'];
                //Get Count Tache for user
                    // Préparez et exécutez la requête SELECT
                    $requete = $connexion->prepare("SELECT * FROM tache WHERE user_id = :id");
                    $requete->bindParam(':id', $_SESSION['userkonekte']['id']);
                    $requete->execute();
                    // Obtenez le nombre de tâches
                    $nombreDeTaches = $requete->rowCount();
                    //Au plus 3 tache pour le compte Standard
                $laisserPasserInsertion = ($_SESSION['userkonekte']['profil']==="Premium" || $nombreDeTaches<=2);
                if($laisserPasserInsertion){
                    try{
                        $requete = $connexion->prepare("INSERT INTO tache(type,description,db,df,user_id) VALUES(:v1,:v2,:v3,:v4,:v5)");
    
                        // Liage des valeurs aux paramètres
                        $requete->bindParam(':v1', $type);
                        $requete->bindParam(':v2', $description);
                        $requete->bindParam(':v3', $db);
                        $requete->bindParam(':v4', $df);
                        $requete->bindParam(':v5', $_SESSION['userkonekte']['id']);
    
                        //On execute la requete
                        $requete->execute();
                        $success = "Tâche ajoutée avec Successss!";
                    }
                    catch (PDOException $e){
                        echo "Erreur d'insertion : " . $e->getMessage();
                    }
                }else{
                    $errors[]="Le nombre de tâche que tu peux enregistrer est limité à trois(3)";
                }
                                
            }
            else{
                echo  "Tous les champs sont obligatoires !";
            }
         
        } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Tache</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        select{
            width: 50%;
        }
        .submitBtn{
            text-align: center !important;
        }
        input[type="submit"]{
            width: 50%;
            font-size: 20px;
            color: white;
            background-color: skyblue;
            border-radius: 3px;
        }
        .errors{
            color: red;
        }
        .vert{
            color: green;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <center>
        <h2>Ajoutez t&acirc;che 👇</h2>
        <br>
        <?php 
        if(!empty($success)){
            echo '<p class="vert">'.$success.'</p>';
        }
        ?>
        <form action="#" method="POST">
            <table>
            <tr>
                    <td><label for="tprofil">Type Tache</label></td>
                    <td>
                    <select name="type" id="type" required>
                        <option value="">Select Type Tache</option>
                        <option value="Professionel">Professionel</option>
                        <option value="Domestique">Domestique </option>
                        <option value="Loisir"> Loisir</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Description</label></td>
                    <td><textarea name="description" id="" cols="30" rows="5" placeholder="Description de la tache"></textarea></td>
                </tr>            
                <tr>
                    <td><label for="db">Date Debut</label></td>
                    <td><input autocomplete="new-date" type="date" id="db" name="db" placeholder="date debut" required></td>
                </tr>
                <tr>
                    <td><label for="df">Date Fin</label></td>
                    <td><input type="date" autocomplete="new-df" id="df" name="df" placeholder="date  fin" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="submitBtn"><input type="submit" name="ajouter" value="Ajouter Tache" width="100"></td>
                </tr>
            </table>
        </form>
        <div class="errors">
        <?php
            if(!empty($errors)){
                foreach($errors as $error){
                    echo '<p>'.$error.'</p>';
                }
            }
        ?>
    </div>
    <br>
    <p>👉 <a href="profil.php">Mon Profil</a></p>
    </center>
</body>
<script>
    let vert = document.querySelector('.vert').innerHTML;
    if(vert!==''){
        setTimeout(deleteMessage,1000);
        function deleteMessage(){
            document.querySelector('.vert').style.display='none';
        }
    }
    console.log(vert);
</script>
</html>