<?php
require_once("./chat-class-function.php"); 

if($_GET['say']){  //如果消息不为空 Si le message n'est pas vide

	$user=$_GET['user'];
	$say=$_GET['say'];
	// $user = "q";
	// $say= "abc";
	
	$time = date("Y-m-d H:i:s");	

	$db = db::getdb();


	$userID = $db->getdb()->getuserid($user);
	
	$nom = $db->getdb()->getfamillenom();

	$medecinID = $db->getdb()->getmid($userID);

	$patientID = $db->getdb()->getpID($userID);
	
	$Espace = " &nbsp&nbsp&nbsp";

	$deuxpoints = ":";
	
	$say1 = "$nom$deuxpoints$Espace$say";


    var_dump($say1,$userID,$time,$medecinID,$patientID);

	$status = db::getdb()->insertlts($say1,$userID,$time,$medecinID,$patientID);  

	var_dump($status);
	
}
