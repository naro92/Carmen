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
$sql = 'INSERT into user SELECT * FROM patients where id = ?';
$stmt = $bdd->prepare($sql);
$stmt->execute([$id]);
if ($stmt){
    echo '<script>alert("Patient ajouté à votre liste");</script>';
    header('location: /ajouter_patient_medecin.php');
}

 ?>