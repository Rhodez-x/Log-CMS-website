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
            <select class="form-control" name="id" id="id">
                <option disabled selected>Vælg hvilken side</option>
                <?php
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.id, ReplaceDBnavi_name.name, ReplaceDBtext.text
                                FROM ReplaceDBnavi_name 
                                INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                GROUP BY ReplaceDBnavi_name.name;");
                    $stmt->execute();
                            // set the resulting array to associative
                    if ($stmt->rowCount() > 0) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
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
            <input type='hidden' class='form-control' name='content_type' id='content_type' value='page'>
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
                            $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text, ReplaceDBtext.parent_id, ReplaceDBtext.description, ReplaceDBnavi.place, ReplaceDBnavi.link
                                    FROM ReplaceDBnavi_name 
                                    INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                    INNER JOIN ReplaceDBnavi ON ReplaceDBnavi.id=ReplaceDBtext.parent_id
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
                                    $text_link = $row['link'];
                                    $_SESSION['category_type'] = "page";
                                    $make_page_subpage = get_sub_page_menu($row['place']);

                                }
                                else if ($_SESSION['page_content_type'] == "post") {
                                    $text_parant_id = $row['id'];
                                    $_SESSION['category_type'] = $row['category'];
                                }
                                $text_title = $row['name'];
                                $text_description = $row['description'];
                                $text_thumbnail = $row['thumbnail'];
                            }
                        }

                    }
                    else {
                        $temp_category_type = clean_input_text($_GET["category_type"]);
                        if (strlen($temp_category_type) < 32) {
                            $_SESSION['category_type'] = $temp_category_type;
                        }
                        else {
                            echo '<h2>OBS: Kategori navnet er for langt</h2>';
                            $_SESSION['category_type'] = "post";
                            $available_to_edit = false;
                        }
                    }
                    if (($_SESSION['page_parent_id'] == "new" && $_SESSION['page_content_type'] == "page")) {
                        $available_to_edit = false;
                    }

                    if ($available_to_edit) {

                    echo "<h3>Du er ved at redigere: ".$text_title." Sprog: ".$_SESSION['page_name_lang']."</h3>
                        <br>
                        <form action='/control/content/site_editor/save' method='post'>
                        <label for='titel'>Læg denne siden under menuen:</label>
                        $make_page_subpage
                        <div class='form-group'>
                            <label for='link'>Link:</label>
                            <input type='text' class='form-control' name='link' id='link' value='".$text_link."'>
                        </div>

                        <div class='form-group'>
                        <button class='btn btn-success' type='submit'>Gem</button>
                        </div>
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
                        
                        if (isset($_SESSION[selected_img_id])) 
                        {
                            echo "<br><form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/request_move_image' onsubmit='return confirmAction()' method='post'>
                                    <input type='hidden' class='form-control' name='parent_id' id='parent_id' value='".$text_parant_id."'>
                                    <input type='hidden' class='form-control' name='position' id='position' value='0'>
                                    <button type='submit' class='btn btn-block btn-warning'>Placer billedet først</button>
                                    </form><br>";
                        }
                        
                        $image_position = 1;
                        $stmt = $conn->prepare("SELECT * FROM ReplaceDBimages WHERE attached_group = ? AND attached_id = ? ORDER BY show_order;");
                        $stmt->execute(array($_SESSION['category_type'], $text_parant_id));
                        // set the resulting array to associative
                        if ($stmt->rowCount() > 0) {
                            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach($stmt->fetchAll() as $row) {
                                
                                $button_thumbnail = "";
                                

                                if ($text_thumbnail == $row['dir']) {
                                    $button_thumbnail = "<button type='submit' class='btn btn-block btn-info'>Billede er thumbnail</button>";
                                } 
                                else if ($_SESSION['page_content_type'] == "post") {
                                    $button_thumbnail = "<form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/update_use_of_image' onsubmit='return confirmAction()' method='post'>
                                    <input type='hidden' class='form-control' name='id' id='id' value='".$text_parant_id."'>
                                    <input type='hidden' class='form-control' name='dir' id='dir' value='".$row['dir']."'>
                                    <button type='submit' class='btn btn-block btn-default'>Brug som thumbnail</button>
                                    </form>";
                                }
                                        
                                if ($row['img_text'] != "") 
                                {
                                    $img_text_from_db = '<strong>Billede tekst:</strong><br>'.nl2br($row['img_text']).'<br><br>';
                                }   
                                else 
                                {
                                    $img_text_from_db = "";
                                }

                                if ($_SESSION[selected_img_id] == $row['id']) 
                                {
                                    $button_move_image = "<form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/select_img_for_move' onsubmit='return confirmAction()' method='post'>
                                    <input type='hidden' class='form-control' name='id' id='id' value='-1'>
                                    <button type='submit' class='btn btn-block btn-primary'>Billede valgt (annullere)</button>
                                    </form>";
                                }
                                else 
                                {
                                    $button_move_image = "<form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/select_img_for_move' onsubmit='return confirmAction()' method='post'>
                                    <input type='hidden' class='form-control' name='id' id='id' value='".$row['id']."'>
                                    <button type='submit' class='btn btn-block btn-default'>Flyt position</button>
                                    </form>";

                                }

                                if (isset($_SESSION[selected_img_id])) 
                                {
                                    $place_img_here = "<br><form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/request_move_image' onsubmit='return confirmAction()' method='post'>
                                            <input type='hidden' class='form-control' name='parent_id' id='parent_id' value='".$text_parant_id."'>
                                            <input type='hidden' class='form-control' name='position' id='position' value='".$image_position."'>
                                            <button type='submit' class='btn btn-block btn-warning'>Placer billedet her</button>
                                            </form><br>";
                                    $image_position++;
                                }
                                

                                echo "<div class='row' style='padding-bottom: 20px;'>
                                        <div class='col-sm-2'> 
                                            <a href='".$row['dir']."' target='_blank'>
                                                <img class='img-responsive'  style='padding-bottom:6px;' src='".$row['dir']."' alt='".$row['img_text']."' style='max-height:150px;'>
                                            </a> 
                                        </div>
                                        <div class='col-sm-7'>
                                            <strong>URL:</strong><br>".$row['dir']. "<br><br>
                                            $img_text_from_db
                                        </div>
                                        <div class='col-sm-3'>

                                            $button_move_image
                                            $button_thumbnail
                                            <form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/remove_img' onsubmit='return confirmAction()' method='post'>
                                            <button type='button' class='btn btn-default btn-block' data-toggle='modal' data-target='#myModal' onclick='set_image_id(".$row['id'].")'>Tilføj tekst</button>
                                            </form>
                                            <form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/remove_img' onsubmit='return confirmAction()' method='post'>
                                            <input type='hidden' class='form-control' name='id' id='id' value='".$row['id']."'>
                                            <button type='submit' class='btn btn-block btn-default'>Tilføj kopi i høj opløsning</button>
                                            </form>
                                            <form class='form-inline' action='/plugins/SCMS-uploade-plugin/core/remove_img' onsubmit='return confirmAction()' method='post'>
                                            <input type='hidden' class='form-control' name='id' id='id' value='".$row['id']."'>
                                            <button type='submit' class='btn btn-block btn-danger'>Fjern</button>
                                            </form>
                                        </div>
                                    </div>$place_img_here";
                            }
                        }
                        else {
                            echo "Der er ikke nogle billeder tilknyttet";
                        }
                        if (!($_SESSION['page_parent_id'] == "new")) {
                            // args = Title, mode, attached_group, attached_id
                            echo "<Hr />" . SCMS_uploade_plugin_get_uploade_form("Tilføj billede", 
                                                                                 4, 
                                                                                 $attached_group = $_SESSION['category_type'], 
                                                                                 $attached_id = $text_parant_id);

                        }
                        else {
                            echo "<Hr /> Du skal gemme inden du kan tilknytte billeder";
                        }
                    }
                ?>
        </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Tilføj billedetekst:</h4>
    </div>
    <div class="modal-body">
      <form class='form' action='/plugins/SCMS-uploade-plugin/core/remove_img' onsubmit='return confirmAction()' method='post'>
         <div class="form-group">
          <label for="image_text_comment">Text:</label>
          <textarea class="form-control" rows="5" style="resize:none;" id="image_text_comment"></textarea>
        </div> 
        <input type='hidden' class='form-control' name='set_image_id_input' id='set_image_id_input' value=''>
        <button type='submit' class='btn btn-block btn-default'>Tilføj tekst</button>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
  
</div>
</div>
<script>

function set_image_id(id) 
{
    $("#set_image_id_input").val(id);
    var hh = $("#set_image_id_input").val();
    $("#image_text_comment").text(hh);
}
</script>