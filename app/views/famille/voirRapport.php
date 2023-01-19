<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Famille</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/gestion_capteurs.css"; ?>" />
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
  
  <div class="main_container">
	<div class="title_container">
		<h1>Rapport</h1>
	</div>
	<div class="main">
		<div class="rapport_container">
            <?php echo nl2br(htmlspecialchars($data["texteRapport"])); ?>
        </div>
</div>
        </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>