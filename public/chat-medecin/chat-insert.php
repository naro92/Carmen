<?php

require_once("./chat-class-function.php"); 

if($_GET['say']){  //如果消息不为空 Si le message n'est pas vide

	$user = $_GET['user'];

	$say = $_GET['say'];
	
	$time = date("Y-m-d H:i:s");	

	$db = db::getdb();


	$userID = $db->getdb()->getuserid($user);
	
	$nom = $db->getdb()->getmedecinnom();

	$patientID = $db->getdb()->getpid();

	$familleID = $db->getdb()->getfamailleID();

	$Espace = " &nbsp&nbsp&nbsp";

	$deuxpoints = ":";
	
	$say1 = "$nom$deuxpoints$Espace$say";
    var_dump($say1,$userID,$time,$patientID,$familleID);
	
	db::getdb()->insertlts($say1,$userID,$time,$patientID,$familleID);
		
}
