<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>CGU</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/choix_medecin.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Connexion",
    "link" => "/mvcExample/public/connexion/",
  ]); ?>
    <div class="btn_retour">
      <a href="/mvcExample/public/medecin"> <= Retour</a>
    </div>

    <div class="title_container">
      <h1>Tableau de bord du patient [NOM] [Prenom]</h1>
    </div>
    <div class="main">
      <div class="main_bloc" id="constante_vitale">
        <img src="img/chat_2.png" />
        <div class="btn_constante_vitale">
          <a href=".\constante_vitale.html">Constantes vitales</a>
        </div>
      </div>
      <div class="main_bloc" id="rapport_medical">
        <img src="img/profil.png" />
        <div class="btn_rapport_medical">
          <a href="#rapport">Rapport médical</a>
        </div>
      </div>
    </div>
</body>