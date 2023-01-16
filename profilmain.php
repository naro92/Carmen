<?php
include('profil-aff.php');

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Carmen</title>
    <link rel="stylesheet" href="./style/profil.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>

  <body>
    <nav class="navBar">
      <div class="logo-container">
        <img src="./assets/logo.svg" />
        <a href="index.html">Carmen</a>
      </div>
      <ul class="nav-list" id="nav-list">
        <li class="list-item">
          <a href="#cgu">CGU</a>
        </li>
        <li class="list-item">
          <a href="#faq">FAQ</a>
        </li>
        <li class="list-item">
          <a href="#contact">Contact</a>
        </li>
        <li class="list-item">
          <a href="connection.html" class="button-connexion">Connexion</a>
        </li>
      </ul>
      <div class="menu" id="toggle-button" onclick="toggleNav()">
        <div class="menu-line-1"></div>
        <div class="menu-line-2"></div>
        <div class="menu-line-3"></div>
      </div>
    </nav>
      <div class="form-container">
        <div class="user">
        <img src="./assets/user.svg" />
       </div>

        <form class="form" action="profil.php" method="post">
          <div class="form-group">
          <?php $row = $coo->fetch(PDO::FETCH_ASSOC);
       ?>
            <input type="text" required pattern=".{4,}" title="Enter valid email address" name="nom" value="<?php echo htmlspecialchars($row['nom']); ?>"/>
              <label>Nom</label>
          </div>
          <div class="form-group">
            <input required type="text" pattern=".{4,}" title="Enter valid email address" name="code"value="<?php echo htmlspecialchars($row['prenom']); ?>"/>
              <label>Prénom</label>
          </div>
          <div class="form-group">
            <input required type="text" pattern=".{4,}" title="Enter valid email address" name="code"  value="<?php echo htmlspecialchars($row['nom']); ?>"/>
              <label>age</label>
          </div>
          <div class="form-group">
            <input required type="text" pattern=".{4,}" title="Enter valid email address" name="code"value="<?php echo htmlspecialchars($row['sexe']); ?>"/>
              <label>sexe</label>
          </div>
          <div class="form-group">
            <input type="text" required pattern="[0][0-9]{9}" title="Entrez un numéro de téléphone valide" name="phone"value="<?php echo htmlspecialchars($row['telephone']); ?>" />
              <label>Télephone</label>
          </div>
          <div class="form-group">
            <input type="text" required pattern=".{4,}" title="Enter valid email address" name="pwd"value="<?php echo htmlspecialchars($row['Adresse']); ?>" />
              <label>Adresse</label>
          </div>
          <div class="form-group">
            <input type="text" required pattern=".{4,}" title="Enter valid email address" name="vpwd"value="<?php echo htmlspecialchars($row['adresse_mail']); ?>" />
              <label>Adresse email</label>
          </div>
          <button type="submit" class="button-validate">
            Valider
          </button>
        </form>
        
      </div>

      
    <div class="footer-section">
      <!-- Section -->
      <hr />
      <div class="footer-container">
        <a class="item-footer" href="#contact">Contact</a>
        <a class="item-footer" href="#cgu">
          Conditions générales d'utilisations
        </a>
        <a class="item-footer" href="#faq">FAQ</a>
      </div>
    </div>
  </body>

<script>
    function toggleNav() {
      const burgerMenu = document.getElementById("toggle-button");
      const navListe = document.getElementById("nav-list");
      burgerMenu.classList.toggle("change");
      navListe.classList.toggle("active");
    }
    function hide2() {
  var x = document.getElementById("pwd2");
  var y = document.getElementById("images2");
  var v= y.getAttribute("src")
  if (x.type === "password") {
    x.type = "text";
    v = "./assets/eye-off.svg"
    y.setAttribute("src", v);
  } else {
    x.type = "password";
    v = "./assets/eye.svg";
    y.setAttribute("src", v);
  }
}
function hide() {
  var x = document.getElementById("pwd");
  var y = document.getElementById("images");
  var v= y.getAttribute("src")
  if (x.type === "password") {
    x.type = "text";
    v = "./assets/eye-off.svg";
    y.setAttribute("src", v);
  } else {
    x.type = "password";
    v = "./assets/eye.svg";
    y.setAttribute("src", v);
  }
}



</script>
</html>
