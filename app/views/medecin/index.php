<?php
function load_header($view, $data = []){
        require_once '../app/views/' . $view . '.php';
    }
?>

<head>
        <title>Accueil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/accueil_medecin.css'; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/header.css'; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header('/header/index', ['button' => 'Deconnexion', 'link' => '/mvcExample/public/connexion/deconnexion']); ?>

  <div class="bvn">
      <div class="message_bvn">
        <h1>
          Bienvenue <br />
          [NOM]
        </h1>
        <p>
          L'interface de gestion pour les <br />
          professionels de santé
        </p>
      </div>
      <div class="img_bvn">
        <img src="<?php echo ROOT_PATH . '/assets/hp.png'?>" />
      </div>
    </div>
    <div class="bordure"></div>

    <div class="bordure"></div>

    <div class="tableau-container">
      <div class="tableau_bord">
        <div class="list_patients">
          <img src="<?php echo ROOT_PATH . '/assets/patient.png'?>" />
          <a href="#mespatients" class="tableauLink">Mes Patients</a>
        </div>

        <div class="list_chambres">
          <img src="<?php echo ROOT_PATH . '/assets/chambre.png' ?>" />
          <a href="#chambres" class="tableauLink">Chambres</a>
        </div>

        <div class="list_rechercher">
          <img src="<?php echo ROOT_PATH . '/assets/rechercher.png'?>" />
          <a href="#rechercher" class="tableauLink">Rechercher</a>
        </div>

        <div class="list_chat">
          <img src="<?php echo ROOT_PATH . '/assets/chat_2.png'?>" />
          <a href="#Chat" class="tableauLink">Chat</a>
        </div>

        <div class="list_FAQ">
          <img src="<?php echo ROOT_PATH . '/assets/faq.png'?>" />
          <a href="/mvcExample/public/home/faq/" class="tableauLink">FAQ</a>
        </div>

        <div class="list_profil">
          <img src="<?php echo ROOT_PATH . '/assets/profil.png'?>" />
          <a href="#profil" class="tableauLink">Mon Profil</a>
        </div>
      </div>
    </div>

    <div class="bordure"></div>

    <div class="alerte_container">
      <div class="alerte">
        <div class="header-alerte">
          <h1>Mes Alertes</h1>
          <img src="<?php echo ROOT_PATH . '/assets/alerte.png'?>" />
        </div>
        <div class="alerteContenu">
          <p>Alertes</p>
        </div>
      </div>
    </div>

    <?php require_once("../app/views/footer/index.php") ?>

</body>