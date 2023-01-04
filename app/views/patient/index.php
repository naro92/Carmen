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
  "link" => "/public/connexion/deconnexion",
]); ?>

<h1>Patient :</h1>

<p style="text-align: center;">Bienvenue <?php echo $data["prenom"]; ?></p>

<div class="liens">
    <a href="/public/patient/modifierProfil">Modifier son profil</a>
</div>


<?php require_once "../app/views/footer/index.php"; ?>

</body>