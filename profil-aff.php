<?php 
try {
    $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $coo = "SELECT * FROM patient where adresse_mail= 'tugdualk@hotmail.com'";
    $coo=$bdd->query($coo);


  } catch(PDOException $e) {
    echo $coo . "<br>" . $e->getMessage();
  }?>