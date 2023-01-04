<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Rechercher</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/rechercherPatient.css"; ?>" />
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
  
  <div class = "btn_retour">
	<a href="/public/medecin/">	&#10229 Retour</a>
</div>
<div class="title_container">
<h1>Rechercher un patient<h1>
</div>
<div class="main_container">
<div class="main">
<form action="/public/medecin/search/" method="post">
		<pre>
			<label>Nom</label><input type="text" name="nom">
			<label>Prénom</label><input type="text" name="prenom">
			<label>e-Mail</label><input type="email" name="email">
			<input id="btn_rechercher" type="submit" value="Rechercher">
		</pre>
</form>
</div>
<div class=text_alert>
<p>Veuillez remplir au minmimum un champ<p>
</div>
</div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>