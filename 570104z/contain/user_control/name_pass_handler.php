<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/
$loginsidelevel = 10; // 10 for all users are aloud to use this 
require_once $_SERVER['DOCUMENT_ROOT']."/570304x/x530199.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ok = true;
    $post_id = clean_input_text($_POST["id"]);   
    $post_handel = clean_input_text($_POST["handel"]); // The value of the button preesed
    
    try {
        // switches between the qureies controled by the value of which button is pressed
        switch ($post_handel) {
            case 'name':
                $_SESSION["new_username"] = clean_input_text($_POST["username"]); // The username 
                $post_old_pass = clean_input_text($_POST["password"]); // The users old password, to confirm the right user
                        // Her tjekkes det om der er skrevet noget i brugernavnet og passwordet
                if (!empty($_SESSION["new_username"]) && !empty($post_old_pass)) {
                    // Hvis der findes en bruger i systemet med login navnet findes de forskellige oplysninger om brugeren.
                    $tjekBrugernavn = username_check($tjekBrugernavn);
                    $tjekPassword = password_crypt($tjekPassword, $tjekBrugernavn);
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("UPDATE ReplaceDBusers SET username = 'test', username_clean = 'clean', password = 'new_pass' 
                                            WHERE id = (SELECT id FROM ReplaceDBusers WHERE username_clean = 'clean' AND password = 'old_pass');");
                    $stmt->execute(array($post_id));
                    
                    if ($stmt->rowCount() == 0) {
                        throw new Exception('Du har indtastet forkert password');
                    }
                    else if ($stmt->rowCount() > 1) {
                        throw new Exception('Der er sket en fejl, kontakt straks personen der har sat siden op');
                    }

                    $stmt = null;
                    $conn = null;
                }
                else {
                    $_SESSION["change_username_feedback"] = "<span style="color:red;"><b>Du skal udfylde begge felter</b></span>";
                    $ok = false;
                }
                
                break;
            case 'pass':
                /*
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("UPDATE ReplaceDBusers SET name = 'test' WHERE id = ? ;");
                $stmt->execute(array($post_id));
                $stmt = null;
                $conn = null;
                */
                break;

            default:
                // code...
                break;
        }
        if ($ok) {
            $_SESSION["uploade_feedback"] = '<div class="row">
            <div class="col-sm-8 alert alert-success">
            <strong>SUCCESS</strong> Handlingen er gennemført
            </div>
            <div class="col-sm-4"></div>
            </div>';
        }

        header("location: /570104z/user_control");

    }
    catch(PDOException $e) {
        $_SESSION["uploade_feedback"] = '<div class="row">
        <div class="col-sm-8 alert alert-danger">
        <strong>ERROR</strong> Der skete en fejl '.$e.'
        </div>
        <div class="col-sm-4"></div>
        </div>';
        header("location: /570104z/user_control");
    }
}
else {
    header("location: /");
}
?>
