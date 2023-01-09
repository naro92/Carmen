<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Chambres</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/chambres.css.css"; ?>" />
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
      <div id="liste-1etage">
        <div class="chambre01">
          <div class="chambre-label">101</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre02">
          <div class="chambre-label">102</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre03">
          <div class="chambre-label">103</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre04">
          <div class="chambre-label">104</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre05">
          <div class="chambre-label">105</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre06">
          <div class="chambre-label">106</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre07">
          <div class="chambre-label">107</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre08">
          <div class="chambre-label">108</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre09">
          <div class="chambre-label">109</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
      </div>
      <div id="liste-2etage">
        <div class="chambre01">
          <div class="chambre-label">201</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre02">
          <div class="chambre-label">202</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre03">
          <div class="chambre-label">203</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre04">
          <div class="chambre-label">204</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre05">
          <div class="chambre-label">205</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre06">
          <div class="chambre-label">206</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre07">
          <div class="chambre-label">207</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre08">
          <div class="chambre-label">208</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre09">
          <div class="chambre-label">209</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
      </div>
      <div id="liste-3etage">
        <div class="chambre01">
          <div class="chambre-label">301</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre02">
          <div class="chambre-label">302</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre03">
          <div class="chambre-label">303</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre04">
          <div class="chambre-label">304</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre05">
          <div class="chambre-label">305</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre06">
          <div class="chambre-label">306</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre07">
          <div class="chambre-label">307</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre08">
          <div class="chambre-label">308</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre09">
          <div class="chambre-label">309</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
      </div>
      <div id="liste-4etage">
        <div class="chambre01">
          <div class="chambre-label">401</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre02">
          <div class="chambre-label">402</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre03">
          <div class="chambre-label">403</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre04">
          <div class="chambre-label">404</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre05">
          <div class="chambre-label">405</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre06">
          <div class="chambre-label">406</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre07">
          <div class="chambre-label">407</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre08">
          <div class="chambre-label">408</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
        <div class="chambre09">
          <div class="chambre-label">409</div>
          <div class="chambre_image">
            <img src="assets/lit_vide.png" alt="lit_vide" class="lit_vide" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "../app/views/footer/index.php"; ?>

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