<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Gestion patient</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/gestionPatient.css"; ?>" />
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
    
    <div class="btn_retour">
      <a href="/public/medecin/"> &#10229 Retour</a>
    </div>

    <div class="title_container">
      <h1>Mes Patients</h1>
    </div>

    <div class="gestion_container">
      <table id="table_gestion">
        <thead>
          <tr>
            <th>ID</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data["data"]["patients"] as $row) {
            echo "<tr>";
            echo '<td height="50">' . $row["id"] . "</td>";
            echo "<td>" . $row["prenom"] . "</td>";
            echo "<td>" . $row["nom"] . "</td>";
            echo '<td id="case_mail">' . $row["email"] . "</td>";
            echo '<td><div class="btn_container"><a href="supprimer.php?id=' .
              $row["id"] .
              '">Supprimer</a></div></td>';
            echo '<td><div class="btn_container"><a href="/public/medecin/choix/' .
              $row["id"] .
              '">Choix</a></div></td>';
            echo "</tr>";
          } ?>
        </tbody>
      </table>
    </div>

    <div class="btn_gestion_container">
      <ul class="list_btn" id="list_btn">
        <li class="list_btn_att">
          <a href=".\ajouter_patient_medecin.php">Ajouter</a>
        </li>
        <li class="list_btn_att">
          <a href="#modifier">Modifier</a>
        </li>
      </ul>
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>