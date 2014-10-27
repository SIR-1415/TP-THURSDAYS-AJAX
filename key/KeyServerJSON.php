<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include_once 'KeyGen.php';
$kg = new CKeyGen();
echo $kg->Key2JSON();
?>
