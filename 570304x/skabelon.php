<?php 
// Herunder hentes toppen af siden. Den includer alle nødvendige filer i header. alt indenfor de to head tegn er her.
require_once $_SERVER['DOCUMENT_ROOT']."/570904q/head.php";
// body open tag er med i ovenstående fil. 
require_once $_SERVER['DOCUMENT_ROOT']."/570904q/nav_plus_logo.php";
// Sørger for at jeg hurtigt kan smidde en status besked ind på siden.
require_once $_SERVER['DOCUMENT_ROOT']."/570904q/status.php";
// Her hentes indholdet af siden
require_once $_SERVER['DOCUMENT_ROOT']."/".$sidenssti.$indhold;
// Her indsættes bunden af siden.
require_once $_SERVER['DOCUMENT_ROOT']."/570904q/foot.php";
?>