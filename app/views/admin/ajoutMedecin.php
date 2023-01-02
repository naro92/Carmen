<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Ajouter un medecin</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/ajoutMedecin.css"; ?>" />
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
  

  <div class="admin-add">
  <form class="form-container">
  <header>
    <h1 class="title">Ajouter un médecin</h1>
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
      <label for="city">Email</label>
      <input class="input" type="text" name="mail">
    </div>

    <div class="btn-container">
      <button class="btn" type="submit">Save All</button>
    </div>
    
</form>
</div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>