<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Administrateur</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/adminAccueil.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

<?php load_header("/header/index", [
  "button" => "Deconnexion",
  "link" => "/mvcExample/public/connexion/deconnexion",
]); ?>

<h1>Administration</h1>

<div class="liens">
    <a href="/mvcExample/public/admin/ajoutAdmin">Ajouter des administrateurs</a>
    <a href="/mvcExample/public/admin/ajoutMedecin">Ajouter des medecins</a>
    <a href="/mvcExample/public/admin/ajoutCapteurs">Ajouter des capteurs</a>
</div>


<?php require_once "../app/views/footer/index.php"; ?>

</body>