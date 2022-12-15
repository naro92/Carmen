<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>FAQ</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/faq.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Connexion",
    "link" => "/mvcExample/public/connexion/",
  ]); ?>
  <h1>Foire aux questions</h1>
  <p class="description-faq">Une question, un soucis ?<br/> Peut être que les réponses à celles-ci sont-ici :</p>
  <div class="question">
  <?php // print("<pre>".print_r($data['faq'],true)."</pre>");

foreach ($data["faq"]["questions"] as $row) {
    echo '<div class="question-container">';
    echo '<h5 class="titre-question">' . $row["titre"] . "</h5>";
    echo '<p class="contenu-question">' . $row["contenu"] . "</p>";
    echo "</div>";
  } ?>
  </div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>