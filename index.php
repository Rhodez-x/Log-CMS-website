<?php 
// copyright Jørn Jespersen - guld-berg.dk
$loginsidelevel = 0; // sidens login level 0 for ikke at skulle være logget ind og 1 for at skulle være logget ind. 
$sidenavn = "Index"; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
$sidenssti = "571304n/index"; // Dette er stien til hvor filerne ligger
$overmodul = "/overmodul.php"; // Dette er overmodulet, det jeg kalder for behandlingsfiler
$indhold = "/indhold.php"; // Her er filnavnet på indholdet af den pågældene side. 
//$sidenspecialescript = "/forsidescript.php";
// Her hentes skarbelonen til hele siden, og siden bliver printet til skærmen. 
require_once $_SERVER['DOCUMENT_ROOT']. "/REPLACE_ME_PATH/570304x/skabelon.php"; //
?>