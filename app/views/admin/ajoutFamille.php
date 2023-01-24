<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Ajouter une famille</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/ajoutPatient.css"; ?>" />
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
  <form class="form-container" method="post" action="/public/admin/ajoutFamille">
  <header>
    <h1 class="title">Ajouter un membre de la famille</h1>
    <p><?php echo $data["error"]; ?></p>
    <p><?php echo $data["status"]; ?></p>
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
      <label for="city">Email</label>
      <input class="input" type="text" name="mail">
    </div>

    <div class="field">
      <label for="idpatient">Patient</label>
      <select name="idpatient" class="input">
        <option value="">--Selectionner un patient--</option>
        <?php // print("<pre>".print_r($data['faq'],true)."</pre>");

foreach ($data["patients"]["patients"] as $row) {
          echo '<option value="' .
            $row["id"] .
            '">' .
            $row["prenom"] .
            " " .
            $row["nom"] .
            "</option>";
        } ?>
      </select>
    </div>

    <div class="btn-container">
      <button class="btn" type="submit" name="submit-btn" value="Save All">Save All</button>
    </div>
    
</form>
</div>


  <?php require_once "../app/views/footer/index.php"; ?>


</body>