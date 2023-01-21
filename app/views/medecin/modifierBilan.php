<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Choix</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/ecrire_bilan.css"; ?>" />
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
      <a href="<?php echo ROOT_PATH .
        "/medecin/bilans/" .
        $data["idPatient"]; ?>"> &#10229 Retour</a>
    </div>

    <div class="main_container">
	    <p id="p_error"><?php echo $data["error"]; ?></p>
        <form action="<?php echo "/public/medecin/modifierBilan/" .
          $data["idPatient"]; ?>" id="form_bilan" method="post">
          <input type="hidden" name="id" value="<?php echo $data[
            "idRapport"
          ]; ?>" />
            <textarea name="bilan" id="bilan"><?php print_r(
              $data["text"]
            ); ?></textarea>
            <input type="submit" id="btn_submit" name="submit-btn" value="Envoyer" onclick = "return check()">
        </form>
    </div>


    <?php require_once "../app/views/footer/index.php"; ?>

    <script src="<?php echo ROOT_PATH . "/js/fonctions.js"; ?>"></script>
</body>