<script src="/572004g/ckeditor/ckeditor.js"></script>
<div class="container GLOBALdesign">
<div class="row">
    <div class="col-sm-12">
 <h2>Controlpanel</h2>
    <?php echo menu_line($sidenavn); ?>
          <h3>Site editor:</h3>
        <?php echo $_SESSION["uploade_feedback"];
            unset($_SESSION["uploade_feedback"]); ?>
    <form action="/570104z/contain/site_editor/select" method="post" class="form-inline">
        <div class="input-group">
            <select class="form-control" name="edit_page_name" id="edit_page_name">
                <option disabled selected>Choose text for a site</option>
                <?php
                    include($_SERVER['DOCUMENT_ROOT']."/571204m/m530199c.php");
                    $stmt = $conn->prepare("SELECT * FROM ReplaceDBtext GROUP BY page_name;");
                    $stmt->execute();
                            // set the resulting array to associative
                    if ($stmt->rowCount() > 0) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo "<option>".$row['page_name']."</option>";
                        }
                    } 
                ?>
            </select>
            </div>
            <div class="input-group">
            <select class="form-control" name="edit_page_lang" id="edit_page_lang">
                <option disabled selected>Choose language:</option>
                <?php
                    include($_SERVER['DOCUMENT_ROOT']."/571204m/m530199c.php");
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
          <?php echo "<h3>Du er ved at redigere: ".$_SESSION['page_name_text_edit']." Sprog: ".$_SESSION['page_name_lang']."</h3>";?>
        <form action="/570104z/contain/site_editor/save" method="post">
            <button class="btn btn-success" type="submit">Save</button>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                <?php
                    include($_SERVER['DOCUMENT_ROOT']."/571204m/m530199c.php");
                    $stmt = $conn->prepare("SELECT text FROM ReplaceDBtext WHERE page_name = ? AND language = ?");
                    $stmt->execute(array($_SESSION['page_name_text_edit'], $_SESSION['page_name_lang']));
                            // set the resulting array to associative
                    if ($stmt->rowCount() == 1) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo $row['text'];
                        }
                    } 
                ?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
            <button class="btn btn-success" type="submit">Save</button>
        </form>
    </div>
    </div>
    <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_title = $_POST["editor1"];
    echo $post_title;
    }
    ?>
  </div>
</div>