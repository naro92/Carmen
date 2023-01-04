<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Ajouter un capteur</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/ajoutCapteurs.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

<?php load_header("/header/index", [
  "button" => "Deconnexion",
  "link" => "/public/connexion/deconnexion",
]); ?>
  
  <div id="div_capteur">
  
  <form action="ajout_de_capteurs.php" id="form_aum" method="post" enctype="multipart/form-data">
<div id="div_ne">
    Nom de l'équipement:
    <input id="input_ne" type="text" name="nom"><br>
    Marque:
    <input id="input_marque" type="text" name="marque"><br>
    Modèle:
    <input id="input_modele" type="text" name="modele"><br>


    Position de montage:
    <select id="initials" name="pdm" onchange="Change_second_selectwords();"> 
    
      <option value="">Position</option> 
      <option value="couloir">couloir</option> 
      <option value="hall">hall</option> 
      <option value="bureau">bureau</option> 
        <option value="laboratoire">laboratoire</option> 
        <option value="chambre">chambre</option> 
        <option value="Salle opératoire"> Salle opératoire</option> 
    </select> 
    
    
    <select id="top_domains" name="pdm2"></select> 
        <script>
            var first_keywords = {};
            //定义每个字母对应的第二个下拉框
            first_keywords['couloir'] = ['RDC', '1 étage', '2 étage','3 étage'];
            first_keywords['hall'] = ['RDC', '1 étage'];
            first_keywords['bureau'] = ['directeur', 'médecin', 'infirmière'];
            first_keywords['laboratoire'] = ['x-ray', 'Pathologie', 'Sang'];
            first_keywords['chambre'] = ['001', '002', '003','101','102','103','201','202','203'];
            first_keywords['Salle opératoire'] = ['01', '02', '03','04','05'];
           
    
            function Change_second_selectwords() {
                //根据id找到两个下拉框对象
                var target1 = document.getElementById("initials");
                var target2 = document.getElementById("top_domains");
                //得到第一个下拉框的内容
                var selected_initial = target1.options[target1.selectedIndex].value;
    
                //清空第二个下拉框
                while (target2.options.length) {
                    target2.remove(0);
                }
            //根据第一个下拉框的内容找到对应的列表
            var initial_list = first_keywords[selected_initial];
            if (initial_list) {
                for (var i = 0; i < initial_list.length; i++) {
                    var item = new Option(initial_list[i], i);
                    //将列表中的内容加入到第二个下拉框
                    target2.options.add(item);
                }
            }
    } 
            </script><br>

    Date de fabrication:
    <input id="input_ddf" type="date" name="date_de_fabrication"><br>
    Date d'introduction:
    <input id="input_ddi" type="date" name="date_d'introduction"><br>
  </div>
    <div id="div_ie">
    Intervalle d'entretien:
    <select name="intervalle_d'entretien" id="select_ie">
      <option value="7_jours">7 jours</option>
      <option value="14_jours">14 jours</option>
      <option value="1_mois">1 mois</option>
      <option value="3_mois">3 mois</option>
      <option value="6_mois">6 mois</option>
      <option value="1_ans">1 ans</option>

  </select><br>
    Numéro de téléphone de réparation:
    <input id="input_ntr" type="tel" name="numero_de_portable"><br>
    E-mail de réparation:
    <input id="input_edr" type="email" name="email"><br>


    Documents du manuel d'instruction:
    <a href="javascript:;" class="file">&nbsp;&nbsp;Choisis
    <input id="input_choisis" type="file" name="manuel">
    </a><br>


    Factures:
    <a href="javascript:;" class="file">&nbsp;&nbsp;Choisis
    <input id="input_choisis" type="file" name="facture"><br>
    </a>


    <input id="submit_soumettre" type="submit" name="submit" value="soumettre">
  </div>
  </form>

  <div id="div_border" style="z-index:-100;position: relative;">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

</div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>