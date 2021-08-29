<?php
$host = "127.0.0.1";
$port = "3306";
$user = "root";
$pass = "";
$database = "info_decisionnelle";

try {
 // on se connecte à la base de données en PDO-PHP
 $db = new PDO('mysql:host='.$host.';
                       port='.$port.';
                       dbname='.$database, $user, $pass
                     );
 // on demande de vraies requêtes préparées au serveur et non des requêtes préparées émulées
 $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

 } catch (Exception $e) {

 die('<p style=\"font:14px calibri;\">La connexion à la base de donnée est impossible </p> ' . $e->getMessage());

 }

 ?>
