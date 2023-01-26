<?php

//显示聊天内容Afficher le contenu du chat


require("./chat-class-function.php");

$db = db::getdb();

$nom = db::getmedecinnom();


$mi = $db->getmedecinID($nom);


$pi = $db->getpatientID();


$list = db::getdb()->getlts($pi,$mi);

$listNom = $db->getnom($mi);

$getpatientnom = $db->getdb()->getpatientnom($pi);

$str='';

if($list){

for($i=0,$k=count($list);$i<$k;$i++) //通过循环逐条获取Passe par les boucles une par une
{
    $str .= "<span style='color:#C9E265;'>".$list[$i]['time']."</span>

    <br />

    ".$list[$i]['contenu'].

    "<br />";
}
}
echo $str;


?>
