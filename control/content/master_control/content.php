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
        <li><a href="/control/master_control#user">Tilføj bruger</a></li>
        <li><a href="/control/master_control#members">Medlemsoversigt</a></li>
        <li><a href="/control/master_control#sider">Tilføj/fjern sider</a></li>
        <li><a href="/control/master_control#backup">Backup database</a></li>
        <li><a href="/control/master_control#plugs">Plugin liste</a></li>
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
                $select_lang_text = '<form class="form-inline" onsubmit="return confirmDelete()" action="/control/content/setup/member_handler" method="post">
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
        <form class="form-inline" name="createForm" action="/control/content/master_control/create_user" onsubmit="return validateForm()" method="post">
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
                $page_edit_text = $page_edit_text . '<h3>Medlemmer</h3>';
                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                $stmt = $conn->prepare("SELECT * FROM ReplaceDBusers ORDER BY active DESC, username;");
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    foreach($stmt->fetchAll() as $row) {
                        $text_user_active = 'Deactivate';
                        $value_user_activate = 'deactivate';
                        
                        $data_login_id = $row['id'];
                        $data_login_username = $row['username'];
                        $data_login_is_active = $row['active'];
                        
                        if ($data_login_is_active == 0) {
                            // $data_login_is_active = 0 is deactivated
                            $page_edit_text = $page_edit_text . '<h3>Deactivated Members</h3>';
                            $text_user_active = 'Activate';
                            $value_user_activate = 'activate';
                        }
                        
                        $page_edit_text = $page_edit_text . '<form class="form-inline" onsubmit="return confirmDelete()" action="/control/content/master_control/member_handler" method="post">
                        <div class="form-group">
                        <label for="page_name">'.$edit_page_lang.'</label>
                            <input type="text" class="form-control" name="username" id="username" readonly value="'.$data_login_username.'">
                          </div>
                          <input type="hidden" class="form-control" name="id" id="id" value="'.$data_login_id.'">
                          <a href="/control/user_editor?user_id='.$row['id'].'" class="btn btn-default" role="button">Rediger bruger</a>

                          '.$button_admin_no_admin.'
                          <button type="submit" class="btn btn-default" name="handel" value="'.$value_user_activate.'">'.$text_user_active.'</button>
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
                $stmt = $conn->prepare("SELECT ReplaceDBnavi.*, ReplaceDBnavi_name.* 
                                        FROM ReplaceDBnavi 
                                        INNER JOIN ReplaceDBnavi_name ON ReplaceDBnavi.id=ReplaceDBnavi_name.parent_id
                                         WHERE language = ? AND place = 'standart' ORDER BY navi_order, language;");
                $stmt->execute(array($_SESSION['master_control_edit_lang']));
                if ($stmt->rowCount() > 0) {
                    foreach($stmt->fetchAll() as $row) {
                        $edit_page_id = $row['id'];
                        $edit_page_parent_id = $row['parent_id'];
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
                            
                            $page_edit_text = $page_edit_text . '<form class="form-inline" onsubmit="return confirmDelete()" action="/control/content/master_control/page_handler" method="post">
                            <div class="form-group">
                            <label for="page_name">'.$edit_page_lang.'</label>
                                <input type="text" class="form-control" name="page_name" id="page_name" readonly value="'.$edit_page_name.'">
                              </div>
                              <input type="hidden" class="form-control" name="navi_order" id="navi_order" value="'.$edit_page_navi_order.'">
                              <input type="hidden" class="form-control" name="link" id="link" value="'.$edit_page_link.'">
                              <input type="hidden" class="form-control" name="id" id="id" value="'.$edit_page_id.'">
                              <input type="hidden" class="form-control" name="parent_id" id="parent_id" value="'.$edit_page_parent_id.'">
                              <a href="/control/site_editor?content_type=page&id='.$edit_page_parent_id.'" class="btn btn-default" role="button">Rediger side</a>
                              <button type="submit" class="btn btn-danger" '.$edit_page_required_disable.' name="handel" value="rm">Fjern</button>
                              <button type="submit" class="btn btn-default" name="handel" value="mv_up"><span class="glyphicon glyphicon-arrow-up"></span></button>
                              <button type="submit" class="btn btn-default" name="handel" value="mv_dw"><span class="glyphicon glyphicon-arrow-down"></span></button></form>';

                            // Check if there is pages under this menu point
                            $stmt2 = $conn->prepare("SELECT ReplaceDBnavi.*, ReplaceDBnavi_name.*
                                                        FROM ReplaceDBnavi
                                                        INNER JOIN ReplaceDBnavi_name ON ReplaceDBnavi.id=ReplaceDBnavi_name.parent_id 
                                                        WHERE ReplaceDBnavi.place = ?
                                                        ORDER BY navi_order;");
                            $stmt2->execute(array($row['name']));
                            if ($stmt2->rowCount() > 0) {                                
                                foreach($stmt2->fetchAll() as $row2) {
                                    $edit_page_id = $row2['id'];
                                    $edit_page_parent_id = $row2['parent_id'];
                                    $edit_page_name = $row2['name'];
                                    $edit_page_lang = $row2['language'];
                                    $edit_page_required = $row2['required'];
                                    $edit_page_navi_order = $row2['navi_order'];
                                    $edit_page_link = $row2['link'];
                                    if ($edit_page_navi_order_temp != $edit_page_navi_order) {
                                        $page_edit_text = $page_edit_text .'<br>';
                                    }
                                    
                                    if ($edit_page_required == '1') {
                                        /* if the page is required the user cannot edit this
                                        */
                                        $edit_page_required_disable = 'disabled';
                                    }

                                    $page_edit_text = $page_edit_text . '<form style="padding-left:20px;" class="form-inline" onsubmit="return confirmDelete()" action="/control/content/master_control/page_handler" method="post">
                                        <div class="form-group">
                                        <label for="page_name"><span class="glyphicon glyphicon-arrow-right"> </span> '.$edit_page_lang.'</label>
                                            <input type="text" class="form-control" name="page_name" id="page_name" readonly value="'.$edit_page_name.'">
                                          </div>
                                          <input type="hidden" class="form-control" name="navi_order" id="navi_order" value="'.$edit_page_navi_order.'">
                                          <input type="hidden" class="form-control" name="link" id="link" value="'.$edit_page_link.'">
                                          <input type="hidden" class="form-control" name="id" id="id" value="'.$edit_page_id.'">
                                          <input type="hidden" class="form-control" name="parent_id" id="parent_id" value="'.$edit_page_parent_id.'">
                                          <a href="/control/site_editor?content_type=page&id='.$edit_page_parent_id.'" class="btn btn-default" role="button">Rediger side</a>
                                          <button type="submit" class="btn btn-danger" '.$edit_page_required_disable.' name="handel" value="rm">Fjern</button>
                                          <button type="submit" class="btn btn-default" name="handel" value="mv_up"><span class="glyphicon glyphicon-arrow-up"></span></button>
                                          <button type="submit" class="btn btn-default" name="handel" value="mv_dw"><span class="glyphicon glyphicon-arrow-down"></span></button></form>';
                                }
                            }
                            else {
                                
                            }
                        

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
            
            echo $page_edit_text . '<br><form class="form-inline" action="/control/content/master_control/page_handler" method="post">
                        <div class="form-group">
                        <label for="max_weight">Tilføj ny side</label>
                            <input type="text" class="form-control" name="page_name" id="page_name" value="">
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
        <hr />
        <div id="plugs" >         
            <h2>Plugin liste</h2>
            <?php 
                try {
                    $plugin_list = "";
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT * FROM ReplaceDBinstalled_plugins;");
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        foreach($stmt->fetchAll() as $row) {
                            $data_plugin_id = $row['id'];
                            $data_plugin_name = $row['name'];
                            $data_plugin_description = $row['description'];
                            $data_plugin_is_date = $row['date'];
                            $data_plugin_version = $row['version'];
                            
                            $plugin_list = $plugin_list . "<b>Id:</b> $data_plugin_id <b>name:</b> $data_plugin_name <b>version:</b> $data_plugin_version<br>";
                        }
                    }
                    else {
                        $plugin_list = "Ingen elementer er fundet";
                    }
                }
                catch(PDOException $e) {
                    $plugin_list = "Der er sket en fejl.";
                }
                $stmt = null;
                $conn = null;
                
                echo $plugin_list;
            ?>
        </div>
    </div>
  </div>
</div>