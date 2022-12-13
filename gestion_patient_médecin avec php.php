<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="gestion_patient_médecin.css">
	<title>Carmen</title>
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
<div class = "btn_retour">
	<a href=".\acceuil medecin.html">	&#10229 Retour</a>
</div>
<div class="title_container">
<h1>Mes Patients</h1>
</div>
<div class="gestion_container">

<table id="table_gestion">
    <thead>
      <tr>
        <th>ID</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      include('read.php');
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
      ?>
      <tr>
        <td height='50'><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['prenom']); ?></td>
        <td><?php echo htmlspecialchars($row['nom']); ?></td>
        <td id="case_mail"><?php echo htmlspecialchars($row['mail']); ?></td>
        <td><div class="btn_container"><a href="supprimer.php?id=<?php echo $row['id'];?>">Supprimer</a></div></td>
    </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
      </div>
<div class="btn_gestion_container">
	<ul class="list_btn" id="list_btn">
		<li class="list_btn_att">
			<a href=".\ajouter_patient_medecin.php">Ajouter</a>
		</li>
		<li class="list_btn_att">
			<a href="#modifier">Modifier</a>
		</li>	
	
	</ul>

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