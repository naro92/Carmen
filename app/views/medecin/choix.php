<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Choix</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/choix_medecin.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Connexion",
    "link" => ROOT_PATH . "/connexion/",
  ]); ?>
    <div class="btn_retour">
      <a href="<?php echo ROOT_PATH . "/medecin"; ?>"> <= Retour</a>
    </div>

    <div class="title_container">
      <h1>Tableau de bord du patient [NOM] [Prenom]</h1>
    </div>
    <div class="main">
      <div class="main_bloc" id="constante_vitale">
        <img src="img/chat_2.png" />
        <div class="btn_constante_vitale">
          <a href="<?php echo ROOT_PATH .
            "/medecin/constantes"; ?>">Constantes vitales</a>
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