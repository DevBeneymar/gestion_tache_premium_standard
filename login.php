   <?php 
session_start();
include('connexion.php');

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['userkonekte'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: profil.php'); 
    exit(); 
}
        
        if(isset($_POST['connexion'])) {
            //!verifie si tous les champs ne sont pas vide : 
            $aucun_champ_vide = (!empty($_POST['email']) && !empty($_POST['pass']));
            //? SI au moins un champs est vide, ca renvoie false, sinon ca renvoie true
            $errors=[];
            if($aucun_champ_vide) {
                $email = $_POST['email'];
                $password = $_POST['pass'];

                // Préparez et exécutez la requête SELECT
                $requete = $connexion->prepare("SELECT * FROM toto_user WHERE email = :email");
                $requete->bindParam(':email', $email);
                $requete->execute();

                //On prend les donnees selectionnees
                $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
                
                //! Si un utilisateur avec cet email a été trouvé
                if($utilisateur){
                    //! on vérifie le mot de passe
                        if (password_verify($password, $utilisateur['pass'])) {
                            // Authentification réussie, Stockez info de l'utilisateur dans la session
                            $_SESSION['userkonekte'] = $utilisateur;
                            header('Location: profil.php'); // Rediriger vers la page de tableau de bord après la connexion
                            exit();
                        } 
                        else {
                            // Mot de passe incorrect
                            $message_erreur = "Mot de passe incorrect.";
                        }
                }

                    //$rep['email'] == $email && $rep['pass'] == $password
                //     if($rep['profil'] == "Standart") {
                //         $_SESSION['id'] = $rep['id'];
                //         header('location:welcom_standart.php');

                //     } elseif($rep['profil'] == "Premium"){
                //         $_SESSION['id'] = $rep['id'];
                //         header('location:welcom_premium.php');
                    
                //     } elseif($rep['profil'] == "root"){
                //         $_SESSION['id'] = $rep['id'];
                //         header('location:welcom_root.php');
                //     }
                // echo "Echec de connexion ou coordonées incorrect";
}
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center>
    <h2>Veuillez vous connectez ici</h2>
            <form action="" method="post">
        <input type="email" name="email" placeholder="Email"> <br> <br>
        <input type="password" name="pass" placeholder="password"> <br> <br>
        <input type="submit" name="connexion" value="connexion">
    </form>
    <br>
    <p>👉 <a href="inscription.php">Je m'inscris!</a></p>
    </center>
    <p style="text-align:center;">Login: conde@yopmail.com => 1234 || jojo@yopmail.com => 1234   </p>
</body>
</html>