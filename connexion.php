<?php
$server= 'localhost';
$dbname= 'stage_formation1';
$username= 'root';
$password= '';

try {
$connexion = new PDO("mysql:host=$server;dbname=$dbname", $username,$password);

$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// echo "Soyez les bienvenus! \n ";
}catch(PDOException $e) {
echo "erreur de connexion: " .$e->getMessage();
}

?>