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
//$id_patient = $_GET['idPatient']
$id_patient = 2;  //a passer en get lors de l'integration dans le mvc
$text = $_POST["bilan"];
$requete1 = 'SELECT idfamille from famille where patient_idpatient = ?';
$requete2 = 'SELECT medecin_idmedecin FROM patient where idpatient = ?';

$stmt1 = $bdd->prepare($requete1);
$stmt1->execute([$id_patient]);
$resultat = $stmt1->fetch();
$famille_idfamille = $resultat['idfamille'];


$stmt2 = $bdd->prepare($requete2);
$stmt2->execute([$id_patient]);
$resultat = $stmt2->fetch();
$patient_medecin_idmedecin = $resultat['medecin_idmedecin'];


$sql = 'INSERT INTO rapport (texte_rapport,famille_idfamille,patient_idpatient,patient_medecin_idmedecin) VALUES(:texte_rapport,:famille_idfamille,:patient_idpatient,:patient_medecin_idmedecin)';
$stmt = $bdd->prepare($sql);
$stmt->bindParam(":texte_rapport", $text, PDO::PARAM_STR);
$stmt->bindParam(":famille_idfamille", $famille_idfamille, PDO::PARAM_STR);
$stmt->bindParam(":patient_idpatient", $id_patient, PDO::PARAM_STR);
$stmt->bindParam(":patient_medecin_idmedecin", $patient_medecin_idmedecin, PDO::PARAM_STR);
$stmt->execute();
header('location: validation.php');

?>