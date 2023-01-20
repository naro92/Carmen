
<head>
        <title>Chambres</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="chambres.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
  <div class="header-container">
    <h1 class="title">Gestion des Lits</h1>
  </div>
  <div class="index-chambres">
    <div class="choix-etages">
      <div id="1e-etage-btn">1e étage</div>
      <div id="2e-etage-btn">2e étage</div>
      <div id="3e-etage-btn">3e étage</div>
      <div id="4e-etage-btn">4e étage</div>
    </div>
    <div class="liste-chambres">
      
      <?php
      try {
        $db = new PDO('mysql:host=127.0.0.1;port=3307;dbname=carmen', 'root', '');
        $stmt = $db->prepare("SELECT * FROM chambres WHERE id LIKE ?");
        for ($i = 1; $i <= 4; $i++) {
          $id = $i . "%";
          $stmt->execute([$id]);
          $data = $stmt -> fetchAll();

          echo '<div id="liste-' . $i . 'etage">';

          foreach($data as $row) {
            echo '<div class="chambre0' . $row['id'] - 100*$i . '">
            <div class="chambre-label">' . $row['id'] . '</div>
            <div class="chambre_image">
              <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
            </div>
            </div>';
          }

          echo '</div>';
        }
      }
      catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }

      ?>
    </div>
  </div>



  <script>
    const firstList = document.getElementById("liste-1etage");
    const secondList = document.getElementById("liste-2etage");
    const thirdList = document.getElementById("liste-3etage");
    const fourthList = document.getElementById("liste-4etage");
    const firstbtn = document.getElementById("1e-etage-btn");
    const secondbtn = document.getElementById("2e-etage-btn");
    const thirdbtn = document.getElementById("3e-etage-btn");
    const fourthbtn = document.getElementById("4e-etage-btn");

    firstbtn.onclick = function () {
      console.log("clicked first");
      firstList.style.display = "flex";
      secondList.style.display = "none";
      thirdList.style.display = "none";
      fourthList.style.display = "none";

      firstbtn.style.color = "white";
      secondbtn.style.color = "black";
      thirdbtn.style.color = "black";
      fourthbtn.style.color = "black";

      firstbtn.style.backgroundColor = "rgb(174, 226, 96)";
      secondbtn.style.backgroundColor = "rgb(222, 237, 199)";
      thirdbtn.style.backgroundColor = "rgb(222, 237, 199)";
      fourthbtn.style.backgroundColor = "rgb(222, 237, 199)";
    };
    secondbtn.onclick = function () {
      firstList.style.display = "none";
      secondList.style.display = "flex";
      thirdList.style.display = "none";
      fourthList.style.display = "none";

      firstbtn.style.color = "black";
      secondbtn.style.color = "white";
      thirdbtn.style.color = "black";
      fourthbtn.style.color = "black";

      secondbtn.style.backgroundColor = "rgb(174, 226, 96)";
      firstbtn.style.backgroundColor = "rgb(222, 237, 199)";
      thirdbtn.style.backgroundColor = "rgb(222, 237, 199)";
      fourthbtn.style.backgroundColor = "rgb(222, 237, 199)";
    };
    thirdbtn.onclick = function () {
      firstList.style.display = "none";
      secondList.style.display = "none";
      thirdList.style.display = "flex";
      fourthList.style.display = "none";

      firstbtn.style.color = "black";
      secondbtn.style.color = "black";
      thirdbtn.style.color = "white";
      fourthbtn.style.color = "black";

      thirdbtn.style.backgroundColor = "rgb(174, 226, 96)";
      firstbtn.style.backgroundColor = "rgb(222, 237, 199)";
      secondbtn.style.backgroundColor = "rgb(222, 237, 199)";
      fourthbtn.style.backgroundColor = "rgb(222, 237, 199)";
    };
    fourthbtn.onclick = function () {
      firstList.style.display = "none";
      secondList.style.display = "none";
      thirdList.style.display = "none";
      fourthList.style.display = "flex";

      firstbtn.style.color = "black";
      secondbtn.style.color = "black";
      thirdbtn.style.color = "black";
      fourthbtn.style.color = "white";

      fourthbtn.style.backgroundColor = "rgb(174, 226, 96)";
      firstbtn.style.backgroundColor = "rgb(222, 237, 199)";
      secondbtn.style.backgroundColor = "rgb(222, 237, 199)";
      thirdbtn.style.backgroundColor = "rgb(222, 237, 199)";
    };
  </script>
</body>