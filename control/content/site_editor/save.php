<?php
$loginsidelevel = 49;
require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $edited_title = clean_input_text($_POST["text_title"]);
    $edited_comment = clean_input_text($_POST["comment"]);
    $edited_text = $_POST["editor1"]; // This is cleaned by the plugin
        try {
            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
            
            if($_SESSION['page_content_type'] == "post") {
                $stmt = $conn->prepare("UPDATE ReplaceDBtext SET name = ?, description  = ?, text = ? WHERE id = ? AND language = ?");
                $stmt->execute(array($edited_title, $edited_comment, $edited_text, $_SESSION['page_parent_id'], $_SESSION['page_name_lang']));
                $stmt = null;
                $conn = null;
            }
            else if ($_SESSION['page_content_type'] == "page") {
                $new_page_name_link = 'page?id='.urlencode($edited_title);
                $stmt = $conn->prepare("UPDATE ReplaceDBtext SET description  = ?,  text = ? WHERE parent_id = ? AND language = ?;
                                        UPDATE ReplaceDBnavi_name SET name  = ? WHERE parent_id = ?;
                                        UPDATE ReplaceDBnavi SET link  = ? WHERE id = ?;");
                $stmt->execute(array($edited_comment, $edited_text, $_SESSION['page_parent_id'], $_SESSION['page_name_lang'], $edited_title, $_SESSION['page_parent_id'], $new_page_name_link, $_SESSION['page_parent_id']));
                $stmt = null;
                $conn = null;
            }
            else {
                throw new Exception("Not known content type"); 
            }

             
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
            <strong>ERROR</strong> Der er sket en fejl 
            </div>
            <div class="col-sm-4"></div>
            </div>';
        }
    }
header("location: /control/site_editor");
?>