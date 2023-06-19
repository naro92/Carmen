<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Chambres</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/chambres.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body onload="table(); updateData();">
  <?php load_header("/header/index", [
    "button" => "Deconnexion",
    "link" => "/public/connexion/deconnexion",
  ]); ?>

<script type="text/javascript">
      function table(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
          document.getElementById("chambres-container").innerHTML = this.responseText;
        }
        xhttp.open("GET", "/public/medecin/getDonneesChambres");
        xhttp.send();
        
      }

      function updateData(){
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/public/medecin/updateDonneesChambres");
        xhttp.send();
      }

      setInterval(function(){
        table();
        updateData();
      }, 3000);
</script>

<h1 class="title-chambres">Gestion des chambres</h1>

<div class="container" id="chambres-container">
  <?php
// print("<pre>".print_r($data['faq'],true)."</pre>");

// foreach ($data["chambres"]["capteurs"] as $row) {
//     if (in_array($row["numero"], $data["pasok"])) {
//       $pasok = "probleme";
//     } else {
//       $pasok = "ok";
//     }
//     echo '<div class="child ' . $pasok . '">';
//     echo "Chambre " . $row["numero"];
//     echo "</div>";
//   }
?>
</div>
  

  <?php require_once "../app/views/footer/index.php"; ?>


</body>