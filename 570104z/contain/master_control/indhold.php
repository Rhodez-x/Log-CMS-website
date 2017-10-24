<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/
?>

<div class="container GLOBALdesign">
     <h2>Controlpanel</h2>
    <?php echo menu_line($web_page_name);
          echo $_SESSION["uploade_feedback"];
          unset($_SESSION["uploade_feedback"]);?>
    
    <div class="row">
    <nav class="col-sm-2" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
        <li><h3>Oversigt</h3></li>
        <li><a href="#user">Tilføj bruger</a></li>
        <li><a href="#members">Medlemsoversigt</a></li>
        <li><a href="#sider">Tilføj/fjern sider</a></li>
        <li><a href="#backup">Backup database</a></li>
      </ul>
    </nav>
    <div class="col-sm-10">
        <?php 
        try {
            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
            $stmt = $conn->prepare("SELECT * FROM ReplaceDBcountry WHERE active = 1 ORDER BY name;");
            $stmt->execute();
            if ($stmt->rowCount() > 1) {
                foreach($stmt->fetchAll() as $row) {
                    $select_lang_name = $row['name'];
                    $select_lang_code = $row['code']; 
                    if ($select_lang_code == $_SESSION['master_control_edit_lang']) {
                        $select_lang_active_edit_lang = 'selected';
                    }
                    else {
                        $select_lang_active_edit_lang = '';
                    }               
                    $select_lang_options = $select_lang_options . "<option $select_lang_active_edit_lang value='$select_lang_code'>".$select_lang_name."</option>";

                }
                $select_lang_text = '<form class="form-inline" onsubmit="return confirmDelete()" action="/570104z/contain/setup/member_handler" method="post">
                Vælg hvilket sprog der skal redigeres
                <div class="input-group">
                <select class="form-control" name="edit_page_name" id="edit_page_name">  
                '.$select_lang_options.'
                </select>
                </div>  
                <button type="submit" class="btn btn-default" name="handel" value="edit">Vælg</button>
                </form>';
            }
            else {
                $select_lang_text = "";
            }
        }
        catch(PDOException $e) {
            $select_lang_text = "Der er sket en fejl.";
        }
        $stmt = null;
        $conn = null;

        echo $select_lang_text;
        ?>
        <hr>
    <div id="user"> 
            <h2>Create user:</h2>
        <form class="form-inline" name="createForm" action="/570104z/contain/master_control/create_user" onsubmit="return validateForm()" method="post">
        <div class="form-group">
        <label for="titel">Username:</label>
        <input type="text" class="form-control" name="username" id="username">
        <span id="errUser"></span>
        </div>
        <div class="form-group">
        <label for="titel">password:</label>
        <input type="password" class="form-control" name="password" id="password">
        <span id="errPass"></span>
        </div>
        <button type="submit" class="btn btn-default">Create user</button>
        </form>
        <hr>
    </div> 
    <div id="members">         
        <h2>Medlemsoversigt</h2>
        <?php 
            try {
                /* Setup values for the loop
                *  Deffrent options for deffrend kind of user state
                */
                $admin_or_users = 0;
                $button_admin_no_admin = '<button type="submit" class="btn btn-default" name="handel" value="noadmin">
                                          Gør til almindelig medlem</button>';
                $text_user_active = 'Deactivate';
                $value_user_activate = 'deactivate';

                $page_edit_text = $page_edit_text . '<h3>Adminstrators</h3>';
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                /* The order of the finding members, is first those whom is active = 1
                *  They are ordered by the loginlevel, so that the adminstrators is listed first, the the regular members
                *  When this is finnsihed the members with active 0 is listed, this is the members which is deactivated.
                */
                $stmt = $conn->prepare("SELECT * FROM ReplaceDBusers ORDER BY active DESC, loginlevel DESC, username;");
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    foreach($stmt->fetchAll() as $row) {
                        $data_login_id = $row['id'];
                        $data_login_username = $row['username'];
                        $data_login_level = $row['loginlevel'];
                        $data_login_is_active = $row['active'];
                        
                        if ($admin_or_users == 0 && $data_login_level < 49 && $data_login_is_active == 1 ) {
                            // Admins has been printed, now members has to be printet
                            $page_edit_text = $page_edit_text . '<h3>Members</h3>';
                            $button_admin_no_admin = '<button type="submit" class="btn btn-default" name="handel" value="admin">
                                                    Gør til bestyrelses medlem</button>';
                            $admin_or_users = 1;
                        }
                        else if ($data_login_is_active == 0 && $admin_or_users != 2) {
                            // $data_login_is_active = 0 is deactivated
                            $page_edit_text = $page_edit_text . '<h3>Deactivated Members</h3>';
                            $text_user_active = 'Activate';
                            $value_user_activate = 'activate';
                            $button_admin_no_admin = ''; // No button to make the user admin while deactiveted, then first activate and then promote to admin
                            $admin_or_users = 2;
                        }

                        $page_edit_text = $page_edit_text . '<form class="form-inline" onsubmit="return confirmDelete()" action="/570104z/contain/master_control/member_handler" method="post">
                        <div class="form-group">
                        <label for="page_name">'.$edit_page_lang.'</label>
                            <input type="text" class="form-control" name="username" id="username" readonly value="'.$data_login_username.'">
                          </div>
                          <input type="hidden" class="form-control" name="id" id="id" value="'.$data_login_id.'">
                          '.$button_admin_no_admin.'
                          <button type="submit" class="btn btn" name="handel" value="'.$value_user_activate.'">'.$text_user_active.'</button>
                          <button type="submit" class="btn btn-danger" name="handel" value="delete">Slet</button>
                          </form>';
                    }
                }
                else {
                    $page_edit_text = "Ingen elementer er fundet";
                }
            }
            catch(PDOException $e) {
                $page_edit_text = "Der er sket en fejl.";
            }
            $stmt = null;
            $conn = null;
            
            echo $page_edit_text;
        ?>
        <hr />
      </div>
      <div id="sider">         
        <h2>Tilføj/fjern sider</h2>
        <?php 
            try {
                $page_edit_text = '';
                $edit_page_navi_order_temp = "1";
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("SELECT * FROM ReplaceDBnavi WHERE language = ? ORDER BY navi_order, language;");
                $stmt->execute(array($_SESSION['master_control_edit_lang']));
                if ($stmt->rowCount() > 0) {
                    foreach($stmt->fetchAll() as $row) {
                        $edit_page_id = $row['id'];
                        $edit_page_name = $row['name'];
                        $edit_page_lang = $row['language'];
                        $edit_page_required = $row['required'];
                        $edit_page_navi_order = $row['navi_order'];
                        $edit_page_link = $row['link'];
                        if ($edit_page_navi_order_temp != $edit_page_navi_order) {
                            $page_edit_text = $page_edit_text .'<br>';
                        }
                        
                        if ($edit_page_required == '1') {
                            /* if the page is required the user cannot edit this
                            */
                            $edit_page_required_disable = 'disabled';
                        }
                        
                        $page_edit_text = $page_edit_text . '<form class="form-inline" onsubmit="return confirmDelete()" action="/570104z/contain/master_control/page_handler" method="post">
                        <div class="form-group">
                        <label for="page_name">'.$edit_page_lang.'</label>
                            <input type="text" class="form-control" name="page_name" id="page_name" value="'.$edit_page_name.'">
                          </div>
                          <input type="hidden" class="form-control" name="navi_order" id="navi_order" value="'.$edit_page_navi_order.'">
                          <input type="hidden" class="form-control" name="link" id="link" value="'.$edit_page_link.'">
                          <input type="hidden" class="form-control" name="id" id="id" value="'.$edit_page_id.'">
                          <button type="submit" class="btn btn-default" name="handel" value="edit">Rediger</button>
                          <button type="submit" class="btn btn-danger" '.$edit_page_required_disable.' name="handel" value="rm">Fjern</button>
                          <button type="submit" class="btn btn-default" name="handel" value="mv_up"><span class="glyphicon glyphicon-arrow-up"></span></button>
                          <button type="submit" class="btn btn-default" name="handel" value="mv_dw"><span class="glyphicon glyphicon-arrow-down"></span></button></form>';

                        $edit_page_navi_order_temp = $edit_page_navi_order;
                        $edit_page_required_disable = '';
                    }
                }
                else {
                    $feedback = "Ingen elementer er fundet";
                }
            }
            catch(PDOException $e) {
                $feedback = "Der er sket en fejl.";
            }
            $stmt = null;
            $conn = null;
            
            echo $page_edit_text . '<br><form class="form-inline" action="/570104z/contain/master_control/page_handler" method="post">
                        <div class="form-group">
                        <label for="max_weight">Tilføj ny side</label>
                            <input type="text" class="form-control" name="page_name_dk" id="page_name" value="">
                          </div>
                          <input type="hidden" class="form-control" name="add" id="add" value="1">
                          <button type="submit" class="btn btn-default">Tilføj</button></form>';
        ?>
        <hr />
      </div>
        <div id="backup" >         
            <h2>Backup database</h2>
            Her kommer der mulighed for at tage backup af databasen
        </div>
    </div>
  </div>
</div>