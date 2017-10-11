<?php
/*
Copy-right Jørn Guldberg
This is version 3.0 opdateret d. 04-10-2017
Core CMS now added to github
*/

if (!$session_is_started) {
    session_start();
}
// Her indstilles tidindstillingerne på siden
date_default_timezone_set("Europe/Copenhagen");
$date_and_time = date('Y-m-d H:i:s');
$date_without_time = date('Y-m-d');
$global_contact_email = "new@guld-berg.dk";
$global_firm_name = "newSampelFirm";
$activate_master_control = true;
//siden titel
$sidenstitel = "$global_firm_name - " . $sidenavn;

//language is set and loaded
if (!$_SESSION['session_language']) {       // if language is not set yet, the deafult language danish is chosen.
    $_SESSION['session_language'] = "DK";
}

// choose language code: 
if (isset($_GET["lang"])) {
    $_SESSION['session_language'] = "";
    try {
        include($_SERVER['DOCUMENT_ROOT']."/571204m/m530199c.php");
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
            $_SESSION['session_language'] = 'GB';
        }
    }
    catch(PDOException $e) {
            header('Location: /');
    }
    $stmt = null;
    $conn = null;
}

if ($_SESSION['session_language'] == "DK") {
    require_once $_SERVER['DOCUMENT_ROOT']."/570304x/lang/DK.php";
}
else {
    require_once $_SERVER['DOCUMENT_ROOT']."/570304x/lang/GB.php";
}

// Her laves en funktion der renser teksten. 
function clean_input_text($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = addslashes($data);
   return $data;
}

function username_check($tjekBrugernavn) {
    $tjekBrugernavn = rtrim($tjekBrugernavn, ' ');
    $tjekBrugernavn = stripslashes($tjekBrugernavn);
    $tjekBrugernavn = htmlspecialchars($tjekBrugernavn);
    $tjekBrugernavn = strtolower($tjekBrugernavn);
    $tjekBrugernavn = addslashes($tjekBrugernavn);

    return $tjekBrugernavn;
    
}

function password_crypt($tjekPassword, $tjekBrugernavn) {
    // Denne tager passwordet ind og cryptere det, så det kan tjekkes i DB.
    $b1 = "03q2d4qwd%?1234Ejoe324>";
    $b2 = "233244?][qwrqwqeqwew";
    $b3 = "¤SDFWwdfsdgdf.,wrsdv{}2";
    $tjekPassword = stripslashes($tjekPassword);
    $tjekPassword = htmlspecialchars($tjekPassword);
    $feedback = hash('sha256', $b2.$tjekBrugernavn.$b3.$tjekPassword.$b1);
    
    return $feedback;
}

// Her tjekkes det om man er logget ind
if (isset($_SESSION['login_user'])) {
    //Der navn der er gemt i sessionen bliver her skrevet i en variabel der kan tjekkes i mysql
    $login_tjek = username_check($_SESSION['login_user']);
    // Hvis der findes en bruger i systemet med login navnet findes de forskellige oplysninger om brugeren.
    try {
        include($_SERVER['DOCUMENT_ROOT']."/571204m/m530199c.php");
        $stmt = $conn->prepare('SELECT * FROM ReplaceDBusers WHERE username_clean = ? ');
        $stmt->execute(array($login_tjek));
                // set the resulting array to associative
        if ($stmt->rowCount() == 1) {
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchAll() as $row) {
                $login_id =$row['id'];
                $login_session =$row['username'];
                $login_sessionclean = $row['username_clean'];
                $login_level =$row['loginlevel'];
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
else if ($loginsidelevel > 1 && isset($_SESSION['login_user']) && $login_level < 49) {
    header('Location: /');
}
?>
