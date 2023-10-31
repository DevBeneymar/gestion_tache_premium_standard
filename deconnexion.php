<?php
session_start(); // Démarrez la session

// Détruisez toutes les données de session
session_unset();
session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header('Location: login.php');
exit(); 
?>
