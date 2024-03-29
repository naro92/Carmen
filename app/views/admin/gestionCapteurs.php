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
		<h1>Gestion des capteurs</h1>
	</div>
	<div class="main">
		<div class="capteurs">
        <table class="table-faq-admin">
            <!-- table heading -->
            <thead>
                <tr>
                    <th>ID Capteur</th>
                    <th>Type</th>
                    <th>Chambre</th>
                    <th>Action</th>
                </tr>
            </thead>
 
            <!-- table body -->
            <tbody>
            <?php foreach ($data["capteurs"]["capteurs"] as $row) {
              echo "<tr>";
              echo '<form method="POST">';
              echo '<td data-label="Id">' .
                $row["id"] .
                '<input type="hidden" name="id" value="' .
                $row["id"] .
                '" required /></td>';
              echo '<td data-label="Type">' . $row["type"] . "</td>";
              echo '<td data-label="Chambre">' . $row["chambre"] . "</td>";
              echo '<td data-label="Action">';
              echo '<input id="supress-btn" type="submit" value="Supprimer" name="supress-btn" formaction="/public/admin/supprimerCapteurAction" />';
              echo "</td>";
              echo "</form>";
              echo "</tr>";
            } ?>
            </tbody>
        </table>
		<div class="add-container">
          <div class="ajouterQuestion">
            <h3>Ajouter un capteur :</h3>
            <form method="post" action="/public/admin/addCapteurAction">
            <label>Type</label>
 	<select name="select_type">
 		<option value ="thermique">Thermique</option>
 		<option value="cardiaque">Cardiaque</option>
     <option value="sonore">Sonore</option>
     <option value="lumiere">Intensité lumineuse</option>
 	</select><br>
 	<label>Chambre</label>
   <select name="chambre" class="input">
        <option value="">--Selectionner une chambre--</option>
        <?php // print("<pre>".print_r($data['faq'],true)."</pre>");

foreach ($data["chambres"]["capteurs"] as $row) {
          echo '<option value="' .
            $row["numero"] .
            '">' .
            $row["numero"] .
            "</option>";
        } ?>
      </select><br>
 	<label>Medecin</label>
 	<select name="id_medecin" class="input">
        <option value="">--Selectionner un medecin--</option>
        <?php // print("<pre>".print_r($data['faq'],true)."</pre>");

foreach ($data["medecins"]["medecins"] as $row) {
          echo '<option value="' .
            $row["id_medecin"] .
            '">' .
            $row["prenom"] .
            " " .
            $row["nom"] .
            "</option>";
        } ?>
      </select>
    <input type="submit" value="ajouter" name="add-btn">
            </form>
          </div>
        </div>
	</div>
</div>
        </div>




<?php require_once "../app/views/footer/index.php"; ?>

</body>