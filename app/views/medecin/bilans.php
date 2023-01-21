<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Bilans</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/adminFaq.css"; ?>" />
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

<h1 class="titre">Bilans </h1>

<div class="faq-admin-container">
        <table class="table-faq-admin">
            <!-- table heading -->
            <thead>
                <tr>
                    <th>Numéro bilan</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
 
            <!-- table body -->
            <tbody>
            <?php foreach ($data["rapports"] as $row) {
              $action = "/public/medecin/modifierBilan/" . $data["idPatient"];
              $action2 =
                "/public/medecin/supprimerBilanAction/" . $data["idPatient"];
              echo "<tr>";
              echo '<form method="POST">';
              echo '<td data-label="Id">' .
                $row["id"] .
                '<input type="hidden" name="id" value="' .
                $row["id"] .
                '" required /></td>';
              echo '<td data-label="Date">' . $row["date"] . "</td>";
              echo '<td data-label="Actions">';
              echo '<input id="submit-btn" type="submit" value="Modifier" name="submit-btn" formaction="' .
                $action .
                '" />';
              echo '<input id="supress-btn" type="submit" value="Supprimer" name="supress-btn" formaction="' .
                $action2 .
                '" />';
              echo "</td>";
              echo "</form>";
              echo "</tr>";
            } ?>
            </tbody>
        </table>

        <div class="add-container">
          <div class="ajouterQuestion">
            <h3>Ecrire un bilan</h3>
            <a href="<?php echo "/public/medecin/ecrireBilan/" .
              $data["idPatient"]; ?>">Ecrire un bilan</a>
          </div>
        </div>
    </div>

<?php require_once "../app/views/footer/index.php"; ?>

</body>