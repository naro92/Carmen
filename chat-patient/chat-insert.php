<?php
require_once("./chat-class-function.php"); 

if($_GET['say']){  //如果消息不为空 Si le message n'est pas vide
	$user=$_GET['user'];
	$say=$_GET['say'];
	
	$time = date("Y-m-d H:i:s");	

	$db = db::getdb();


	$userID = $db->getdb()->getuserid($user);
	

	$medecinID = $db->getdb()->getmid($userID);

	$familleID = $db->getdb()->getfamailleID($userID);
	
	db::getdb()->insertlts($say,$userID,$time,$medecinID,$familleID);
	
}
