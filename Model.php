<?php

class Model {
  
  private $host = "127.0.0.1";
  private $port = "3306";
  private $user = "root";
  private $pass = "";
  private $database = "info_decisionnelle";
  private $db;

  public function __construct(){ // Model()
    try {
    // on se connecte à la base de données en PDO-PHP
    $this->db = new PDO('mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->database, $this->user, $this->pass);

    // on demande de vraies requêtes préparées au serveur et non des requêtes préparées émulées
    $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    } catch (Exception $e) {

    die('<p style=\"font:14px calibri;\">La connexion à la base de donnée est impossible </p> ' . $e->getMessage());

    }
  }
  //get("adresse", "adresse")
  //get("adresse")
  public function get0($table, $order = "", $distinct = ""){
    $distinct = ($distinct) ? " distinct $distinct, id" : " *";
    $order = ($order != "") ? " order by $order" : ""; //ternary ternaire
    
    $result = $this->db->prepare("select$distinct from $table$order");    
    $result->execute();
    $tab = $result->fetchAll(); $result->closeCursor();
    return $tab;
  }
  //SELECT DISTINCT Adresse from etudiant order by Adresse
  public function get($table, $where = "", $order = "", $distinct = ""){
   
    $where = ($where != "") ? " where $where" : ""; //ternary ternaire
    $order = ($order != "") ? " order by $order" : ""; //ternary ternaire
    $select = ($distinct == "") ? " *" : " distinct $distinct"; //ternary ternaire

    $result = $this->db->prepare("select$select from $table$where$order");    
    $result->execute();
    $tab = $result->fetchAll(); $result->closeCursor();
    return $tab;
  }
  public function get2($table, $where = "", $order = "", $distinct = "") 
  { 
    $tab = $this->get($table, $where, $order, $distinct);
    $n = count($tab);
    for ($i=0; $i < $n ; $i++) { 
      $m = count($tab[$i]) / 2;
      for ($j=0; $j < $m; $j++) { 
          unset($tab[$i][$j]);
      }
    }
    return $tab;
  } 
  public function getWithTransform($table, $transAssArr, 
  // ["Adresse"=>["adresse_ok", "adresse_ko"]]
                      $where = "", $order = "", $distinct = ""){
    $tab = $this->get2($table, $where, $order, $distinct);
    foreach ($tab as $key => $value) {
      foreach ($transAssArr as $field => $transArr) {
        $str = $value[$field]; //l'ancienne adresse tq dkr  
        if( ! empty($field) && ! empty($transArr) )
          $tab[$key][$field] = $this->transforme($str, $transArr[0], $transArr[1]);
      }
    }
    return $tab;
  }
  // array(
  //  "adresse_ok"=>1,
  //  "libelle" => "Dk"
  // )
  function insert($table, $valuesAssArray){
    $fields = array_keys($valuesAssArray); //[adresse_ok, libelle]
    $fields1 = implode(", ",$fields); // adresse_ok, libelle
    $fields2 = ":".implode(", :",$fields); //:adresse_ok, :libelle
    $result = $this->db->prepare("insert into $table ($fields1) values ($fields2)");
    $rest = $result->execute($valuesAssArray);
    $result->closeCursor();
    return $rest;
  }
  function insertS($table, $arrayOfAssArray){
    $rest = true;
    foreach ($arrayOfAssArray as $array) {
      $rest = $rest && $this->insert($table, $array);
    }
    return $rest;
  }
  function tableEtudiant($annee){
    $sql = "CREATE TABLE IF NOT EXISTS `etudiant$annee` (
      `ID` int(11) NOT NULL AUTO_INCREMENT,
      `Prenom` varchar(100) NOT NULL,
      `Nom` varchar(100) NOT NULL,
      `Adresse` varchar(100) CHARACTER SET utf8 NOT NULL,
      `Email` varchar(100) NOT NULL,
      `Tel` varchar(100) NOT NULL,
      `Sexe` varchar(100) NOT NULL,
      `Filiere` varchar(100) NOT NULL,
      `Niveau` varchar(100) NOT NULL,
      `Date` varchar(100) NOT NULL,
      `CI` varchar(100) NOT NULL,
      PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
    ";
    $result = $this->db->prepare($sql);
    $result->execute();
    $result->closeCursor();

  }
  // function transforme($str){
  //   $id = $this->get("adresse_ko", "libelle = '$str'")[0]["adresse_ok"];
  //   return $this->get("adresse_ok", "id = '$id'")[0]["libelle"];
  // }

  /*function transforme($str, $tableOk = "adresse_ok", $tableKo = "adresse_ko"){
    if($str == "")
      return "Dakar";
    $id = $this->get($tableKo, "libelle = '$str'")[0][$tableOk];
    return $this->get($tableOk, "id = '$id'")[0]["libelle"];
  }*/
  function transforme($str, $tableOk = "", $tableKo = "", $defaultVa="Dakar"){
    if($str == "")
      return "$defaultVa";
      $result=$this->get($tableKo, "libelle = '$str'");
      if(!empty($result)){
        $id= $result[0][$tableOk];
        $result2=$this->get($tableOk, "id = '$id'");
        if(!empty($result2))
        return $result2[0]["libelle"];
      }
      notice("Aucune correspondance pour <br>$str</br>. verifier <b> $tableOk</b> et 
      <b>$tableKo</b> Rmq la valeur retourner est <b>$defaultVa par defaut </b>.".br(2));
      return $defaultVa;
  }
}
$model = new Model(); 

 ?>
