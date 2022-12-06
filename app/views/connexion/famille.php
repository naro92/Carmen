<?php
function load_header($view, $data = []){
        require_once '../app/views/' . $view . '.php';
    }
?>

<head>
        <title>Inscription personnel</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/header.css'; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/inscription.css'; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

    <?php load_header('/header/index', ['button' => 'Inscription', 'link' => '/mvcExample/public/inscription/']); ?>

    <div class="form-container">
      <h1 class="title">Connexion Famille</h1>
      <form class="form">
        <div class="form-group">
          <input required type="mail" pattern=".{4,}" title="Enter valid email address" />
            <label>Email</label>
        </div>
        <div class="form-group">
          <input type="password" required pattern=".{4,}" title="Enter valid email address" />
            <label>Mot de passe</label>
        </div>
        <button type="submit" class="button-validate">
          Connexion
        </button>
      </form>
      
    </div>

    <?php require_once("../app/views/footer/index.php"); ?>