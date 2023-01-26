<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Rechercher</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/resultatRecherche.css"; ?>" />
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
  
<div class = "btn_retour">
	<a href="/public/medecin/rechercher">&#10229 Retour</a>
</div>
<div class="title_container">
    <h1>Résultat de votre recherche<h1>
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
    <?php foreach ($data["recherche"]["patients"] as $row) {
      echo "<form method='post'>";
      echo "<tr>";
      echo '<td height="50"><input type="hidden" name="id" value="' .
        $row["id"] .
        '" required />' .
        $row["id"] .
        "</td>";
      echo "<td>" . $row["prenom"] . "</td>";
      echo "<td>" . $row["nom"] . "</td>";
      echo '<td id="case_mail">' . $row["email"] . "</td>";
      echo '<td><input id="supress-btn" type="submit" value="Ajouter" name="add-btn" formaction="/public/medecin/addLink/" class="btn_container"/></td>';
      echo "</tr>";
      echo "</form>";
    } ?>
    </tbody>
  </table>
</div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>