<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/

include $_SERVER['DOCUMENT_ROOT']."/570304x/x530199.php"; // kernel
include $_SERVER['DOCUMENT_ROOT']."/570304x/validation_functions.php"; // validation functions used to validate the input

/**
 * Generate a random string, using a cryptographically secure 
 * pseudorandom number generator (random_int)
 * 
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 * 
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (time() > $_SESSION["recovery_try_time"]) {
        $_SESSION["recovery_try_time"] = time() + 3; // ony one request pr 5 second
        $ok = true;
        list($ok, $_SESSION["recover_mail"], $_SESSION["recover_mail_Err"]) = validate_email($_POST['mail']);
        
        if($ok) {
            $user_found = true;
            $user_active = true;
            $temp_error = false;
            $recovercode_string = '';
            $contact_name = '';
            try {
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("SELECT id, active, username FROM ReplaceDBusers WHERE mail = ? ");
                $stmt->execute(array($_SESSION["recover_mail"]));
                if ($stmt->rowCount() == 1) {
                    foreach($stmt->fetchAll() as $row) {
                        if ($row['active'] == 1) {
                            $contact_name = $row['username'];
                            $recovercode_string = random_str(12); // first created when we are sure that the user is valid
                            $stmt_set = $conn->prepare("UPDATE ReplaceDBusers SET recoverycode = ?, recoverytime = ? WHERE id = ? ");
                            $stmt_set->execute(array($recovercode_string, (time() + 900), $row['id']));
                            $stmt_set = null;
                        }
                        else {
                            $user_active = false;
                        }
                    }
                } 
                else {
                    $user_found = false;
                }
            }
            catch(PDOException $e) {
                    $temp_error = true;
            }
            $stmt = null;
            $conn = null;
            if ($user_found ) {
                if ($user_active) {
                    $text_for_recovery_mail = "Din <b>Recovery-kode: $recovercode_string </b><br>
                    indtast denne på siden, som angivet";
                }
                else {
                    $text_for_recovery_mail = 'Din bruger er blevet deaktiveret, kontakt en adminstrator på siden.';
                }
                //Email is sent to global_contact_mail
                $to = $subject = $message = $headers = "";
        
                $to = $_SESSION["recover_mail"];
                $subject = "Recovery af password - " . $global_firm_name; 
                $message = '
                <html>
                <head>
                <title>Recovery af password - ' . $global_firm_name .'</title>
                </head>
                <body style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif;">
                    Hej '.$contact_name.'<br>
                    <br>
                    Du har bedt om at få nulstillet dit password på siden '.$global_firm_name.'<br>
                    <br>
                    '.$text_for_recovery_mail.'<br>
                    <br>
                    Med Venlig Hilsen<br>
                    '.$global_firm_name.'

                </body>
                </html>';
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    
                // More headers
                $headers .= 'From: <'.$global_contact_email.'>' . "\r\n";
                mail($to, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers); // =?utf-8?B?'.base64_encode($subject) Set the subject to contain utf-8 charset so that the subject can contain the danish æøå
            }
            $_SESSION["recover_step"] = 1;
            $_SESSION["feedback_recover"] = '<div class="row">
                <div class="col-sm-12 alert alert-success"><b>Mail sendt</b> <br> 
                Hvis din mail findes i databasen, er der nu sendt en mail <br>
                med en recoverycode du skal indtaste nu
                </div>
                </div>';
        }
    }
    else {
        $_SESSION["recover_mail"] = clean_input_text($_POST["mail"]);
        $_SESSION["feedback_recover"] = '<div class="row">
        <div class="col-sm-12 alert alert-danger"> Vent et øjeblik og prøv igen
        </div>
        </div>';
    }
    header("location: /user-recovery");
} 
else {
    header("location: /");
}
?>