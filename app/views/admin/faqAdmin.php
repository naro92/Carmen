<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Administrateur</title>
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

<h1 class="titre">Administration FAQ</h1>

<div class="faq-admin-container">
        <table class="table-faq-admin">
            <!-- table heading -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Réponse</th>
                    <th>Actions</th>
                </tr>
            </thead>
 
            <!-- table body -->
            <tbody>
            <?php foreach ($data["faq"]["questions"] as $row) {
              echo "<tr>";
              echo '<form method="POST">';
              echo '<td data-label="Id">' .
                $row["id"] .
                '<input type="hidden" name="id" value="' .
                $row["id"] .
                '" required /></td>';
              echo '<td data-label="Question"><input type="text" name="question" class="form-control" value="' .
                $row["titre"] .
                '" required /></td>';
              echo '<td data-label="Réponse"><input type="text" name="answer" class="form-control" value="' .
                $row["contenu"] .
                '" required /></td>';
              echo '<td data-label="Actions">';
              echo '<input id="submit-btn" type="submit" value="Modifier" name="submit-btn" formaction="/public/admin/modifierFaqAction" />';
              echo '<input id="supress-btn" type="submit" value="Supprimer" name="supress-btn" formaction="/public/admin/supprimerFaqAction" />';
              echo "</td>";
              echo "</form>";
              echo "</tr>";
            } ?>
            </tbody>
        </table>

        <div class="add-container">
          <div class="ajouterQuestion">
            <h3>Ajouter une question :</h3>
            <form method="post" action="/public/admin/addFaqAction">
              <div class="group">
                <label>Question : </label>
                <input type="text" name="question" class="form-control" required />
              </div>
              <div class="group">
                <label>Réponse :  </label>
                <input type="text" name="reponse" class="form-control" required />
              </div>
              <input id="add-btn" type="submit" value="Ajouter" name="add-btn" />
            </form>
          </div>
        </div>
    </div>

<?php require_once "../app/views/footer/index.php"; ?>

</body>