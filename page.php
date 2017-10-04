<?php 
// copyright Jørn Jespersen - guld-berg.dk
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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $get_page_name = htmlspecialchars($_GET["id"]);
    try {
        include($_SERVER['DOCUMENT_ROOT']."/REPLACE_ME_PATH/571204m/m530199c.php");
        $stmt = $conn->prepare("SELECT * FROM ReplaceDBtext WHERE page_name = ? AND language = ? AND required = 0");
        $stmt->execute(array($get_page_name, $_SESSION['session_language']));
        if ($stmt->rowCount() == 1) {
            foreach($stmt->fetchAll() as $row) {
                $date_from_db_page_name = $row['page_name'];
                $date_from_db_page_text = $row['text'];
            }
        }
        else {
            $date_from_db_page_text = "Page not found";
            header('Location: /REPLACE_ME_PATH/index');
        }
    }
    catch(PDOException $e) {
        $date_from_db_page_text = "Error";
        header('Location: /REPLACE_ME_PATH/index');
    }
    $stmt = null;
    $conn = null;
}
$sidenavn = $date_from_db_page_name; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
$sidenssti = "571304n/page"; // Dette er stien til hvor filerne ligger
$overmodul = "/overmodul.php"; // Dette er overmodulet, det jeg kalder for behandlingsfiler
$indhold = "/indhold.php"; // Her er filnavnet på indholdet af den pågældene side. 
//$sidenspecialescript = "/forsidescript.php";
// Her hentes skarbelonen til hele siden, og siden bliver printet til skærmen. 
require_once $_SERVER['DOCUMENT_ROOT']. "/REPLACE_ME_PATH/570304x/skabelon.php"; //
?>