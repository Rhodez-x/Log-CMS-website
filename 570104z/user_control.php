<?php 
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/
$loginsidelevel = 5; // sidens login level 0 for ikke at skulle være logget ind og 1 for at skulle være logget ind. 
$web_page_name = "Indstillinger"; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
$sidenssti = "/570104z/contain/user_control"; // Dette er stien til hvor filerne ligger
$overmodul = "/overmodul.php"; // Dette er overmodulet, det jeg kalder for behandlingsfiler
$indhold = "/content.php"; // Her er filnavnet på indholdet af den pågældene side. 
$sidenspecialescript = "/script.php";
// Her hentes skarbelonen til hele siden, og siden bliver printet til skærmen. 
require_once $_SERVER['DOCUMENT_ROOT']. "/570304x/skabelon.php"; //
?>