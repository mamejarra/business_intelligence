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
<?php
include('db_connect.php');

if(isset($POST ['Go'])){
    foreach($adresse as $key => $value){
        $result = $db->prepare("insert into adresseko (adresseok, libelle) VALUES (:adresseok, :libelle)");
        $result->binvalue(':adresseok', $_POST["c.$key"], PDO::PARAM_INT);
        $result->binvalue('libelle', $_POST["v.$key"], PDO::PARAM_STR);
        $result->execute();
    }
echo 'ok';
}


    echo '<form action="adressego.php" method="post">';
    
    $adresse = $model->get("etudiant", "", "Adresse", "Adresse");
     //echo '<select name="Adresse">';
    foreach ($adresse as $key => $value) {?>
        <input type ="text" name="v<?=$key?>" value="<?= $value["Adresse"]?>" readonly>
        <select name="c<?=$key?>">
        <?php 

        $recup = $model->get("adresseok", "", "libelle");
    
        foreach ($recup as $value) { print '<option value="'.$value["id"].'">'.$value["libelle"].'</option>';}?>
            
            </select><br>
            <?php       
        
    }

    echo '<input type="submit" value="Go">';
    echo "</form>";

 ?>