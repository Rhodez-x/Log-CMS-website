<?php
$loginsidelevel = 49; 
require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $POST_username = clean_input_text($_POST["username"]);
    $POST_password = clean_input_text($_POST["password"]);
    
    if (!empty($POST_username) && !empty($POST_password)) {
    
    $POST_username_clean = username_check($POST_username);
    $POST_password = password_crypt($POST_password, $POST_username_clean);
    
    try {
    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
    $stmt = $conn->prepare("INSERT INTO ReplaceDBusers (username, username_clean, loginlevel, password, active)
                            VALUES(?, ?, 10, ?, 1);"); // 10 for a regular user, 1 for that the user is immediately active
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
