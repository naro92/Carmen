<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>FAQ</title>
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
  "button" => ucfirst($data["dashboard"]),
  "link" => ROOT_PATH . "/" . $data["dashboard"],
]); ?>
  <h1>Foire aux questions</h1>
  <p class="description-faq">Une question, un souci ?<br/> Peut être que les réponses à celles-ci sont-ici :</p>
  <div class="question">
  <?php // print("<pre>".print_r($data['faq'],true)."</pre>");

foreach ($data["faq"]["questions"] as $row) {
    echo '<div class="question-container">';
    echo "<details>";
    echo "<summary>" . $row["titre"] . "</summary>";
    echo '<div class="faq__content">';
    echo "<p>" . $row["contenu"] . "</p>";
    echo "</div>";
    echo "</details>";
    echo "</div>";
  } ?>
  </div>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>