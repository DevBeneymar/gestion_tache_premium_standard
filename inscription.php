<?php
    session_start();
    include('connexion.php');
    
    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['userkonekte'])) {
        // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
        header('Location: profil.php'); 
        exit(); 
    }
        $errors=[];
        if(isset($_POST['inscription']) ){
            $aucun_champs_vide = (!empty($_POST['nom']) & && !empty($_POST['prenom']) || !empty($_POST['email']) && !empty($_POST['profil']) || !empty($_POST['pass']) || !empty($_POST['cpass']));
            if($aucun_champs_vide) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $profil = $_POST['profil'];
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];
            if($cpass===$pass){
                // Hacher le mot de passe
                 $pass_hacher = password_hash($pass, PASSWORD_DEFAULT);

                try{
                    $requete = $connexion->prepare("INSERT INTO toto_user( nom, prenom, email, profil, pass) VALUES(:v1,:v2,:v3,:v4,:v5)");

                    // Liage des valeurs aux paramètres
                    $requete->bindParam(':v1', $nom);
                    $requete->bindParam(':v2', $prenom);
                    $requete->bindParam(':v3', $email);
                    $requete->bindParam(':v4', $profil);
                    $requete->bindParam(':v5', $pass_hacher);

                    //On execute la requete
                    $requete->execute();
                    header('location:sucinscription.php');
                }
                catch (PDOException $e){
                    echo "Erreur d'insertion : " . $e->getMessage();
                } 
            }
            else{
                $errors[]="Les deux champs password doivent etre ==";                
            }
           }
           else {
                $errors[]="Tous les champs sont obligatoires!";
            } 
        } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
    </style>
</head>
<body>
    <center>
    <h2>Bienvenu sur notre plateforme</h2> <br>     
    <h3>Incris-toi ici 👇 </h3> <br> <br>
    <form action="#" method="POST">
        <table>
            <tr>
                <td><label for="nom">Nom</label></td>
                <td><input type="text" id="nom" name="nom" placeholder="Nom" required></td>
            </tr>
            <tr>
                <td><label for="prenom">Prenom</label></td>
                <td><input type="text" id="prenom" name="prenom" placeholder="Prenom" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" autocomplete="new-email" name="email" placeholder="Email" required></td>
            </tr>
            <tr>
                <td><label for="tprofil">Type Profil</label></td>
                <td>
                <select name="profil" id="tprofil" required>
                    <option value="">Select Type Profil</option>
                    <option value="Standard">Standard</option>
                    <option value="Premium">Premium</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="pass">Password</label></td>
                <td><input type="password" autocomplete="new-password" id="pass" name="pass" placeholder="Password" required></td>
            </tr>
            <tr>
                <td><label for="cpass">Confirmer Password</label></td>
                <td><input type="password" autocomplete="new-password" id="cpass" name="cpass" placeholder="Password" required></td>
            </tr>
            <tr>
                <td colspan="2" class="submitBtn"><input type="submit" name="inscription" value="Ajouter" width="100"></td>
            </tr>
        </table>
        <br>
        
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
    <p>👉 <a href="login.php">Je me connecte!</a></p>
    </center>

</body>
</html>