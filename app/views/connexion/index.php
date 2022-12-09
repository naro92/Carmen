<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Connexion</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/connexion.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

    <?php load_header("/header/index", [
      "button" => "Inscription",
      "link" => ROOT_PATH . "/inscription/",
    ]); ?>

    <h1 class="title">Connexion</h1>

    <nav class="nav_connection">
      <ul class="choix" id="choix">
        <li class="list-choix">
          <a href="<?php echo ROOT_PATH .
            "/connexion/personnel"; ?>" class="button-Personnels">Personnel</a>
        </li>
        <li class="list-choix">
          <a href="/mvcExample/public/connexion/patient" class="button-Personnels">Patient</a>
        </li>
        <li class="list-choix">
          <a href="/mvcExample/public/connexion/famille" class="button-Personnels">Famille</a>
        </li>
        <li class="list-choix">
          <p>Vous n'avez pas de compte ? <a href="<?php echo ROOT_PATH .
            "/inscription/"; ?>">Inscrivez-vous </a> ici !</p>

        </li>
      </ul>
    </nav>

    <?php require_once "../app/views/footer/index.php"; ?>
