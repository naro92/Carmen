<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Accueil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/home.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body onload="myFunction();"> <!--onload="myFunction();"-->

  <?php load_header("/header/index", [
    "button" => ucfirst($data["dashboard"]),
    "link" => ROOT_PATH . "/" . $data["dashboard"],
  ]); ?>

    <div class="main-title">
      <!-- Section -->
      <div class="main-container">
        <div class="text-main">
          <h1>Carmen</h1>
          <p>
            Une Solution efficace et novatrice <br />pour les familles des
            patients.
          </p>
        </div>
        <div class="image-title">
          <img src="<?php echo ROOT_PATH . "/assets/logo.svg"; ?>" />
          <a href="#decouverte">Découvrir ⇓</a>
        </div>
      </div>
    </div>

    <div class="text-title" id="decouverte">
      <!-- Section -->
      <div class="text-container">
        <h1>CARMEN, c'est quoi ?</h1>
        <p>
          Carmen est un système développé par l’entreprise SSH. C’est un produit
          conçu pour le monde hospitalier qui a pour but la gestion de données.
        </p>
        <p>Une solution pour les familles.</p>
        <p>Un outil pour les professionels de santé.</p>
      </div>
    </div>

    <br />

    <div class="plus-section">
      <!-- Section -->
      <div class="plus-container">
        <h1 class="plus-title">En savoir plus :</h1>
        <p class="plus-text">Une question sur le domaine hospitalier?</p>
        <a class="button-plus-faq" href="<?php echo ROOT_PATH .
          "/home/faq/"; ?>">Visiter notre FAQ</a>
      </div>
    </div>

    <div class="snackber-container">
    <div id="snackbar"><p>Projet en cours de développement</br>Projet réalisé dans le cadre de l'APP de l'ISEP</p></div>
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>

<script>

function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

</script>



<!-- // Hello //$data['name']?> -->