<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Administrateur</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/gestion_capteurs.css"; ?>" />
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

<div class="main_container">
	<div class="title_container">
		<h1>Gestion des chambres</h1>
	</div>
	<div class="main">
		<div class="capteurs">
        <table class="table-faq-admin">
            <!-- table heading -->
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Action</th>
                </tr>
            </thead>
 
            <!-- table body -->
            <tbody>
            <?php foreach ($data["capteurs"]["capteurs"] as $row) {
              echo "<tr>";
              echo '<form method="POST">';
              echo '<td data-label="Id">' .
                $row["numero"] .
                '<input type="hidden" name="id" value="' .
                $row["numero"] .
                '" required /></td>';
              echo '<td data-label="Action">';
              echo '<input id="supress-btn" type="submit" value="Supprimer" name="supress-btn" formaction="/public/admin/supprimerChambreAction" />';
              echo "</td>";
              echo "</form>";
              echo "</tr>";
            } ?>
            </tbody>
        </table>
		<div class="add-container">
          <div class="ajouterQuestion">
            <h3>Ajouter une chambre :</h3>
            <form method="post" action="/public/admin/addChambreAction">
 	<label>Numéro</label>
 	<input type="number" name="chambre"><br>
    <input type="submit" value="ajouter" name="add-btn">
            </form>
          </div>
        </div>
	</div>
</div>
        </div>




<?php require_once "../app/views/footer/index.php"; ?>

</body>