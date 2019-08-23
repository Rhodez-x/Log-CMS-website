<?php
$page_permission = 1; // only admins
require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $edited_sub_page = clean_input_text($_POST["sub_page"]);
    $edited_title = clean_input_text($_POST["text_title"]);
    $edited_comment = clean_input_text($_POST["comment"]);
    $edited_link = clean_input_text($_POST["link"]);
    $edited_text = $_POST["editor1"]; // This is cleaned by the plugin
        try {
            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
            
            if($_SESSION['page_content_type'] == "post") {
                if ($_SESSION['page_parent_id'] == "new") {
                    $stmt = $conn->prepare("SELECT @total := IFNULL((SELECT max(orders) FROM ReplaceDBpost) + 1,1);
                                            INSERT INTO ReplaceDBpost (name, description, text, language, category, date, active, orders) VALUES (?, ?, ?, ?, ?, ?, 1, @total);");
                    $stmt->execute(array($edited_title, $edited_comment, $edited_text, $_SESSION['page_name_lang'], $_SESSION['category_type'], DATE_AND_TIME));
                    $_SESSION['page_parent_id'] = $conn->lastInsertId();
                    $stmt = null;
                    $conn = null;
                }
                else {
                    $stmt = $conn->prepare("UPDATE ReplaceDBpost SET name = ?, description  = ?, text = ? WHERE id = ? AND language = ?");
                    $stmt->execute(array($edited_title, $edited_comment, $edited_text, $_SESSION['page_parent_id'], $_SESSION['page_name_lang']));
                    $stmt = null;
                    $conn = null;    
                }
                
            }
            else if ($_SESSION['page_content_type'] == "page") 
            {
                // Check if there is submenus, and place them under the new name: 
                $conn_hq = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt_hq = $conn_hq->prepare("SELECT name FROM ReplaceDBnavi_name WHERE parent_id = :id;");
                $stmt_hq->bindParam(':id', $_SESSION['page_parent_id'], PDO::PARAM_INT);
                $stmt_hq->execute();
                if ($stmt_hq->rowCount() > 0) {
                  $result_hq = $stmt_hq->setFetchMode(PDO::FETCH_ASSOC);
                  foreach($stmt_hq->fetchAll() as $row_hq) {
                        $stmt_next = $conn_hq->prepare("UPDATE ReplaceDBnavi SET place = ? WHERE place = ?;");
                        $stmt_next->execute(array($edited_title, $row_hq['name']));
                        $stmt_next = null;
                    }
                }

                $new_page_name_link = urlencode($edited_link);
                $stmt = $conn->prepare("UPDATE ReplaceDBtext SET description  = ?,  text = ? WHERE parent_id = ? AND language = ?;
                                        UPDATE ReplaceDBnavi_name SET name  = ? WHERE parent_id = ?;
                                        UPDATE ReplaceDBnavi SET link = ?, place = ? WHERE id = ?;");
                $stmt->execute(array($edited_comment, $edited_text, $_SESSION['page_parent_id'], $_SESSION['page_name_lang'], $edited_title, $_SESSION['page_parent_id'], $new_page_name_link, $edited_sub_page, $_SESSION['page_parent_id']));
                $stmt = null;
                $conn = null;
            }
            else 
            {
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
            <div class="col-sm-4">'.$e.'</div>
            </div>';
        }
    }
header("location: /control/site_editor");
?>