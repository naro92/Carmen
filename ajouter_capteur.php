<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="ajouter_capteur.css">
	<title></title>
</head>
<body>
<div class = "bandeau">
		<div class="logo-container">
           <img src="logo.png" />
           <a href="#">Carmen</a>
        </div>
        <ul class="nav-list" id="nav-list">
        <li class="list-item">
          <a href="#cgu">CGU</a>
        </li>
        <li class="list-item">
          <a href="#faq">Contacts</a>
        </li>
        <li class="list-item">
          <a href="#contact">Déconnexion</a>
        </li>
      </ul>
	</div>
<div class="main">
<h1>Ajouter un capteur</h1>
<form action = "ajouter.php" method ="post">
    <label>Type</label>
 	<select name="select_type">
 		<option value ="thermique">Thermique</option>
 		<option value="cardiaque">Cardiaque</option>
 	</select><br>
 	<label>Chambre</label>
 	<input type="text" name="chambre"><br>
 	<label>id_medecin</label>
 	<input type="text" name="id_medecin"><br>
    <input type="submit" value="ajouter">
</form>
</div>
</body>
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
</html>