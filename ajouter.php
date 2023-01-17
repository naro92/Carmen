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
$type = $_POST["select_type"];
$chambre = $_POST["chambre"];
$id_medecin = $_POST["id_medecin"];
$sql = 'INSERT INTO capteurs (type,chambre_numero,medecin_idmedecin) VALUES (:type,:chambre_numero,:medecin_idmedecin)';
$stmt = $bdd->prepare($sql);
$stmt->bindParam(":type", $type, PDO::PARAM_STR);
$stmt->bindParam(":chambre_numero", $chambre, PDO::PARAM_STR);
$stmt->bindParam(":medecin_idmedecin", $id_medecin, PDO::PARAM_STR);
$stmt->execute();
header('location: liste_capteur.php');

 ?>