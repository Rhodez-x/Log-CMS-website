<?php 
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 4.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/

$loginsidelevel = 9; // Aloud for both users and admins
                     // Allthough be sure that no one else than the img's owner or an admin
                     // are aloud to remove a img.

require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_img_id = clean_input_text($_POST["id"]);

    try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("SELECT user_id, dir FROM ReplaceDBimages WHERE id = :id;");
        $stmt->bindParam(':id', $post_img_id, PDO::PARAM_INT);
        $stmt->execute();
          // set the resulting array to associative
        if ($stmt->rowCount() > 0) {
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          foreach($stmt->fetchAll() as $row) {
              $owner_of_img = $row['user_id'];
              if (LOGIN_LEVEL > 49 || LOGIN_ID == $owner_of_img) {
                    $stmt_next = $conn->prepare("DELETE FROM ReplaceDBimages WHERE ((user_id = ?) OR (49 < ?)) AND (id = ?) ;");
                    $stmt_next->execute(array(LOGIN_ID, LOGIN_LEVEL, $post_img_id));
                    $stmt_next = null;
                    unlink($_SERVER['DOCUMENT_ROOT']. '/' .$row['dir']); 

                    $_SESSION["uploade_feedback"] = '<div class="row">
                    <div class="col-sm-12 alert alert-success">
                    <strong>SUCCESS</strong> Handlingen er gennemført
                    </div>
                    </div>';
                    header("location: /control/site_editor");
                }
                else {
                    $_SESSION["uploade_feedback"] = '<div class="row">
                    <div class="col-sm-12 alert alert-danger">
                    <strong>ERROR</strong> Der skete en fejl
                    </div>
                    </div>';
                    header("location: /control/site_editor");
                }
                $stmt = null;
                $conn = null;
            }
        }
    }
    catch(PDOException $e) {
        $_SESSION["uploade_feedback"] = '<div class="row">
        <div class="col-sm-12 alert alert-danger">
        <strong>ERROR</strong> Der skete en fejl
        </div>
        </div>';
        header("location: /control/site_editor");
    }
}
else {
    header("location: /");
}

?>