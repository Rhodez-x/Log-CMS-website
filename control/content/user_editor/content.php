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
        <li><a href="#plugs">Plugin liste</a></li>
        <li><a href="#edit_a_user">Rediger en bruger</a></li>
      </ul>
    </nav>
    <div class="col-sm-10">
    
    <div id="members">         
        <?php 
            try {
                /* Setup values for the loop
                *  Deffrent options for deffrend kind of user state
                */
                $text_user_active = 'Deactivate';
                $value_user_activate = 'deactivate';

                $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                /* The order of the finding members, is first those whom is active = 1
                *  They are ordered by the loginlevel, so that the adminstrators is listed first, the the regular members
                *  When this is finnsihed the members with active 0 is listed, this is the members which is deactivated.
                */
                $stmt = $conn->prepare("SELECT * FROM ReplaceDBusers WHERE id = ?;");
                $stmt->execute(array($GET_edit_user_id));
                if ($stmt->rowCount() == 1) {
                    foreach($stmt->fetchAll() as $row) {
                        $data_login_id = $row['id'];
                        $data_login_username = $row['username'];
                        $data_login_level = $row['loginlevel'];
                        $data_login_is_active = $row['active'];
                        
                        $page_edit_text = $page_edit_text . '<h2>Rediger bruger: '.$data_login_username.'</h2>
                            <form class="form-inline" onsubmit="return confirmDelete()" action="/control/content/master_control/member_handler" method="post">
                                <div class="form-group">
                        <label for="page_name">'.$edit_page_lang.'</label>
                            <input type="hidden" class="form-control" name="username" id="username" value="'.$data_login_username.'">
                          </div>
                          <input type="hidden" class="form-control" name="id" id="id" value="'.$data_login_id.'">
                          <button type="submit" class="btn btn" name="handel" value="'.$value_user_activate.'">'.$text_user_active.'</button>
                          <button type="submit" class="btn btn-danger" name="handel" value="delete">Slet</button>
                          </form>';
                    }
                    $page_edit_text .= "<h3>Rediger rettigheder for brugeren:</h3>";
                    $stmt = $conn->prepare("SELECT * FROM ReplaceDBcore_rules;");
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        foreach($stmt->fetchAll() as $row) {
                            $data_permission_id = $row['id'];
                            $data_permission_username = $row['name'];
                            //$data_permission_level = $row['permissionlevel'];
                            //$data_permission_is_active = $row['active'];
                            
                            $page_edit_text .= "$data_permission_id - $data_permission_username<br>";
                        }
                    }
                
                }
                else {
                    $page_edit_text .= "Ingen elementer er fundet";
                }
            }
            catch(PDOException $e) {
                $page_edit_text .= "Der er sket en fejl.";
            }
            $stmt = null;
            $conn = null;
            
            echo $page_edit_text;
        ?>
        <hr />
      </div>
    </div>
  </div>
</div>