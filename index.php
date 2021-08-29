<?php
session_start();
require_once "outils.php";
include('Model.php');

//sd($_GET);

$done = $_GET['done'];
if(!isset($done)){
  header('Location: ./index?done');
}
/* 
define("dakar", ["dakar", "dakr", "dk", "dkar", "dkk", "dkr"]);
define("eza", ["eza"]);
define("fatick", ["fatick", "fatigue", "fatik", "fk", "fka"]);
define("guediaway", ["guediaway", "guediawaye"]);
define("ziguinchor", ["j", "jiguinchore", "jiguinkor", "ziguinchor"]);
define("kedougou", ["kã©dugu", "kédugu", "kedougou"]);
define("kaffrine", ["kaffrine", "kafrine", "cafrine"]);
define("kolda", ["kolda"]);
define("louga", ["lg", "loug", "louga"]);
define("matam", ["matam", "matame", "mentam"]);
define("mbao", ["mbao"]);
define("ouestFoire", ["ouest foire"]);
define("pout", ["pout"]);
define("rufisque", ["rfisqu", "rfq", "rufisque", "rufsq"]);
define("saintLious", ["sainlious", "saintlui", "seinlouis", "stlouis", "st_louis"]);
define("tamba", ["tamba", "tambaquounda"]);
define("thies", ["hties", "th", "thies", "ths", "ties"]);
define("yoff", ["yoff"]);
define("féminin", ["f","fam","fame","famme","feminain","feminin","femme"]);
define("masculin", ["h","haum","hom","homm","homme","homme","m","masculin"]);
define("licence1", ["l1","licence 1"]);
define("licence2", ["l2","licence 2"]);
define("licence3", ["l3","licence 3"]);
define("master1", ["m1","master 1"]);
define("master2", ["m2","master 2"]);*/
//echo transforme("Dakr");
//see($model->transforme("Dkr")); 
//$str, $tableOk = "adresse_ok", $tableKo = "adresse_ko"
//see($etudiant20);
//see($etudiant20[0]['Adresse']);
//$model->transforme($etudiant20[0]['Adresse']);
// $etudiant20 = $model->get2("etudiant");
// see( $etudiant20 );


$transAssArr = [
    "Adresse" => ["adresse_ok", "adresse_ko"],
    "Sexe" => ["sexe_ok", "sexe_ko"],
    "Niveau" => ["niveau_ok", "niveau_ko"]
];


$etudiant20 = $model->getWithTransform("etudiant", $transAssArr);     
$model->insertS("etudiant2020", $etudiant20); 
    echo '<form action="setadresseko.php" method="post">';  
    $adresse = $model->get("etudiant", "", "Adresse", "Adresse");
    $adresseOk = $model->get("adresse_ok", "", "libelle"); 
    $model->tableEtudiant(2020);
    foreach ($adresse as $key => $value) {
        //echobr($key." => ".$value);?>
        <input type="text" name="v<?=$key?>"
            value="<?=$value["Adresse"]?>" readonly> <?php
        
        echo '<select name="c'.$key.'">';
            foreach ($adresseOk as $key => $value) {?>
                <option value="<?=$value["id"]?>"><?= $value["libelle"]?></option><?php       
            }
        echo '</select><br>';
    }
    echo '<input type="submit" value="Go">';
    echo "</form>";



//Formulaire pour insérer et faire la correspondance pour sexe
echo '<form action="setsexeko.php" method="post">';
$sexe = $model->get("etudiant", "", "Sexe", "Sexe");
$sexeok = $model->get("sexe_ok", "", "libelle");

$model->tableEtudiant(2020);
foreach ($sexe as $key => $value) {
    //echobr($key." => ".$value);?>
    <input type="text" name="v<?=$key?>"
        value="<?=$value["Sexe"]?>" readonly> <?php
    
    echo '<select name="c'.$key.'">';
        foreach ($sexeok as $key => $value) {?>
            <option value="<?=$value["id"]?>"><?= $value["libelle"]?></option><?php       
        }
    echo '</select><br>';
}
echo '<input type="submit" value="Go">';
echo "</form>";



//Formulaire pour insérer et faire la correspondance pour niveau
echo '<form action="niveauko.php" method="post">';
    
$niveau = $model->get("etudiant", "", "Niveau", "Niveau");
$niveauok = $model->get("niveau_ok", "", "libelle");

$model->tableEtudiant(2020);
foreach ($niveau as $key => $value) {
    //echobr($key." => ".$value);?>
    <input type="text" name="v<?=$key?>"
        value="<?=$value["Niveau"]?>" readonly> <?php
    
    echo '<select name="c'.$key.'">';
        foreach ($niveauok as $key => $value) {?>
            <option value="<?=$value["id"]?>"><?= $value["libelle"]?></option><?php       
        }
    echo '</select><br>';
}
echo '<input type="submit" value="Go">';
echo "</form>";



 ?>


<head>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <title>Informatique Decisionnelle</title>
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
<body>
<?php echo $_SESSION["message"]; $_SESSION["message"] = ""; ?>
  <div id="box" class="container">
    <div class="card mt-5">

    <form action="submit.php" method="post">
          <p id="title">Business Intelligence</p> <br>

          <?php if($done == 1){ ?>
               <p class="alert alert-success animated fadein" role="alert">Les données ont bien été sauvergardées dans la base de données</p>
              <?php } ?>

         <div class="form-group">
             <label for="pnom">Prénom:</label>
             <input type="text" class="form-control" id="pnom" name="prenom" placeholder="Entrer votre prénom" required>
         </div>
         <div class="form-group">
             <label for="nom">Nom:</label>
             <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer votre nom" required>
         </div>
         <div class="form-group">
             <label for="adr">Adresse:</label>
             <input type="text" class="form-control" id="adr" name="adresse" placeholder="Entrer votre adresse" required>
         </div>
         <div class="form-group">
             <label for="email">Email:</label>
             <input type="text" class="form-control" id="email" name="email" placeholder="Entrer votre email" required>
         </div>
         <div class="form-group">
             <label for="tel">Tel:</label>
             <input type="text" class="form-control" id="tel" name="tel" placeholder="Entrer votre tel" required>
         </div>
         <div class="form-group">
             <label for="sx">Sexe:</label>
             <input type="text" class="form-control" id="sx" name="sexe" placeholder="Entrer votre sexe" required>
         </div>
         <div class="form-group">
             <label for="fil">Filière:</label>
             <input type="text" class="form-control" id="fil" name="fil" placeholder="Entrer votre filière" required>
         </div>
         <div class="form-group">
             <label for="niv">Niveau:</label>
             <input type="text" class="form-control" id="niv" name="niv" placeholder="Entrer votre niveau" required>
         </div>
         <div class="form-group">
             <label for="date">Date:</label>
             <input type="text" class="form-control" id="date" name="date" placeholder="Entrer votre date de naissance" required>
         </div>

         <div class="form-group">
             <label for="nci">N° CI:</label>
             <input type="text" class="form-control" id="nci" name="ci" placeholder="Entrer votre numéro de carte d'identité" required>
         </div>
         <div class="form-group">
             <input type="submit" class="btn btn-primary" name="submit" value="Exécuter ce formulaire" placeholder="Entrer votre email"> OU
             <a class="btn btn-warning"  href="insert.php?genre">Inserer des données automatiquement</a>
         </div>

        </form>

  </div>
    
</body>
</div>
<br>
