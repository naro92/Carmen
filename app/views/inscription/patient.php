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
      "link" => "/mvcExample/public/inscription/",
    ]); ?>

    <div class="form-container">
      <h1 class="title">Inscription Patient</h1>
      <form class="form" method="post" action="/mvcExample/public/inscription/inscriptionPatient">
        <div class="form-group">
          <input required type="text" pattern=".{4,}" title="Enter valid email address" />
            <label>Code Famille</label>
        </div>
        <div class="form-group">
          <input type="text" required pattern=".{4,}" title="Enter valid email address" name="nom"/>
            <label>Nom</label>
        </div>
        <div class="form-group">
          <input type="text" required pattern=".{4,}" title="Enter valid email adress" name="email"/>
            <label>Adresse mail</label>
        </div>
        <div class="form-group">
          <input type="password" required pattern=".{4,}" title="Enter valid email address" name="password"/>
            <label>Mot de passe</label>
        </div>
        <div class="form-group">
          <input type="password" required pattern=".{4,}" title="Enter valid email address" />
            <label>Répeter le mot de passe</label>
        </div>
        <button type="submit" class="button-validate">
          S'inscrire
        </button>
      </form>
      
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>