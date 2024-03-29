<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Ajouter un administrateur</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/ajoutAdmin.css"; ?>" />
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
  
  <div class="admin-add">
  <form class="form-container" method="post" action="/public/admin/ajoutAdmin">
  <header>
    <h1 class="title">Ajouter un administrateur</h1>
    <p><?php echo $data["error"]; ?></p>
  </header>

  <div class="form">
    <div class="field">
      <label for="name">Nom</label>
      <input class="input" type="text" name="name">
    </div>

    <div class="field">
      <label for="firstname">Prénom</label>
      <input class="input" type="text" name="firstname">
    </div>

    <div class="field">
      <label for="email">Date de naissance</label>
      <input class="input" type="date" name="naissance" placeholder="name@website.com">
    </div>

    <div class="field">
      <label for="phone">Sexe</label>
      <select name="sexe" class="input">
        <option value="">--Selectionner un sexe--</option>
        <option value="male">Male</option>
        <option value="female">Femelle</option>
      </select>
    </div>

    <div class="field">
      <label for="address">Addresse</label>
      <input class="input" type="text" name="address">
    </div>

    <div class="field">
      <label for="city">Email</label>
      <input class="input" type="text" name="mail">
    </div>

    <div class="field">
      <label for="password">mot de passe</label>
      <input class="input" type="password" name="password">
    </div>

    <div class="btn-container">
      <button class="btn" type="submit" name="submit-btn" value="save-all">Save All</button>
    </div>
    
</form>
</div>


  <?php require_once "../app/views/footer/index.php"; ?>


</body>