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

<body onload="table();tableTemp();">

<script type="text/javascript">
      function table(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
          document.getElementById("bpm_text").innerHTML = this.responseText;
        }
        xhttp.open("GET", "/public/medecin/getConstantesCardiaque");
        xhttp.send();
        
      }

      setInterval(function(){
        table();
        tableTemp();
      }, 3000);

      function tableTemp(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
          document.getElementById("temp_text").innerHTML = this.responseText;
        }
        xhttp.open("GET", "/public/medecin/getConstantesTemp");
        xhttp.send();
        
      }

</script>

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
            <img src="<?php echo ROOT_PATH . "/assets/bpm_image.svg"; ?>" />
            <h1>Fréquence cardiaque</h1>
          </div>
          <div class="bpm_container">
            <p><span id="bpm_text"></span> Bpm</p>
          </div>
        </div>

        <div id="temp">
          <div class="temperature_title_container">
            <img src="<?php echo ROOT_PATH . "/assets/temp_image.svg"; ?>" />
            <h1>Température</h1>
          </div>
          <div class="bpm_container">
          <p><span id="temp_text"></span> °C</p>
          </div>
        </div>

        <div id="patient">
          <div class="patient_title_container">
            <img src="<?php echo ROOT_PATH . "/assets/profil_image.svg"; ?>" />
            <h1>Patient</h1>
          </div>
          <div class="infos_patients">
            <p>Nom : <?php echo $data["patient"]["patients"][0]["nom"]; ?></p>
            <p>Prénom : <?php echo $data["patient"]["patients"][0][
              "prenom"
            ]; ?></p>
            <p>Naissance : <?php echo $data["patient"]["patients"][0][
              "age"
            ]; ?></p>
            <p>Sexe : <?php echo $data["patient"]["patients"][0]["sexe"]; ?></p>
          </div>
          <hr />
          <div class="dernier_bilan_container">
            <h1>Dernier Bilan:</h1>
            <div class="btn_bilan_container">
              <a href="<?php echo "/public/medecin/bilans/" .
                $data["id"]; ?>">Dossier médical</a>
            </div>
          </div>
        </div>

        <div id="suivi_patient">
          <div class="img_container">
            <img src="<?php echo ROOT_PATH . "/assets/logo.png"; ?>" />
          </div>
          <div class="btn_container">
          <a href="<?php echo "/public/medecin/bilans/" .
            $data["id"]; ?>">Suivi du patient</a>
          </div>
        </div>
      </div>
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>