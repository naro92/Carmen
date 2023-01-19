<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Patient</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/accueilPatient.css"; ?>" />
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

<div class="main_container">
    <div class="bvn_container">
      <div class="text_bvn">
        <h1>Bienvenue<br><?php echo $data["prenom"]; ?></h1>
        <p>Carmen, une solution pour les patients</p>
      </div>
      <img src="<?php echo ROOT_PATH . "/assets/hp.png"; ?>">
    </div>

    <div class="main">
      <div class="profil">
        <h1>Votre profil</h1>
        <img src="<?php echo ROOT_PATH . "/assets/profil.png"; ?>">
        <div class="btn_profil">
          <a href="/public/patient/modifierProfil">Modifier votre profil</a>
        </div>
      </div>
      <div class="bilan">
        <h1>Vos Bilans</h1>
        <img src="<?php echo ROOT_PATH . "/assets/bilan_1.png"; ?>">
        <div class="btn_bilan">
          <a href="/public/patient/rapports">accéder à vos bilans</a>
        </div>
      </div>
    </div>
  </div>

  <div class="faq_container">
    <div class="title_container">
      <h1>Foire aux questions</h1>
      <img src="<?php echo ROOT_PATH . "/assets/faq1.png"; ?>">
    </div>
    <div class="faq_info_container">
      <h1>Une question?</h1>
      <p>Accédez à notre FAQ</p>
      <p id="faq_p">Des sujets diverses et variées sur le monde hospitalier</p>
      <hr />
      <div class="button_container">
        <a href="/public/home/faq/" class="button_faq">FAQ</a>
        <img src="<?php echo ROOT_PATH . "/assets/faq2.png"; ?>">

      </div>

    </div>

  </div>


<?php require_once "../app/views/footer/index.php"; ?>

</body>