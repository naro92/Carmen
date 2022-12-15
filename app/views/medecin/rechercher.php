<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Rechercher</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/faq.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Deconnexion",
    "link" => "/mvcExample/public/deconnexion/",
  ]); ?>
  
<div class = "btn_retour">
	<a href=".\rechercher_patient.php">&#10229 Retour</a>
</div>
<div class="title_container">
    <h1>Résultat de votre recherche<h1>
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
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      <tr>
        <td><?php echo htmlspecialchars($row["id"]); ?></td>
        <td><?php echo htmlspecialchars($row["prenom"]); ?></td>
        <td><?php echo htmlspecialchars($row["nom"]); ?></td>
        <td id="case_mail"><?php echo htmlspecialchars($row["mail"]); ?></td>
        <td><div class="btn_container"><a href="ajouterpatient.php?id=<?php echo $row[
          "id"
        ]; ?>">ajouter</a></div></td>
    </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>