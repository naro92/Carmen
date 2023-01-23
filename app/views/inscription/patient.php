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
      <h1 class="title">Inscription Patient</h1>
      <p><?php echo $data["error"]; ?></p>
      <form class="form" method="post" action="/public/inscription/patient">
        <div class="form-group">
          <input required type="text" name="code" pattern=".{4,}" title="Enter valid email address" />
            <label>Code Patient</label>
        </div>
        <div class="form-group">
          <input type="mail" required pattern=".{1,}" title="Enter valid email adress" name="email"/>
            <label>Adresse mail</label>
        </div>
        <div class="form-group">
          <input type="password" required pattern=".{4,}" title="Enter valid email address" name="password"/>
            <label>Mot de passe</label>
        </div>
        <div class="form-group">
          <input type="password" required pattern=".{4,}" title="Enter valid email address" name="passwordRepeat" />
            <label>Répeter le mot de passe</label>
        </div>
        <button type="submit" class="button-validate" name="submit-btn" value="sinscrire">
          S'inscrire
        </button>
      </form>
      
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>
