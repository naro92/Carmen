<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Famille</title>
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
		<h1>Sélection d'un rapport</h1>
	</div>
	<div class="main">
		<div class="capteurs">
        <table class="table-faq-admin">
            <!-- table heading -->
            <thead>
                <tr>
                    <th>ID Rapport</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
 
            <!-- table body -->
            <tbody>
            <?php if (empty($data["rapports"]["rapports"])) {
              echo "<tr>";
              echo '<td height="50">vide</td>';
              echo "<td>vide</td>";
              echo "<td>vide</td>";
              echo '<td id="case_mail">vide</td>';
              echo "</tr>";
            } else {
              foreach ($data["rapports"]["rapports"] as $row) {
                echo "<tr>";
                echo '<form method="POST">';
                echo '<td data-label="Id">' .
                  $row["id"] .
                  '<input type="hidden" name="id" value="' .
                  $row["id"] .
                  '" required /></td>';
                echo '<td data-label="Date">' . $row["date"] . "</td>";
                echo '<td data-label="Action">';
                echo '<input id="supress-btn" type="submit" value="Voir" name="voir-btn" formaction="/public/famille/voirRapport" />';
                echo "</td>";
                echo "</form>";
                echo "</tr>";
              }
            } ?>
            </tbody>
        </table>
	</div>
</div>
        </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>