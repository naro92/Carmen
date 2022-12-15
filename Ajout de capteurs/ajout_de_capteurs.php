<?php


$Nom_de_l_équipement=$_POST["Nom"];
$Marque=$_POST["marque"];
$Modèle=$_POST["modele"];
$Position_de_montage1=$_POST["pdm"];
$Position_de_montage2=$_POST["pdm2"];
$Date_de_fabrication=$_POST["date_de_fabrication"];
$Date_d_introduction=$_POST["date_d'introduction"];
$Intervalle_d_entretien=$_POST["intervalle_d'entretien"];
$Numéro_de_téléphone_de_réparation=$_POST["numero_de_portable"];
$E_mail_de_réparation=$_POST["email"];

echo "Nom de l'équipement:".$Nom_de_l_équipement;
echo "Marque:".$Marque;
echo "Modèle:".$Modèle;
echo "Position de montage 1:".$Position_de_montage1;
echo "Position de montage 2:".$Position_de_montage2;
echo "Date de fabrication:".$Date_de_fabrication;
echo "Date d'introduction:".$Date_d_introduction;
echo "Numéro de téléphone de réparation:".$Numéro_de_téléphone_de_réparation;
echo "E-mail de réparation:".$E_mail_de_réparation;


// 定义允许上传的文件扩展名
$allowedExts = array("pdf", "doc", "docx");
// 获取文件后缀名
$temp = explode(".", $_FILES["manuel"]["name"]);
$extension = end($temp);
if ((($_FILES["manuel"]["type"] == "application/msword")
|| ($_FILES["manuel"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
|| ($_FILES["manuel"]["type"] == "application/pdf"))
&& ($_FILES["manuel"]["size"] < 2048000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["manuel"]["error"] > 0)
    {
    echo "错误：: " . $_FILES["manuel"]["error"] . "<br>";
    }
  else
    {
	
	// 如果文件夹不存在，则创建它
	if(!file_exists("upload")){
		mkdir("upload");
	}
	
	
    echo "上传文件名: " . $_FILES["manuel"]["name"] . "<br>";
    echo "文件类型: " . $_FILES["manuel"]["type"] . "<br>";
    echo "文件大小: " . ($_FILES["manuel"]["size"] / 1024) . " kB<br>";
    echo "文件临时存储的位置: " . $_FILES["manuel"]["tmp_name"] . "<br>";
    
    // 判断当期目录下的 upload 目录是否存在该文件
    // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
    if (file_exists("upload/" . $_FILES["manuel"]["name"]))
      {
      echo $_FILES["manuel"]["name"] . " 文件已经存在。 ";
      }
    else
      {
      // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
      move_uploaded_file($_FILES["manuel"]["tmp_name"], "upload/" . $_FILES["manuel"]["name"]);
      echo "文件存储在: " . "upload/" . $_FILES["manuel"]["name"];
      }
    }
  }
else
  {
  echo "非法的文件格式";
  }

  // 定义允许上传的文件扩展名
$allowedExts = array("pdf", "doc", "docx");
// 获取文件后缀名
$temp = explode(".", $_FILES["facture"]["name"]);
$extension = end($temp);
if ((($_FILES["facture"]["type"] == "application/msword")
|| ($_FILES["facture"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
|| ($_FILES["facture"]["type"] == "application/pdf"))
&& ($_FILES["facture"]["size"] < 2048000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["facture"]["error"] > 0)
    {
    echo "错误：: " . $_FILES["facture"]["error"] . "<br>";
    }
  else
    {
	
	// 如果文件夹不存在，则创建它
	if(!file_exists("upload")){
		mkdir("upload");
	}
	
	
    echo "上传文件名: " . $_FILES["facture"]["name"] . "<br>";
    echo "文件类型: " . $_FILES["facture"]["type"] . "<br>";
    echo "文件大小: " . ($_FILES["facture"]["size"] / 1024) . " kB<br>";
    echo "文件临时存储的位置: " . $_FILES["facture"]["tmp_name"] . "<br>";
    
    // 判断当期目录下的 upload 目录是否存在该文件
    // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
    if (file_exists("upload/" . $_FILES["facture"]["name"]))
      {
      echo $_FILES["facture"]["name"] . " 文件已经存在。 ";
      }
    else
      {
      // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
      move_uploaded_file($_FILES["facture"]["tmp_name"], "upload/" . $_FILES["facture"]["name"]);
      echo "文件存储在: " . "upload/" . $_FILES["facture"]["name"];
      }
    }
  }
else
  {
  echo "非法的文件格式";
  }

?>