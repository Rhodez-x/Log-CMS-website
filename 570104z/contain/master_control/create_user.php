<?php
$loginsidelevel = 2; 
require_once $_SERVER['DOCUMENT_ROOT']."/570304x/x530199.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $POST_username = rensteksten($_POST["username"]);
    $POST_password = rensteksten($_POST["password"]);
    
    if (!empty($POST_username) && !empty($POST_password)) {
    
    $POST_username_clean = tjek_brugernavn($POST_username);
    $POST_password = password_crypt($POST_password, $POST_username_clean);
    
    try {
    include($_SERVER['DOCUMENT_ROOT']."/571204m/m530199c.php");
    $stmt = $conn->prepare("INSERT INTO ReplaceDBusers (username, username_clean, loginlevel, password)
                            VALUES(?, ?, 50, ?);");
    $stmt->execute(array($POST_username, $POST_username_clean, $POST_password));
    $_SESSION["uploade_feedback"] = '<div class="row">
            <div class="col-sm-8 alert alert-success">
            <strong>SUCCESS</strong> User is created
            </div>
            <div class="col-sm-4"></div>
            </div>';
    }
    catch(PDOException $e) {
        $_SESSION["uploade_feedback"] = '<div class="row">
            <div class="col-sm-8 alert alert-danger">
            <strong>ERROR</strong> Error - '.$e.'
            </div>
            <div class="col-sm-4"></div>
            </div>';
    }
    $stmt = null;
    $conn = null;
    }
    else {
        $_SESSION["uploade_feedback"] = '<div class="row">
            <div class="col-sm-8 alert alert-danger">
            <strong>ERROR</strong> Error - You have to enter both username and password
            </div>
            <div class="col-sm-4"></div>
            </div>';        
    }
    header('Location: /570104z/master_control');
} else {
    header('Location: /');
}
?>
