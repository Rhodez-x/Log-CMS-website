<?php 
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 4.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/

$loginsidelevel = 0; // sidens login level 0 for ikke at skulle være logget ind og 1 for at skulle være logget ind. 
$web_page_name = "Contact"; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
$sidenssti = "571304n/contact"; // Dette er stien til hvor filerne ligger
$overmodul = "/overmodul.php"; // Dette er overmodulet, det jeg kalder for behandlingsfiler
$indhold = "/indhold.php"; // Her er filnavnet på indholdet af den pågældene side. 
$sidenspecialescript = "/specialscript.php";
// Her hentes skarbelonen til hele siden, og siden bliver printet til skærmen. 
require_once $_SERVER['DOCUMENT_ROOT']. "/570304x/skabelon.php"; //
?>