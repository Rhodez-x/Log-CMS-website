<script src="/plugins/ckeditor/ckeditor.js"></script>
<div class="container GLOBALdesign">
<div class="row">
    <div class="col-sm-12">
 <h2>Controlpanel</h2>
    <?php echo menu_line($web_page_name); ?>
          <h3>Site editor:</h3>
        <?php echo $_SESSION["uploade_feedback"];
            unset($_SESSION["uploade_feedback"]); ?>
    <form action="/control/site_editor" method="get" class="form-inline">
        <div class="input-group">
            <select class="form-control" name="edit_page_name" id="edit_page_name">
                <option disabled selected>Vælg hvilken side</option>
                <?php
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text
                                FROM ReplaceDBnavi_name 
                                INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                GROUP BY ReplaceDBnavi_name.name;");
                    $stmt->execute();
                            // set the resulting array to associative
                    if ($stmt->rowCount() > 0) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo "<option>".$row['name']."</option>";
                        }
                    } 
                ?>
            </select>
            </div>
            <div class="input-group">
            <select class="form-control" name="edit_page_lang" id="edit_page_lang">
                <option disabled selected>Vælg hvilket sprog:</option>
                <?php
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT * FROM ReplaceDBcountry WHERE active = 1;");
                    $stmt->execute();
                            // set the resulting array to associative
                    if ($stmt->rowCount() > 0) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo "<option value='".$row['code']."'>".$row['name']."</option>";
                        }
                    } 
                ?>
            </select>
            </div>
                <button type="submit" class="btn btn-defult">Vælg</button>
    </form>
      <div class="well well-sm" style="color:black; margin-top:20px;">
                <?php
                    /* NOTE FOR THE SCRIPT
                    *  Replace the <textarea id="editor1"> with a CKEditor
                    *  instance, using default configuration.
                    */
                    $text_title = $text_description = $text_thumbnail = "";
                    if (!($_SESSION['page_parent_id'] == "new" && $_SESSION['page_content_type'] == "post")) {
                        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                        if ($_SESSION['page_content_type'] == "page") {
                            $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text, ReplaceDBtext.parent_id, ReplaceDBtext.description
                                    FROM ReplaceDBnavi_name 
                                    INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                    WHERE ReplaceDBnavi_name.parent_id = ? AND ReplaceDBnavi_name.language = ? AND ReplaceDBtext.content_group = ?;");
                            $stmt->execute(array($_SESSION['page_parent_id'], $_SESSION['page_name_lang'], $_SESSION['page_content_type']));
                            
                        }
                        else if ($_SESSION['page_content_type'] == "post") {
                            $stmt = $conn->prepare("SELECT * FROM ReplaceDBpost WHERE id = ? AND language = ?;");
                            $stmt->execute(array($_SESSION['page_parent_id'], $_SESSION['page_name_lang']));

                        }
                                            // set the resulting array to associative
                        if ($stmt->rowCount() == 1) {
                            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach($stmt->fetchAll() as $row) {
                                if ($_SESSION['page_content_type'] == "page") {
                                    $text_parant_id = $row['parent_id'];
                                }
                                else if ($_SESSION['page_content_type'] == "post") {
                                    $text_parant_id = $row['id'];
                                }
                                $text_title = $row['name'];
                                $text_description = $row['description'];
                                $text_thumbnail = $row['thumbnail'];
                            }
                        }

                    }


                    echo "<h3>Du er ved at redigere: ".$text_title." Sprog: ".$_SESSION['page_name_lang']."</h3>
                        <form action='/control/content/site_editor/save' method='post'>
                        <button class='btn btn-success' type='submit'>Gem</button>
                        <div class='form-group'>
                        <label for='titel'>Title:</label>
                        <input type='text' class='form-control' name='text_title' id='text_title' value='".$text_title."'>
                        </div>
                        
                         <div class='form-group'>
                          <label for='comment'>Kort beskrivelse:</label>
                          <textarea class='form-control' rows='5' name='comment' id='comment'>".$text_description."</textarea>
                        </div> 
                        
                        <label for='titel'>Tekst:</label>
                            <textarea name='editor1' id='editor1' rows='10' cols='80'>"
                                . $row['text'] . 

                            "</textarea>
                            <script>
                                CKEDITOR.replace( 'editor1' );
                            </script>
                            <button class='btn btn-success' type='submit'>Gem</button>
                        </form>";


                        echo "<h3>Tilknyttet billeder:</h3>";
                        $stmt = $conn->prepare("SELECT * FROM ReplaceDBimages WHERE attached_group = 'page' AND attached_id = ?;");
                        $stmt->execute(array($text_parant_id));
                        // set the resulting array to associative
                        if ($stmt->rowCount() > 0) {
                            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach($stmt->fetchAll() as $row) {
                                
                                $button_thumbnail = "";

                                if ($text_thumbnail == $row['dir']) {
                                    $button_thumbnail = "Billede er thumbnail";
                                } 
                                else if ($_SESSION['page_content_type'] == "post") {
                                    $button_thumbnail = "<form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/update_use_of_image' onsubmit='return confirmAction()' method='post'>
                                    <input type='hidden' class='form-control' name='id' id='id' value='".$text_parant_id."'>
                                    <input type='hidden' class='form-control' name='dir' id='dir' value='".$row['dir']."'>
                                    <button type='submit' class='btn btn-default'>Brug som thumbnail</button>
                                    </form>";
                                }
                                        

                                echo "<div class='row'>
                                        <div class='col-sm-2'> 
                                            <a href='".$row['dir']."' target='_blank'>
                                                <img class='img-responsive'  style='padding-bottom:6px;' src='".$row['dir']."' alt='".$row['img_text']."' style='max-height:150px;'>
                                            </a> 
                                        </div>
                                        <div class='col-sm-6'>
                                            <strong>URL:</strong><br>".$row['dir']. "
                                        </div>
                                        <div class='col-sm-2'>
                                            $button_thumbnail
                                        </div>
                                        <div class='col-sm-2'>
                                            <form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/remove_img' onsubmit='return confirmAction()' method='post'>
                                            <input type='hidden' class='form-control' name='id' id='id' value='".$row['id']."'>
                                            <button type='submit' class='btn btn-danger'>Fjern</button>
                                            </form>
                                        </div>
                                    </div>";
                            }
                        }
                        else {
                            echo "Der er ikke nogle billeder tilknyttet";
                        }
                                // args = Title, mode, attached_group, attached_id
                        echo "<Hr />" . SCMS_uploade_plugin_get_uploade_form("Tilføj billede", 4, $attached_group = "page", $attached_id = $text_parant_id);
                ?>
        </div>
    </div>
  </div>
</div>