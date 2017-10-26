<?php
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 4.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/

$loginsidelevel = 49; 
require_once $_SERVER['DOCUMENT_ROOT']."/570304x/x530199.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = clean_input_text($_POST["id"]);
    $post_page_name = clean_input_text($_POST["page_name"]);
    $post_page_name_dk = clean_input_text($_POST["page_name_dk"]);   
    $post_handel = clean_input_text($_POST["handel"]); // The value of the button preesed
    $post_navi_order = clean_input_text($_POST["navi_order"]);
    $post_link = clean_input_text($_POST["link"]);
    $post_add = clean_input_text($_POST["add"]);
    
    try {
        if ($post_add == '1') {
            
            $heighst_navi_order = "";
            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
            $stmt = $conn->prepare("SELECT navi_order FROM ReplaceDBnavi ORDER BY navi_order DESC LIMIT 1;");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                foreach($stmt->fetchAll() as $row) {
                    $heighst_navi_order = $row['navi_order'];
                }
            }
            $stmt = null;
            $conn = null;
            $heighst_navi_order++;             
            $new_post_page_name_link = 'page?id='.$post_page_name_dk;
            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
            $stmt = $conn->prepare("INSERT INTO ReplaceDBnavi (name, link, language, navi_order) VALUES (?, ?, 'DK', ?);");
            $stmt->execute(array($post_page_name_dk, $new_post_page_name_link, $heighst_navi_order));
            $stmt = null;
            $conn = null;

            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
            $stmt = $conn->prepare("INSERT INTO ReplaceDBtext (language, page_name, text) VALUES ('DK', ?, ?);");
            $stmt->execute(array($post_page_name_dk, $post_page_name_dk));
            $stmt = null;
            $conn = null;
            
            
        }
        else {
            if ($post_handel == "mv_up") {
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("UPDATE ReplaceDBnavi SET navi_order = navi_order + 1 WHERE navi_order = ?;
                                        UPDATE ReplaceDBnavi SET navi_order = navi_order - 1 WHERE link = ?;");
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
                                        DELETE FROM ReplaceDBtext WHERE page_name = ?;");
                $stmt->execute(array($post_link, $post_page_name));
                $stmt = null;
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
        header("location: /570104z/master_control");

    }
    catch(PDOException $e) {
        $_SESSION["uploade_feedback"] = '<div class="row">
        <div class="col-sm-12 alert alert-danger">
        <strong>ERROR</strong> Der skete en fejl '.$e.'
        </div>
        </div>';
        header("location: /570104z/master_control");
    }
}
else {
    header("location: /");
}
?>
