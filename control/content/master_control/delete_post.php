<?php
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 5.0.0-a2 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/

$page_permission = 1; // only admins

require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_appointment_id = clean_input_text($_POST["id"]);

    try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("DELETE FROM ReplaceDBpost WHERE id = ?;");
        $stmt->execute(array($post_appointment_id));

        $stmt2 = $conn->prepare("SELECT * FROM ReplaceDBimages WHERE attached_group = 'post' AND attached_id = ?;");
        $stmt2->execute(array($post_appointment_id));
            // set the resulting array to associative
        if ($stmt2->rowCount() > 0) {
            $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt2->fetchAll() as $row) {
                unlink($_SERVER['DOCUMENT_ROOT']. '/' .$row['dir']); 
            }
        } 

        $stmt3 = $conn->prepare("DELETE FROM ReplaceDBimages WHERE attached_group = 'post' AND attached_id = ?;");
        $stmt3->execute(array($post_appointment_id));

        $_SESSION["uploade_feedback"] = '<div class="row">
        <div class="col-sm-12 alert alert-success">
        <strong>SUCCESS</strong> Handlingen er gennemført
        </div>
        </div>';
        
        header("location: /tidligere_arrangementer");
        
        $stmt = null;
        $stmt2 = null;
        $stmt3 = null;
        $conn = null;
    }
    catch(PDOException $e) {
        $_SESSION["uploade_feedback"] = '<div class="row">
        <div class="col-sm-12 alert alert-danger">
        <strong>ERROR</strong> Der skete en fejl
        </div>
        </div>';
        header("location: /tidligere_arrangementer");
    }
}
else {
    header("location: /");
}

?>