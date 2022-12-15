<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Constantes vitales</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/constantes.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Deconnexion",
    "link" => ROOT_PATH . "/connexion/deconnexion",
  ]); ?>
    
    <div class="title_container">
      <div class="title">
        <h1>Constantes vitales</h1>
      </div>
    </div>

    <div class="dashboard">
      <div class="grid-container">
        <div id="freq">
          <div class="frequence_title_container">
            <img src="logo frequence.png" />
            <h1>Fréquence cardiaque</h1>
          </div>
          <div class="schema_frequence">Schema a mettre ici</div>
          <div class="bpm_container">
            <p>? Bpm</p>
          </div>
        </div>

        <div id="temp">
          <div class="temperature_title_container">
            <img src="logo temperature.png" />
            <h1>Température</h1>
          </div>
          <div>Schema Température</div>
        </div>

        <div id="patient">
          <div class="patient_title_container">
            <img src="profil vitale.png" />
            <h1>Patient</h1>
          </div>
          <div class="infos_patients">
            <p>Nom : <?php echo $data["patient"]["patients"][0]["nom"]; ?></p>
            <p>Prénom : <?php echo $data["patient"]["patients"][0][
              "prenom"
            ]; ?></p>
            <p>Age : <?php echo $data["patient"]["patients"][0]["age"]; ?></p>
            <p>Sexe : <?php echo $data["patient"]["patients"][0]["sexe"]; ?></p>
          </div>
          <hr />
          <div class="dernier_bilan_container">
            <h1>Dernier Bilan:</h1>
            <div class="btn_bilan_container">
              <a href="#Dossier_medical">Dossier médical</a>
            </div>
          </div>
        </div>

        <div id="suivi_patient">
          <div class="img_container">
            <img src="logo.png" />
          </div>
          <div class="btn_container">
            <a href="#suivi">Accéder au suivi du patient</a>
          </div>
        </div>
      </div>
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>