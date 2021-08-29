<?php

function in($tofined, $tab){
    return in_array($tofined, $tab);
}

function echobr($str){
    echo $str."<br>";
}

function see($str){
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}
function sd($str){
    see($str);
    die;
}

function br($n){
    for($i=0;$i<$n;$i++)
        $br="<br>";
    return $br;
}/*
function transforme($str){
    if(in(mb_strtolower($str), dakar)) return "Dakar";
    // if(in(mb_strtolower($str), eza)) return "Eza"; 
    if(in(mb_strtolower($str), fatick)) return "Fatick"; 
    if(in(mb_strtolower($str), guediaway)) return "Guediawaye"; 
    if(in(mb_strtolower($str), ziguinchor)) return "Ziguinchor"; 
    if(in(mb_strtolower($str), kedougou)) return "Kedougou"; 
    if(in(mb_strtolower($str), kaffrine)) return "Kaffrine"; 
    if(in(mb_strtolower($str), kolda)) return "Kolda"; 
    if(in(mb_strtolower($str), louga)) return "Louga"; 
    if(in(mb_strtolower($str), matam)) return "Matam"; 
    if(in(mb_strtolower($str), mbao)) return "Mbao"; 
    if(in(mb_strtolower($str), ouestFoire)) return "Ouest Foire"; 
    if(in(mb_strtolower($str), pout)) return "Pout"; 
    if(in(mb_strtolower($str), rufisque)) return "Rufisque"; 
    if(in(mb_strtolower($str), saintLious)) return "Saint-Lious"; 
    if(in(mb_strtolower($str), tamba)) return "Tamba"; 
    if(in(mb_strtolower($str), thies)) return "Thies"; 
    if(in(mb_strtolower($str), yoff)) return "Yoff"; 
    if(in(mb_strtolower($str), féminin)) return "Féminin"; 
    if(in(mb_strtolower($str), masculin)) return "Masculin"; 
    if(in(mb_strtolower($str), licence1)) return "Licence 1"; 
    if(in(mb_strtolower($str), licence2)) return "Licence 2"; 
    if(in(mb_strtolower($str), licence3)) return "Licence 3";
    if(in(mb_strtolower($str), master1)) return "Master 1"; 
    if(in(mb_strtolower($str), master2)) return "Master 2"; 

    notice("pas de correspondance pou <b>$str</b>");

}*/
function notice($str){
    echo "<font color='red'>$str</font>";
}
function noticeOb($str){
    return "<font color='red'>$str</font>";
}
function ok($str){
    echo "<font color='green'>$str</font>";
}
function okOb($str){
    return "<font color='green'>$str</font>";
}
function redirect($str = "index.php"){
    header("Location: $str");
}

function post($field = ""){
    if($field)
        return $_POST["$field"];
    return $_POST;
}
 
