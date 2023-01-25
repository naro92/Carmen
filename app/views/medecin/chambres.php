<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Chambres</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/chambres.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
  <?php load_header("/header/index", [
    "button" => "Deconnexion",
    "link" => "/public/connexion/deconnexion",
  ]); ?>

<h1 class="title-chambres">Gestion des chambres</h1>

<div class="container">
  <?php // print("<pre>".print_r($data['faq'],true)."</pre>");

foreach ($data["chambres"]["capteurs"] as $row) {
    echo '<div class="child">';
    echo "Chambre " . $row["numero"];
    echo "</div>";
  } ?>
</div>
  

  <?php require_once "../app/views/footer/index.php"; ?>


</body>