<?php
$telefonos = isset($_POST["i_phones"]) ? trim($_POST["i_phones"]): null;
$companias = isset($_POST["i_companies"]) ? mb_strtoupper(trim($_POST["i_companies"]), 'UTF-8') : null;

$telefonos = array($telefonos);
$companias = array($companias);
$sqlPhones = "";
for($i = 0; $i < count($telefonos); ++$i){
    $telefono = str_replace('"', "'", $telefonos[$i]);
    $compania = str_replace('"', "'", $companias[$i]);
    $sqlPhones = $sqlPhones . "INSERT INTO telefonos VALUES(0, $telefono, $compania);";

    echo "<h2> $telefono </h2>";
}

?>
