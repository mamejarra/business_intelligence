<?php
session_start();
require_once "outils.php";
include('Model.php');
$n = count(post()) / 2;

$tab = [];
for ($i=0; $i < $n; $i++) { 
    $tab[$i] = [
        "libelle" => post("v$i"),
        "sexe_ok" => post("c$i")
    ];
}

$result = $model->insertS("sexe_ko", $tab);
if($result)
    $_SESSION["message"] = okOb("set sexe ok avec succès");
else
    $_SESSION["message"] = noticeOb("set sexe ok sans succès");

redirect("index.php?done"); //redirect("index.php");
//echo '<p><a href="index.php?param1=pape&param2=mboup;">Retour à l\'accueil</a></p>';
?>


