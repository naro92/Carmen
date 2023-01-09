<?php
 try
 {
     $bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', 'root');
 }
 catch (Exception $e)
 {
//en cas d'erreur on affiche un message et on arrete tout
     die('Erreur : ' . $e->getMessage());
 }
$date = $_GET["date"];
$sql = 'SELECT texte_rapport from rapport WHERE date_rapport = ?';
$stmt = $bdd->prepare($sql);
$stmt->execute([$date]);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="afficher_bilan.css">
    <title>Votre bilan</title>
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
</body>
</html>
<div class="btn_retour">
<a href="voir_bilan_patient.php">&larr; Mes Bilans</a>
</div>
<div class = "main">
<table id="table_bilan">
    <thead>
      <tr>
      </tr>
    </thead>
    <tbody>
      <?php 
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
      ?>
      <tr>
        <td ><?php echo htmlspecialchars($row['texte_rapport']); ?></td>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<div class="footer-section">
      <!-- Section -->
      <hr/>
      <div class="footer-container">
        <a class="item-footer" href="#contact">Contact</a>
        <a class="item-footer" href="#cgu">
          Conditions générales d'utilisations</a>
        <a class="item-footer" href="#faq">FAQ</a>
      </div>
    </div>


