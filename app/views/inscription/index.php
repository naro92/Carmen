<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Inscription</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/inscription.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
          <link rel="stylesheet" href="<?php echo ROOT_PATH .
            "/style/header.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

    <?php load_header("/header/index", [
      "button" => "Connexion",
      "link" => "/public/connexion/",
    ]); ?>

    <h1 class="title">Inscription</h1>

    <nav class="nav_connection">
      <ul class="choix" id="choix">
        <li class="list-choix">
          <a href="/public/inscription/personnel" class="button-Personnels">Personnel</a>
        </li>
        <li class="list-choix">
          <a href="/public/inscription/patient" class="button-Personnels">Patient</a>
        </li>
        <li class="list-choix">
          <a href="/public/inscription/famille" class="button-Personnels">Famille</a>
        </li>
        <li class="list-choix">
          <p>Vous avez déjà un compte ? <a href="/public/connexion/">Connectez-vous </a> ici !</p>

        </li>
      </ul>
    </nav>

    <?php require_once "../app/views/footer/index.php"; ?>

  </body>