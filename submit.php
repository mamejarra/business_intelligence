<?php
// Importation de la connexion à la base de données
include('db_connect.php');

/* Exécution de l'inscription */
if(isset($_POST['submit'])){

// Récupération des données utilisateur
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$adresse = $_POST['adresse'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sexe = $_POST['sexe'];
$fil = $_POST['fil'];
$niv = $_POST['niv'];
$date = $_POST['date'];
$cni = $_POST['ci'];

// On insère les informations de l'utilisateur dans la base de données
$sql_register = $db->prepare("INSERT INTO etudiant (Prenom, Nom, Adresse, Email, Tel, Sexe, Filiere, Niveau, Date, CI) VALUES (:Prenom, :Nom, :Adresse, :Email, :Tel, :Sexe, :Filiere, :Niveau, :Date, :CI)");
$sql_register->bindValue(':Prenom', $prenom, PDO::PARAM_STR);
$sql_register->bindValue(':Nom', $nom, PDO::PARAM_STR);
$sql_register->bindValue(':Adresse', $adresse, PDO::PARAM_STR);
$sql_register->bindValue(':Email', $email, PDO::PARAM_STR);
$sql_register->bindValue(':Tel', $tel, PDO::PARAM_STR);
$sql_register->bindValue(':Sexe', $sexe, PDO::PARAM_STR);
$sql_register->bindValue(':Filiere', $fil, PDO::PARAM_STR);
$sql_register->bindValue(':Niveau', $niv, PDO::PARAM_STR);
$sql_register->bindValue(':Date', $date, PDO::PARAM_STR);
$sql_register->bindValue(':CI', $cni, PDO::PARAM_STR);
$sql_register->execute();

header('Location: ./?done=1');
}

 ?>
