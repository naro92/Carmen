<?php

$test_nom = FALSE;
$test_prenom = FALSE;
$test_email = FALSE;
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bdd', 'root', 'root');
}
catch (Exception $e)
{
//en cas d'erreur on affiche un message et on arrete tout
    die('Erreur : ' . $e->getMessage());
}

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];

$prenom = ucwords($prenom);
$nom =ucwords($nom);

if(empty($prenom) == FALSE){
   $test_prenom = TRUE;
}
if(empty($nom) == FALSE){
    $test_nom = TRUE;
 }
if(empty($email) == FALSE){
    $test_email = TRUE;
 }
 
 if($test_prenom == TRUE and $test_nom == FALSE and $test_email == False){
    $sql = 'SELECT * from patients WHERE prenom like ?';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$prenom]);
}
else if($test_prenom == FALSE and $test_nom == TRUE and $test_email == False){
    $sql = 'SELECT * from patients WHERE nom like ?';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom]);
}
else if($test_prenom == FALSE and $test_nom == FALSE and $test_email == TRUE){
    $sql = 'SELECT * from patients WHERE mail like ?';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$email]);
}
else if($test_prenom == TRUE and $test_nom == TRUE and $test_email == False){
    $sql = 'SELECT * from patients WHERE (prenom like ? and nom like ?)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$prenom,$nom]);
}
else if($test_prenom == TRUE and $test_nom == FALSE and $test_email == TRUE){
    $sql = 'SELECT * from patients WHERE (prenom like ? and mail like ?)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$prenom,$email]);
}
else if($test_prenom == FALSE and $test_nom == TRUE and $test_email == TRUE){
    $sql = 'SELECT * from patients WHERE (nom like ? and mail like ?)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom,$email]);
}
else if ($test_prenom == TRUE and $test_nom == TRUE and $test_email == TRUE){
    $sql = 'SELECT * from patients WHERE (prenom like ? and nom like ? and mail like ?)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$prenom,$nom,$email]);
}
else{
    echo 'veuillez remplir des champs';
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="afficher_recherche.css">
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
<div class = "btn_retour">
	<a href=".\rechercher_patient.php">&#10229 Retour</a>
</div>
<div class="title_container">
    <h1>Résultat de votre recherche<h1>
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

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
      ?>
      <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['prenom']); ?></td>
        <td><?php echo htmlspecialchars($row['nom']); ?></td>
        <td id="case_mail"><?php echo htmlspecialchars($row['mail']); ?></td>
        <td><div class="btn_container"><a href="ajouterpatient.php?id=<?php echo $row['id'];?>">ajouter</a></div></td>
    </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
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