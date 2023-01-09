<?php
  $host = 'localhost';
  $dbname = 'mydb';
  $username = 'admin';
  $password = 'admin';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  // récupérer tous les utilisateurs
//   $sql = "SELECT date_rapport FROM rapport where patient_idpatient = (SELECT idpatient from patient WHERE adresse_mail = $_SESSION["user"])";
$sql = "SELECT date_rapport FROM rapport where patient_idpatient = (SELECT idpatient from patient WHERE adresse_mail = 'mathis.champagne@patient.fr')"; 
  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);
   
   if($stmt === false){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }
?>