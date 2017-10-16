<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/

session_start();
// Her indstilles tidindstillingerne på siden
date_default_timezone_set("Europe/Copenhagen");
define(DATE_AND_TIME, date('Y-m-d H:i:s'));
define(DATE_WITHOUT_TIME, date('Y-m-d'));


function get_db_connection($host, $dbname, $user, $pass) {
    $conn = new PDO('mysql: host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function clean_input_text($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = addslashes($data);
   return $data;
}

function username_check($username_check) {
    $username_check = rtrim($username_check, ' ');
    $username_check = stripslashes($username_check);
    $username_check = htmlspecialchars($username_check);
    $username_check = strtolower($username_check);
    $username_check = addslashes($username_check);

    return $username_check;
    
}

function password_crypt($password_crypt, $username_check) {
    // Denne tager passwordet ind og cryptere det, så det kan tjekkes i DB.
    $b1 = "03q2d4qwd%?1234Ejoe324>";
    $b2 = "233244?][qwrqwqeqwew";
    $b3 = "¤SDFWwdfsdgdf.,wrsdv{}2";
    $password_crypt = stripslashes($password_crypt);
    $password_crypt = htmlspecialchars($password_crypt);
    $feedback = hash('sha256', $b2.$username_check.$b3.$password_crypt.$b1);
    
    return $feedback;
}

include SITE_ROOT_PATH."/570304x/site_settings.php";

//siden titel
$web_page_title = GLOBAL_FIRM_NAME . " - " . $web_page_name;

//language is set and loaded
if (!$_SESSION['session_language']) {       // if language is not set yet, the deafult language danish is chosen.
    $_SESSION['session_language'] = DEFAULT_LANG;
}

// choose language code: 
if (isset($_GET["lang"])) {
    try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("SELECT code FROM ReplaceDBcountry WHERE code = ? AND active = 1 ");
        $stmt->execute(array(clean_input_text($_GET["lang"])));
                // set the resulting array to associative
        if ($stmt->rowCount() == 1) {
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchAll() as $row) {
                $_SESSION['session_language'] = $row['code'];
            }
        }
        else {
            $_SESSION['session_language'] = DEFAULT_LANG;
        }
    }
    catch(PDOException $e) {
        $_SESSION['session_language'] = DEFAULT_LANG;
        header('Location: /');
    }
    $stmt = null;
    $conn = null;
}
/* IMPORTANT..!
*  The lang files is loaded here given the coosen lang. 
*  This is very importent that a activ lang has a lang file in the direktory with the exact 
*  Lang code as in the DB
*/
require_once SITE_ROOT_PATH."/570304x/lang/".$_SESSION['session_language'].".php";

// Her tjekkes det om man er logget ind
if (isset($_SESSION['login_user'])) {
    //Der navn der er gemt i sessionen bliver her skrevet i en variabel der kan tjekkes i mysql
    $login_tjek = username_check($_SESSION['login_user']);
    // Hvis der findes en bruger i systemet med login navnet findes de forskellige oplysninger om brugeren.
    try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare('SELECT * FROM ReplaceDBusers WHERE username_clean = ?;');
        $stmt->execute(array($login_tjek));
                // set the resulting array to associative
        if ($stmt->rowCount() == 1) {
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchAll() as $row) {
                define('LOGIN_ID', $row['id']);
                define('LOGIN_SESSION', $row['username']);
                define('LOGIN_SESSIONCLEAN', $row['username_clean']);
                define('LOGIN_LEVEL', $row['loginlevel']);
            }
        }
        else {
            header('Location: /logout');
        }
    }
    catch(PDOException $e) {
            header('Location: /error');
    }
    $stmt = null;
    $conn = null;   
}

if ($loginsidelevel != 0 && !isset($_SESSION['login_user'])) {
    header('Location: /');
}
else if ($loginsidelevel > LOGIN_LEVEL && isset($_SESSION['login_user'])) {
    header('Location: /');
}


include SITE_ROOT_PATH."/570304x/site_special_func.php"; // The special functionality of the specific site

?>
