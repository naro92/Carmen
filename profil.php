<?php

$bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$name=$_POST['nom'];
$pass1=$_POST['pwd'];
$pass2=$_POST['vpwd'];
$phone=$_POST['phone'];
$code=$_POST['code'];
if ($pass1 == $pass2){
    try {
        $sql = "UPDATE patient SET nom = '', prenom= '', age= '', adresse_mail= '', sexe= '', telephone= '', adresse= '' WHERE patientid = 1;";
        // use exec() because no results are returned
        $bdd->exec($sql);
        echo "New record created successfully";

        header('Location: http://localhost:8080/Carmen/connection.html');


        exit();
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
      
      $conn = null;
    echo "good";
}else{
    echo "error";
}

?>
