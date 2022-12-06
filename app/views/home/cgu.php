<?php
function load_header($view, $data = []){
        require_once '../app/views/' . $view . '.php';
    }
?>

<head>
        <title>CGU</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/faq.css'; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/header.css'; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header('/header/index', ['button' => 'Connexion', 'link' => '/mvcExample/public/connexion/']); ?>
  <h1>Conditions Générales d'Utilisation</h1>
  <p class="description-faq">Conditions générales d'utilisations de notre service :</p>

</body>