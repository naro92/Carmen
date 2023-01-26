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
      <p><?php echo $data["error"]; ?></p>
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
          <?php if (empty($data["data"]["patients"])) {
            echo "<tr>";
            echo '<td height="50">vide</td>';
            echo "<td>vide</td>";
            echo "<td>vide</td>";
            echo '<td id="case_mail">vide</td>';
            echo "</tr>";
          } else {
            foreach ($data["data"]["patients"] as $row) {
              echo '<form method="POST">';
              echo "<tr>";
              echo '<td height="50"><input type="hidden" name="id" value="' .
                $row["id"] .
                '" required />' .
                $row["id"] .
                "</td>";
              echo "<td>" . $row["prenom"] . "</td>";
              echo "<td>" . $row["nom"] . "</td>";
              echo '<td id="case_mail">' . $row["email"] . "</td>";
              echo '<td><input id="supress-btn" type="submit" value="Supprimer" name="supress-btn" formaction="/public/medecin/patient/" class="btn_container"/></td>';
              echo '<td><div class="btn_container"><a href="/public/medecin/choix/' .
                $row["id"] .
                '">Choix</a></div></td>';
              echo "</tr>";
              echo "</form>";
            }
          } ?>
        </tbody>
      </table>
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>