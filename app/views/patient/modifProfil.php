<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Modifier son profil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/modifProfilPatient.css"; ?>" />
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
  
  <div class="form-container">
        <div class="user">
        <img src="<?php echo ROOT_PATH . "/assets/profil.png"; ?>"/>
       </div>
       <h1 style="text-align: center;">Modifier profil :</h1>
        <form class="form" action="/mvcExample/public/patient/modifierProfilAction" method="post">
          <div class="form-group">
            <input type="text" pattern=".{4,}" title="Enter valid email address" name="nom"/>
              <label>Nom</label>
          </div>
          <div class="form-group">
            <input type="text" pattern=".{4,}" title="Enter valid email address" name="prenom"/>
              <label>Prénom</label>
          </div>
          <div class="form-group">
            <input type="text" pattern=".{4,}" title="Enter valid email address" name="age"/>
              <label>age</label>
          </div>
          <div class="form-group">
            <input type="text" pattern=".{4,}" title="Enter valid email address" name="sexe"/>
              <label>sexe</label>
          </div>
          <div class="form-group">
            <input type="text" pattern="[0][0-9]{9}" title="Entrez un numéro de téléphone valide" name="phone" />
              <label>Télephone</label>
          </div>
          <div class="form-group">
            <input type="text" pattern=".{4,}" title="Enter valid email address" name="adresse" />
              <label>Adresse</label>
          </div>
          <div class="form-group">
            <input type="text" required pattern=".{4,}" title="Enter valid email address" name="mail" />
              <label>Adresse email</label>
          </div>
          <button type="submit" class="button-validate">
            Valider
          </button>
        </form>
        
      </div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>