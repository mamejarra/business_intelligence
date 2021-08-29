<?php
// Importation de la connexion à la base de données
include('db_connect.php');

// GET

// Tableau des valeurs
if ($_GET['genre'] == "f") {
  $arrayP = array("Fatou","Diarra","Maimouna","Selbe","Rocky","Ata","Fanta","Dieynaba","Saly","Marie","Khady","Ndeye","Faty");
} elseif($_GET['genre'] == "m") {
  $arrayP = array("Samba","Waren","Elhadj","Habib","Diockel","Demba","Mamadou","Boubacar","Ibrahima","Issa","Moussa");
}

$arrayN = array("Gaye","Fall","Diop","Diaw","Preira","Ndiaye","Fall","Diao","Ndiaye","Diouf","Ndiay","Gay");
$arrayA = array("Dakar","Dk","Dkr","Dkar","Dakr","Dkk","Rufisque","Rfisqu","Rufsq","Rfq","Louga","Loug","Lg","Thies","Ths","Th","Ties","Guediawaye","Guediaway");
$arrayE = array("test@estim.sn","test1@estim.sn","test2@estim.sn","test7@estim.sn");
$arrayT = array("773553627","776541928","782107235","782797235","769707235");

if ($_GET['genre'] == "f") {
 $arrayS = array("F","Feminin","Feminain","Femme","Famme","Fame","Fam");
} elseif ($_GET['genre'] == "m") {
 $arrayS = array("M","Masculin","Maculin","Homme","Home","H","Homm","Hom","Haum");
}

$arrayF = array("Informatique","Reseau");
$arrayNi = array("L1","MASTER2","licence1","master 2","L2","licence 2","L3","M1","master 1","M2");
$arrayD = array("12/10/2000","13/11/1999","13/12/1999","10/11/1999");
$arrayC = array("456789876676545","987633567266653","670876545694567");

/* Exécution de l'insertion */
if(isset($_GET['exec']) == 1){
  if(empty($_GET['nbEtudiant'])){
    $retour = "<p class=\"alert alert-danger animated fadein\" role=\"alert\">Merci de remplir les champs vides</p>";
  } else {

    for($i=0; $i < $_GET['nbEtudiant']; $i++) {

        $prenom = $arrayP[array_rand($arrayP)];
        $nom = $arrayN[array_rand($arrayN)];
        $adresse = addslashes($arrayA[array_rand($arrayA)]);
        $email = $arrayE[array_rand($arrayE)];
        $tel = $arrayT[array_rand($arrayT)];
        $sexe = $arrayS[array_rand($arrayS)];
        $fil = $arrayF[array_rand($arrayF)];
        $niv = $arrayNi[array_rand($arrayNi)];
        $date = $arrayD[array_rand($arrayD)];
        $cni = $arrayC[array_rand($arrayC)];

        $sql_register = $db->prepare("INSERT INTO etudiant (Prenom, Nom, Adresse, Email, Tel, Sexe, Filiere, Niveau, Date, CI)
                                           VALUES (:Prenom, :Nom, :Adresse, :Email, :Tel, :Sexe, :Filiere, :Niveau, :Date, :CI)");
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

    }

    if($_GET['nbEtudiant'] > 1) {
      $retour = "<p class=\"alert alert-success animated fadein\" role=\"alert\"><b>".$_GET['nbEtudiant']."</b> étudiants ont bien été insérés dans la base de données</p>";
    } else {
      $retour = "<p class=\"alert alert-success animated fadein\" role=\"alert\">Un étudiant a bien été inséré dans la base de données</p>";
    }
  }

 }

 ?>

<head>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta charset="utf-8" content="">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <title>Insérer automatiquement des données</title>
  <style media="screen">
          body{
            background:#81BEF7;
          }
          #box{
            background:white;
            margin-top:45px;
            padding:20px;
            border-radius:6px;
          }
          #title{
             padding-bottom:8px;font-size:25px;border-bottom:2px dashed #81BEF7
          }
          ::-webkit-scrollbar{width:7px;height:7px;background:transparent;position:fixed;}
          ::-webkit-scrollbar-thumb{background:rgba(0,0,0,0.5);border-radius:20px;}
  </style>
 </head>

  <div id="box" class="container">
    <div class="card mt-5">

     <form>

           <p id="title">Inserer des données automatiquement dans la base de données</p> <br>

           <?php if(isset($retour)){ echo $retour; } ?>

           <div class="form-group">
               <label for="nbns">Nombre d'etudiants à inserer:</label>
               <input type="text" class="form-control" id="nbns" name="nbEtudiant" placeholder="Saisir un nombre d'etudiant à inserer" required>
           </div>


               <input type="hidden" class="form-control" id="nbns" name="exec" value="1">


          <div class="form-group">
             <label for="sexe">Le genre des étuditants à insérer:</label>
             <select id="sexe" class="form-control" name="genre">
               <option value="m">Homme</option>
               <option value="f">Femme</option>
             </select>
          </div>

       <input type="submit" class="btn btn-primary" value="Exécuter l'insertion">
       OU
       <a class="btn btn-warning"  href="/business_intelligence">Revenir sur la page d'insertion manuelle</a>
     </form>


  </div>
</div>
