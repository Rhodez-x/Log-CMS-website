<script src="/plugins/ckeditor/ckeditor.js"></script>
<div class="container GLOBALdesign">
<div class="row">
    <div class="col-sm-12">
 <h2>Controlpanel</h2>
    <?php echo menu_line($web_page_name); ?>
          <h3>Site editor:</h3>
        <?php echo $_SESSION["uploade_feedback"];
            unset($_SESSION["uploade_feedback"]); ?>
    <form action="/control/contain/site_editor/select" method="get" class="form-inline">
        <div class="input-group">
            <select class="form-control" name="edit_page_name" id="edit_page_name">
                <option disabled selected>Choose text for a site</option>
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
                <option disabled selected>Choose language:</option>
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
                <button type="submit" class="btn btn-defult">select</button>
    </form>
      <div class="well well-sm" style="color:black; margin-top:20px;">
                <?php
                    /* NOTE FOR THE SCRIPT
                    *  Replace the <textarea id="editor1"> with a CKEditor
                    *  instance, using default configuration.
                    */
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text
                                FROM ReplaceDBnavi_name 
                                INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                WHERE ReplaceDBnavi_name.name = ? AND ReplaceDBnavi_name.language = ?;");
                    $stmt->execute(array($_SESSION['page_name_text_edit'], $_SESSION['page_name_lang']));
                            // set the resulting array to associative
                    if ($stmt->rowCount() == 1) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo "<h3>Du er ved at redigere: ".$_SESSION['page_name_text_edit']." Sprog: ".$_SESSION['page_name_lang']."</h3>
                                <form action='/control/contain/site_editor/save' method='post'>
                                    <button class='btn btn-success' type='submit'>Save</button>
                                    <textarea name='editor1' id='editor1' rows='10' cols='80'>"
                                        . $row['text'] . 

                                    "</textarea>
                                    <script>
                                        CKEDITOR.replace( 'editor1' );
                                    </script>
                                    <button class='btn btn-success' type='submit'>Save</button>
                                </form>";
                        }
                    }
                    else {
                        echo "<h3>Vælg hvilken side du vil redigere</h3>"; 
                    } 
                ?>
        </div>
    </div>
  </div>
</div>