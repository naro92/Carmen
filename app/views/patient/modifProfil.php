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
    "button" => "Deconnexion",
    "link" => "/public/connexion/deconnexion",
  ]); ?>
  
  <div class="form-container">
        <div class="user">
        <img src="<?php echo ROOT_PATH . "/assets/profil.png"; ?>"/>
       </div>
       <h1 style="text-align: center;">Modifier profil :</h1>
       <p><?php echo $data["error"]; ?></p>
        <form class="form" action="/public/patient/modifierProfil" method="post">
        <input type="hidden" name="id" value="<?php echo $data["infos"][
          "id"
        ]; ?>" required /></td>
          <div class="form-group">
            <input type="text" pattern=".{1,}" title="Enter valid email address" name="nom" value="<?php print_r(
              htmlspecialchars($data["infos"]["nom"])
            ); ?>"/>
              <label>Nom</label>
          </div>
          <div class="form-group">
            <input type="text" pattern=".{1,}" title="Enter valid email address" name="prenom" value="<?php print_r(
              htmlspecialchars($data["infos"]["prenom"])
            ); ?>"/>
              <label>Prénom</label>
          </div>
          <div class="form-group">
            <input type="text" title="Enter valid email address" name="age" value="<?php print_r(
              htmlspecialchars($data["infos"]["age"])
            ); ?>"/>
              <label>age</label>
          </div>
          <div class="form-group">
            <input type="text" pattern=".{1,}" title="Enter valid email address" name="sexe" value="<?php print_r(
              htmlspecialchars($data["infos"]["sexe"])
            ); ?>"/>
              <label>sexe</label>
          </div>
          <div class="form-group">
            <input type="text" pattern="[0-9]{9}" title="Entrez un numéro de téléphone valide" name="phone" value="<?php print_r(
              htmlspecialchars($data["infos"]["telephone"])
            ); ?>"/>
              <label>Télephone</label>
          </div>
          <div class="form-group">
            <input type="text" pattern=".{1,}" title="Enter valid email address" name="adresse" value="<?php print_r(
              htmlspecialchars($data["infos"]["adresse"])
            ); ?>"/>
              <label>Adresse</label>
          </div>
          <div class="form-group">
            <input type="text" required pattern=".{1,}" title="Enter valid email address" name="mail" value="<?php print_r(
              htmlspecialchars($data["infos"]["email"])
            ); ?>"/>
              <label>Adresse email</label>
          </div>
          <button type="submit" class="button-validate" name="submit-btn", value="Valider">
            Valider
          </button>
        </form>
        
      </div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>