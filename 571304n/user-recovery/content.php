<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/
?>
<div class="container GLOBALdesign">
    <div class="row">
        <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <?php
        echo $_SESSION["feedback_recover"];
        unset($_SESSION["feedback_recover"]);
    
        echo '<h2>Glemt password</h2>';

    switch ($_SESSION["recover_step"]) {
        case 1:
            echo '<p>
                    Indtast den recovery-kode du har modtaget på din email 
                </p>
                <form action="/571304n/user-recovery/process" id="forgotForm" onsubmit="return validateContactForm()" method="post">
                    <div class="form-group">
                    <label for="mail">Recovery-kode:</label>
                    <input type="text" class="form-control" name="mail" id="mail" value="'.stripslashes($_SESSION["recover_mail"]).'">
                    <span id="errMail" style="color:red;">'.$_SESSION["recover_mail_Err"].'</span>
                    </div>
                    <button type="submit" class="btn btn-success">Fortsæt</button>
                </form>';
            break;
        
        default:
            echo '<p>
                    Indtast den e-mail du har opgivet på siden, <br>
                    og du vil modtage en recovery-kode på mail. 
                    Den skal du indtaste bagefter. 
                </p>
                <form action="/571304n/user-recovery/process" id="forgotForm" onsubmit="return validateContactForm()" method="post">
                    <div class="form-group">
                    <label for="mail">'.$lang_data_mail.':</label>
                    <input type="text" class="form-control" name="mail" id="mail" value="'.stripslashes($_SESSION["recover_mail"]).'">
                    <span id="errMail" style="color:red;">'.$_SESSION["recover_mail_Err"].'</span>
                    </div>
                    <button type="submit" class="btn btn-success">Fortsæt</button>
                </form>';
                unset($_SESSION["recover_mail"]);
                unset($_SESSION["recover_mail_Err"]);
            break;
    }
    ?>
    </div>
    <div class="col-sm-3"></div>
        </div>
</div>