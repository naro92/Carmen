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

<h1>Administration</h1>

<div class="grid-container">
  <div id="nbPatient">
    <h3>Nombre de patients :</h3>
    <p class="textNb"><?php echo $data["nbPatient"]; ?></p>
  </div>
  <div id="nbMedecin">
    <h3>Nombre de médecins :</h3>
    <p class="textNb"><?php echo $data["nbMedecin"]; ?></p>
  </div>
  <div id="actions">
    <h3>Actions administrateur :</h3>
    <div class="liens">
    <a href="/public/admin/ajoutAdmin">Ajouter des administrateurs</a>
    <a href="/public/admin/ajoutMedecin">Ajouter des medecins</a>
    <a href="/public/admin/ajoutPatient">Ajouter des patients</a>
    <a href="/public/admin/ajoutFamille">Ajouter un membre de famille</a>
    <a href="/public/admin/gererCapteurs">Gérer les capteurs</a>
    <a href="/public/admin/faqModif">Gérer la FAQ</a>
</div>
  </div>
</div>




<?php require_once "../app/views/footer/index.php"; ?>

</body>