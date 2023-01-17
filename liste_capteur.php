<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="gestion_capteur.css">
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
<div class="btn_container">
<a href="gestion_capteur.php">retour</a>
</div>
<div class="main_container">
	<div class="title_container">
		<h1>liste des capteurs</h1>
	</div>
	<div class="main">
        <?php 
              include("read.php");
              ?>
		<table id="table_gestion">
    <thead>
      <tr>
        <th>ID</th>
        <th>type</th>
        <th>chambre_numero</th>
        <th>valeur_donnees</th>
        <th>date_mesures</th>
        <th>medecin_idmedecin</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
      ?>
      <tr>
        <td><?php echo htmlspecialchars($row['idcapteurs']); ?></td>
        <td><?php echo htmlspecialchars($row['type']); ?></td>
        <td><?php echo htmlspecialchars($row['chambre_numero']); ?></td>
        <td ><?php echo htmlspecialchars($row['valeur_donnees']); ?></td>
        <td><?php echo htmlspecialchars($row['date_mesures']); ?></td>
        <td><?php echo htmlspecialchars($row['medecin_idmedecin']); ?></td>
        <td><div class="btn_container"><a href="supprimer.php?id=<?php echo $row['idcapteurs'];?>">Supprimer</a></div></td>
    </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
	</div>
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
</html>