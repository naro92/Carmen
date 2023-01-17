<?php
 try
 {
     $bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', 'root');
 }
 catch (Exception $e)
 {
//en cas d'erreur on affiche un message et on arrete tout
     die('Erreur : ' . $e->getMessage());
 }
$id = $_GET["id"];
$sql = "DELETE from capteurs WHERE idcapteurs = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id]);
header('location: liste_capteur.php');


 ?>