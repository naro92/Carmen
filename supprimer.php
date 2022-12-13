<?php
 try
 {
     $bdd = new PDO('mysql:host=localhost;dbname=bdd', 'root', 'root');
 }
 catch (Exception $e)
 {
//en cas d'erreur on affiche un message et on arrete tout
     die('Erreur : ' . $e->getMessage());
 }
$id = $_GET["id"];
$sql = 'DELETE from user WHERE id = ?';
$stmt = $bdd->prepare($sql);
$stmt->execute([$id]);
header('location: /gestion_patient_médecin avec php.php');


 ?>