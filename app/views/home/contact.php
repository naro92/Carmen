<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>FAQ</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/contact.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
          <link rel="stylesheet" href="<?php echo ROOT_PATH .
            "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

<?php load_header("/header/index", [
  "button" => ucfirst($data["dashboard"]),
  "link" => ROOT_PATH . "/" . $data["dashboard"],
]); ?>
  
  <h1>Contact :</h1>

  <div class="mail-container">
  <form method="POST"> 
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="message">Message :</label>
        <textarea name="message" id="message" rows="5" required></textarea>
        <br>
        <input id="submit-btn" type="submit" value="Envoyer">
    </form>
  </body>

  </div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>