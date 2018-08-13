<?php
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 4.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/

$loginsidelevel = 49; 
require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = clean_input_text($_POST["id"]);
    $post_parent_id = clean_input_text($_POST["parent_id"]);
    $post_page_name = clean_input_text($_POST["page_name"]);
    $post_handel = clean_input_text($_POST["handel"]); // The value of the button preesed
    $post_navi_order = clean_input_text($_POST["navi_order"]);
    $post_link = clean_input_text($_POST["link"]);
    $post_add = clean_input_text($_POST["add"]);
    
    try {
        if ($post_add == '1') {
            /*
                Create a new page and put it in the menu. 
            */
            $new_post_page_name_link = 'page?id='.urlencode($post_page_name);
            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
            $stmt = $conn->prepare("SELECT @order_id := (1 + max(navi_order)) FROM ReplaceDBnavi WHERE place='standart';
                INSERT INTO ReplaceDBnavi (link, navi_order, permission, place) VALUES (?, @order_id, 0, 'standart');
                SELECT @parrent := id FROM ReplaceDBnavi WHERE link = ?;
                INSERT INTO ReplaceDBnavi_name (name, language, parent_id) VALUES (?, 'DK', @parrent);
                INSERT INTO ReplaceDBtext (language, parent_id, text, required, content_group) VALUES ('DK', @parrent, ?, 0, 'page');");
            $stmt->execute(array($new_post_page_name_link, $new_post_page_name_link, $post_page_name, $post_page_name));
            $stmt = null;
            $conn = null;
            
        }
        else {
            if ($post_handel == "mv_up") {
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("UPDATE ReplaceDBnavi SET navi_order = navi_order + 1 WHERE navi_order = ? AND place ='standart';
                                        UPDATE ReplaceDBnavi SET navi_order = navi_order - 1 WHERE link = ? AND place ='standart';");
                $stmt->execute(array(($post_navi_order - 1), $post_link));
                $stmt = null;
                $conn = null;
            }
            else if ($post_handel == "mv_dw") {
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("UPDATE ReplaceDBnavi SET navi_order = navi_order - 1  WHERE navi_order = ?;
                                        UPDATE ReplaceDBnavi SET navi_order = navi_order + 1 WHERE link = ?;");
                $stmt->execute(array(($post_navi_order + 1), $post_link));
                $stmt = null;
                $conn = null;
            }
            else if ($post_handel == "rm") {
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("DELETE FROM ReplaceDBnavi WHERE link = ? AND required = 0;
                                        DELETE FROM ReplaceDBtext WHERE parent_id = ? AND content_group = 'page';
                                        DELETE FROM ReplaceDBnavi_name WHERE parent_id = ?;");
                $stmt->execute(array($post_link, $post_parent_id, $post_parent_id));
                
                $stmt = null;

                $stmt2 = $conn->prepare("SELECT * FROM ReplaceDBimages WHERE attached_group = 'page' AND attached_id = ?;");
                $stmt2->execute(array($post_parent_id));
                    // set the resulting array to associative
                if ($stmt2->rowCount() > 0) {
                    $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    foreach($stmt2->fetchAll() as $row) {
                        unlink($_SERVER['DOCUMENT_ROOT']. '/' .$row['dir']); 
                    }
                } 

                $stmt2 = null;

                $stmt3 = $conn->prepare("DELETE FROM ReplaceDBimages WHERE attached_group = 'page' AND attached_id = ?;");
                $stmt3->execute(array($post_parent_id));

                $stmt3 = null;
                $conn = null;
            }
            else if ($post_handel == "edit") {
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("UPDATE ReplaceDBnavi SET name = ? WHERE id = ?;");
                $stmt->execute(array($post_page_name, $post_id));
                $stmt = null;
                $conn = null;
            }
        }
        $_SESSION["uploade_feedback"] = '<div class="row">
        <div class="col-sm-12 alert alert-success">
        <strong>SUCCESS</strong> Handlingen er gennemført
        </div>
        </div>';
        header("location: /control/master_control");

    }
    catch(PDOException $e) {
        $_SESSION["uploade_feedback"] = '<div class="row">
        <div class="col-sm-12 alert alert-danger">
        <strong>ERROR</strong> Der skete en fejl '.$e.'
        </div>
        </div>';
        header("location: /control/master_control");
    }
}
else {
    header("location: /");
}
?>
