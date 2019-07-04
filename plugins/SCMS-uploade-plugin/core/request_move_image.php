<?php 
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 5.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the git repository
*/

$page_permission = 4; // Aloud for both users and admins
                     // Allthough be sure that no one else than the img's owner or an admin
                     // are aloud to remove a img.

require_once $_SERVER['DOCUMENT_ROOT']."/core/system_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $post_position = clean_input_text($_POST["position"]);
    $post_parant_id = clean_input_text($_POST["parent_id"]);


    $new_position_counter = 0;

    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
    $stmt = $conn->prepare("SELECT * FROM ReplaceDBimages WHERE attached_group = ? AND attached_id = ? ORDER BY show_order;");
    $stmt->execute(array($_SESSION['category_type'], $post_parant_id));
    // set the resulting array to associative
    if ($stmt->rowCount() > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) 
        {
            $owner_of_img = $row['user_id'];
            $id_of_img = $row['id'];
    
            if (check_permission(4) || LOGIN_ID == $owner_of_img) {
                if ($new_position_counter == $post_position) 
                {
                    
                    $conn_2 = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt_2 = $conn_2->prepare("UPDATE ReplaceDBimages SET show_order = :show_order WHERE id = :id;");
                    $stmt_2->bindParam(':show_order', $new_position_counter, PDO::PARAM_INT);
                    $stmt_2->bindParam(':id', $_SESSION['selected_img_id'], PDO::PARAM_INT);
                    $stmt_2->execute();

                    $new_position_counter++;

                    if ($id_of_img != $_SESSION['selected_img_id'])
                    {
                        $conn_2 = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                        $stmt_2 = $conn_2->prepare("UPDATE ReplaceDBimages SET show_order = :show_order WHERE id = :id;");
                        $stmt_2->bindParam(':show_order', $new_position_counter, PDO::PARAM_INT);
                        $stmt_2->bindParam(':id', $id_of_img, PDO::PARAM_INT);
                        $stmt_2->execute();
                        $new_position_counter++;
                    } 
                }
                else if ($id_of_img != $_SESSION['selected_img_id'])
                {
                    $conn_2 = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt_2 = $conn_2->prepare("UPDATE ReplaceDBimages SET show_order = :show_order WHERE id = :id;");
                    $stmt_2->bindParam(':show_order', $new_position_counter, PDO::PARAM_INT);
                    $stmt_2->bindParam(':id', $id_of_img, PDO::PARAM_INT);
                    $stmt_2->execute();

                    $new_position_counter++;
                
                }
            }
            else {
                $_SESSION["uploade_feedback"] = '<div class="row">
                <div class="col-sm-12 alert alert-danger">
                <strong>ERROR</strong> Der skete en fejl
                </div>
                </div>';
                unset($_SESSION['selected_img_owner']);
                unset($_SESSION['selected_img_id']);
                header("location: /control/site_editor");
            }
        }
    }

    unset($_SESSION['selected_img_owner']);
    unset($_SESSION['selected_img_id']);

    header("location: /control/site_editor");

}
else {
    header("location: /");
}

?>