<?php 
// copyright Jørn Jespersen - guld-berg.dk
$loginsidelevel = 0; // sidens login level 0 for ikke at skulle være logget ind og 1 for at skulle være logget ind. 
/*
Special page which loads ALL content from the db. 
The page name is dependent of the GET var id
*/

$sidenssti = "571304n/page"; // Dette er stien til hvor filerne ligger
$overmodul = "/overmodul.php"; // Dette er overmodulet, det jeg kalder for behandlingsfiler
$indhold = "/indhold.php"; // Her er filnavnet på indholdet af den pågældene side. 
//$sidenspecialescript = "/forsidescript.php";
// Her hentes skarbelonen til hele siden, og siden bliver printet til skærmen. 
require_once $_SERVER['DOCUMENT_ROOT']. "/570304x/skabelon.php"; //
?>