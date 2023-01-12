<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div style="position: absolute;top: 30%;left: 30%;">

<?php

require_once("./chat-class-function.php"); 

//$medecin = "x";

//$medecinID = "1";


$db = db::getdb();

$medecinnom = $db->getmedecinnom();

$medecinID = $db->getmedecinID($medecinnom);



$link = mysqli_connect('localhost' , 'root' , 'woaiai123'); //连接数据库 Connexion à la base de données

mysqli_set_charset($link , 'utf8');         //设置字符集 Définis le jeu de caractères

mysqli_select_db($link , 'mydb');           //选择数据库 Sélectionne la base de données

$sql = "select `idPatient`,`Nom`,`Prénom` from `patient` where `Médecin_idMédecin` = '$medecinID' ";     //准备sql语句 Prépare les déclarations sql

$res = mysqli_query($link , $sql);          //发送sql语句 Envoyer une déclaration sql

echo '<table width=600 border=1>';

echo '<caption>Veuillez sélectionner un patient de chat</caption>';

echo '<th>ID</th><th>Nom</th><th>Prénom</th><th>Fenêtre de chat</th>';

while($rows = mysqli_fetch_assoc($res)){  //通过循环显示表内所有信息Affiche toutes les informations du tableau en faisant un cycle
    echo'<tr>';
    echo'<td>'.$rows['idPatient'].'</td>';
    echo'<td>'.$rows['Nom'].'</td>';
    echo'<td>'.$rows['Prénom'].'</td>';
    echo'<td><a href="chat.php?patientID='.$rows['idPatient'].'">chat</a>';
    echo'</tr>';
}


mysqli_close($link);             //关闭数据库 Fermer la base de de la base de de la base 



?> 

</div>
    
</body>
</html>
