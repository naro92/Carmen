<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Connexion famillel</title>
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
<div class="content">
    <?php load_header("/header/index", [
      "button" => "Inscription",
      "link" => "/public/inscription/",
    ]); ?>

    <div class="form-container">
      <h1 class="title">Connexion Famille</h1>
      <p><?php echo $data["error"]; ?></p>
      <form class="form" action="/public/connexion/famille" method="post">
        <div class="form-group">
          <input required type="mail" name="email" pattern=".{4,}" title="Enter valid email address" />
            <label>Email</label>
        </div>
        <div class="form-group">
          <input type="password" name="password" required pattern=".{4,}" title="Enter valid email address" />
            <label>Mot de passe</label>
        </div>
        <input id="submit-btn" class="button-validate" type="submit" value="Se connecter" name="submit-btn">
      </form>
      
    </div>
  </div>
    <?php require_once "../app/views/footer/index.php"; ?>
