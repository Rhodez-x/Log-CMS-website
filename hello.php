<?php 
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 5.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/

$loginsidelevel = 0; // sidens login level 0 for ikke at skulle være logget ind og 1 for at skulle være logget ind. 
$web_page_name = "Hello"; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
$sidenssti = "content/hello"; // Dette er stien til hvor filerne ligger
$overmodule = "/overmodule.php"; // Dette er overmoduleet, det jeg kalder for behandlingsfiler
$content = "/content.php"; // Her er filnavnet på contentet af den pågældene side. 
//$sidenspecialescript = "/forsidescript.php";
// Her hentes skarbelonen til hele siden, og siden bliver printet til skærmen. 
require_once $_SERVER['DOCUMENT_ROOT']. "/core/unite_includes.php"; 
?>
