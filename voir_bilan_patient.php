<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="voir_bilan_patient.css">
	<title>Bilans</title>
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

<div class="main_container">
	
		<div class="btn_retour_container">
			<a href="acceuil patient.html">&larr; Acceuil</a>
		</div>
	    <div class="tableau_bilan">
        <table >
    <thead>
      <tr>
        <th id="case_date">Date</th>
        <th id="case_action">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      include('read_date_bilan.php');
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
      ?>
      <tr>
        <td><?php echo htmlspecialchars($row['date_rapport']); ?></td>
        <td id="case_action_td"><div class="btn_action"><a href="afficher_bilan.php?date=<?php echo $row['date_rapport'];?>">Voir</a></div></td>
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