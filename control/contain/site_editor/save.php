<?php
$loginsidelevel = 49;
require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $edited_text = $_POST["editor1"];
        try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("UPDATE ReplaceDBtext SET text = ? WHERE page_name = ? AND language = ?");
            $stmt->execute(array($edited_text, $_SESSION['page_name_text_edit'], $_SESSION['page_name_lang']));
            $stmt = null;
            $conn = null;
            
            $_SESSION["uploade_feedback"] = '<div class="row">
            <div class="col-sm-8 alert alert-success">
            <strong>SUCCESS</strong> Teksten er gemt
            </div>
            <div class="col-sm-4"></div>
            </div>';
    
        }
        catch(PDOException $e) {
            $_SESSION["uploade_feedback"] = '<div class="row">
            <div class="col-sm-8 alert alert-danger">
            <strong>ERROR</strong> Der er sket en fejl - '.$e.'
            </div>
            <div class="col-sm-4"></div>
            </div>';
        }
    }
header("location: /570104z/site_editor");
?>