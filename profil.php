<?php
session_start();
include('connexion.php');

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['userkonekte'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php'); 
    exit();
}

//Get All Tache
    // Préparez et exécutez la requête SELECT
    $requete = $connexion->prepare("SELECT * FROM tache WHERE user_id = :id");
    $requete->bindParam(':id', $_SESSION['userkonekte']['id']);
    $requete->execute();

    //On prend les taches selectionnees
    $taches = $requete->fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['userkonekte']['nom'].' '.$_SESSION['userkonekte']['prenom'];?></title>
<style>
    ul{
        list-style-type: none;
    }
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
        .addBtn{
            text-align: center !important;
        }
</style>
</head>
<body>
    <center style="border: 3px solid green;">
        <h2>Profil de <?php echo $_SESSION['userkonekte']['nom'].' '.$_SESSION['userkonekte']['prenom']; ?></h2>

        <!-- Affichez les informations de l'utilisateur -->
        <p>Nom : <?php echo $_SESSION['userkonekte']['nom']; ?></p>
        <p>Prénom : <?php echo $_SESSION['userkonekte']['prenom']; ?></p>
        <p>Email : <?php echo $_SESSION['userkonekte']['email']; ?></p>
        <p>Type Compte : <?php echo $_SESSION['userkonekte']['profil']; ?></p>
        <br>
    <a href="deconnexion.php">Se déconnecter</a>
    </center>

    <center>
        <?php if(!empty($taches)){?>
            <!-- Affichez les tâches de l'utilisateur -->
            <h3>Mes Tâches</h3>
            <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Debut</th>
                    <th>Fin</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($taches)){foreach($taches as $tache){ 
                // Créez un objet DateTime en analysant la date d'origine
                $dateObjdb = DateTime::createFromFormat('Y-m-d', $tache['db']);
                $dateObjdf = DateTime::createFromFormat('Y-m-d', $tache['df']);
                ?>
                    <tr>
                        <td><?php echo $tache['type']; ?></td>
                        <td><?php echo $tache['description']; ?></td>
                        <td><?php echo $dateObjdb->format('d-m-Y'); ?></td>
                        <td><?php echo $dateObjdf->format('d-m-Y'); ?></td>
                    </tr>
                <?php }}?>
            </tbody>
               <tfoot>
                    <tr>
                        <td colspan="4" class="addBtn"><a href="tache.php">Ajouter Tache</a></td>
                    </tr>
               </tfoot> 
            </table>
            <?php }
                else{
                    echo '<br/>Aucune tache! <br/><br/><br/><a href="tache.php">Ajouter Tache</a>';
                }?>
    </center>
    

    <!-- Bouton pour ajouter une tâche -->
    <!-- <h3>Ajouter une Tâche</h3>
    <form method="POST" action="ajouter_tache.php">
        <label for="nom_tache">Nom de la Tâche :</label>
        <input type="text" name="nom_tache" required>
        <br>
        <label for="description_tache">Description :</label>
        <textarea name="description_tache" rows="4" required></textarea>
        <br>
        <input type="submit" name="save_tache" value="Ajouter">
    </form>

    <br>
    <a href="deconnexion.php">Se déconnecter</a> -->
    
</body>
</html>