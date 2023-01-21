<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Inscription personnel</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/inscription.css"; ?>" />
          <link rel="stylesheet" href="<?php echo ROOT_PATH .
            "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

    <?php load_header("/header/index", [
      "button" => "Inscription",
      "link" => "/public/inscription/",
    ]); ?>

    <div class="form-container">
      <h1 class="title">Inscription Personnel</h1>
      <form class="form" method="post" action="/public/inscription/inscriptionMedecin">
        <div class="form-group">
          <input required type="text" pattern=".{4,}" required name="code" title="Enter valid email address" />
            <label>Code Personnel</label>
        </div>
        <div class="form-group">
          <input type="email" name="email" required title="Entrez une email valide" />
            <label>Contact - Télephone</label>
        </div>
        <div class="form-group">
          <input type="password" name="password" required pattern=".{4,}" title="Enter valid email address" />
            <label>Mot de passe</label>
        </div>
        <div class="form-group">
          <input type="password" name="passwordRepeat" required pattern=".{4,}" title="Enter valid email address" />
            <label>Répeter le mot de passe</label>
        </div>
        <button type="submit" class="button-validate" name="submit-btn" value="S'inscrire">
          S'inscrire
        </button>
      </form>
      
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>
