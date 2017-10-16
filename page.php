<?php 
// copyright Jørn Jespersen - guld-berg.dk
define('SITE_ROOT_PATH', $_SERVER['DOCUMENT_ROOT']); // Root path for the site, add /path if the site is in another directory. NO ENDING "/ "
$loginsidelevel = 0; // sidens login level 0 for ikke at skulle være logget ind og 1 for at skulle være logget ind. 
/*
Special page which loads ALL content from the db. 
The page name is dependent of the GET var id
*/

// This can be the first page the client request, therefore it is not sure that the lang has been set. we check here
session_start();
$session_is_started = true;

if (!$_SESSION['session_language']) {       
    $_SESSION['session_language'] = "DK";
}

$web_page_name = $date_from_db_page_name; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
$sidenssti = "571304n/page"; // Dette er stien til hvor filerne ligger
$overmodul = "/overmodul.php"; // Dette er overmodulet, det jeg kalder for behandlingsfiler
$indhold = "/indhold.php"; // Her er filnavnet på indholdet af den pågældene side. 
//$sidenspecialescript = "/forsidescript.php";
// Her hentes skarbelonen til hele siden, og siden bliver printet til skærmen. 
require_once SITE_ROOT_PATH. "/570304x/skabelon.php"; //
?>