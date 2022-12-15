<?php

//设置文件上传的类型
$allowedExts = array("jpg", "jpeg", "png");
$temp = explode(".", $_FILES["photo"]["name"]);
$extension = end($temp);

if ((($_FILES["photo"]["type"] == "image/gif")
|| ($_FILES["photo"]["type"] == "image/jpeg")
|| ($_FILES["photo"]["type"] == "image/png")
|| ($_FILES["photo"]["type"] == "image/pjpeg"))
&& ($_FILES["photo"]["size"] < 204800)   // 小于200 kb
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["photo"]["error"] > 0)
    {
    echo "Erreur:: " . $_FILES["photo"]["error"] . "<br>";
    }
  else
    {
    echo "Nom du fichier à télécharger : " . $_FILES["photo"]["name"] . "<br>";
    echo "Taille du fichier :  " . $_FILES["photo"]["type"] . "<br>";
    echo "Taille du fichier :" . ($_FILES["photo"]["size"] / 1024) . " kB<br>";
    echo "Lieu de stockage temporaire des documents : " . $_FILES["photo"]["tmp_name"] . "<br>";
    // 判断当期目录下的 upload 目录是否存在该文件
    // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
    if (file_exists("upload/" . $_FILES["photo"]["name"]))
      {
      echo $_FILES["photo"]["name"] . " Le document existe déjà. ";
      }
    else
      {
      // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
      move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
      echo "Les documents sont stockés dans: " . "upload/" . $_FILES["photo"]["name"];
      }
    }
  }
else
  {
  echo "Erreur de format du document";
  }

    $Prenom=$_POST["Prenom"];
    $Nom=$_POST["Nom"];
    $sexe=$_POST["sexe"];
    $section=$_POST["section"];
    $date_d_entree=$_POST["date_d_entree"];
    $date_de_naissance=$_POST["date_de_naissance"];
    $numero_de_portable=$_POST["numero_de_portable"];
    $email=$_POST["email"];

echo "Prenom:".$Prenom;
echo "Nom:".$Nom;
echo "sexe:".$sexe;
echo "section:".$section;
echo "date d'entree:".$date_d_entree;
echo "date de naissance:".$date_de_naissance;
echo "numero de portable:".$numero_de_portable;
echo "email:".$email;



?>










