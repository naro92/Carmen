<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a{
            color: #C9E265;
            text-decoration:none
        }

        div{
            position: absolute;
            top: 25%;
            left: 30%;
        }

        h2{
            position:relative; 
            left:70px; 
            color: #C9E265;
        }

        @media screen and (max-width: 1000px) {

            body {
                width: 80%;
                margin: 0 auto;
            }

            h2{

                 display: none;

            }

            a{
            color: #C9E265;
            text-decoration:none;
            position:relative; 
            right: 40%; 
            }

            div {
                width: 60%;
                margin: 0 auto;
            }

            table {
                width: 70%;
                position:relative; 
                right: 30%; 
            }
        }

    </style>
</head>
<body>



<div>

<h2>Veuillez sélectionner un patient de chat</h2>

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

$sql = "select `idpatient`,`nom` from `patient` where `medecin_idmedecin` = '$medecinID' ";     //准备sql语句 Prépare les déclarations sql

$res = mysqli_query($link , $sql);          //发送sql语句 Envoyer une déclaration sql

echo '<table width=600 border=1>';


echo '<th>ID</th><th>Nom</th><th>Fenêtre de chat</th>';

while($rows = mysqli_fetch_assoc($res)){  //通过循环显示表内所有信息Affiche toutes les informations du tableau en faisant un cycle
    echo'<tr>';
    echo'<td>'.$rows['idpatient'].'</td>';
    echo'<td>'.$rows['nom'].'</td>';
    echo'<td>&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160&#160<a href="chat.php?patientID='.$rows['idpatient'].'&user='.$_GET['user'].'">chat</a>';
    echo'</tr>';
}


mysqli_close($link);             //关闭数据库 Fermer la base de de la base de de la base 



?> 


</button>
</div>
</body>
</html>
