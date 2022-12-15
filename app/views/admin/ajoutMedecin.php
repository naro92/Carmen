<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>FAQ</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/ajoutMedecin.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Connexion",
    "link" => "/mvcExample/public/connexion/",
  ]); ?>
  

  <form action="ajout_de_medecin.php" id="form_aum" method="post" enctype="multipart/form-data">
    <fieldset>
      <div id="telecharger_photo">
        <img id="show" width="200" height="200">
        <br>
        <a href="javascript:;" class="file">&nbsp&nbspChoisis
        <input id="input_choisis" type="file"  name="photo">
        </a>
        <br>
      </div>
    Prenom:
    <input id="input_prenom" type="text" name="Prenom">
    Nom:
    <input id="input_nom" type="text" name="Nom"><br>
    Sexe:
    <input id="sexe_1" type="radio" name="sexe" value="Homme">Homme
    <input id="sexe_2" type="radio" name="sexe" value="Femme">Femme <br>
    Section:
    <select name="section" id="select_section">
        <option value="Chirurgie">Chirurgie</option>
        <option value="Orthopédie">Orthopédie</option>
        <option value="Otolaryngologie">Otolaryngologie</option>
        <option value="Ophtalmologie">Ophtalmologie</option>
        <option value="Gastro-entérologie">Gastro-entérologie</option>
    </select><br>
    Date d'entrée:
    <input id="input_de" type="date" name="date_d_entree"><br>
    Date de naissance:
    <input id="input_ddn" type="date" name="date_de_naissance"><br>
    Numéro de portable:
    <input id="input_ndp" type="tel" name="numero_de_portable"><br>
    E-mail:
    <input id="input_email" type="email" name="email"><br>

    <input id="submit_soumettre" type="submit" value="soumettre">
    </fieldset>
</form>

<script>
  // 获取input的dom元素
  var inputObj = document.querySelector('input');
  // 获取img的dom元素
  var imgObj = document.querySelector('#show');
  // 监听input发生改变
  inputObj.onchange = function(){
      // 获取上传的文件信息
      var pic = inputObj.files[0];

      // 创建FileReader对象
      var reader = new FileReader();

      // 编码成Data URL (这一步最为关键)
      reader.readAsDataURL(pic);

      // 监听上传完成
      reader.onload = function(){
          // 拿到base64的路径
          var src = reader.result;
          // 改变img的src属性值
          imgObj.src=src;
      }

  };
</script>

<div id="div_border" style="z-index:-100;position: relative;">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>