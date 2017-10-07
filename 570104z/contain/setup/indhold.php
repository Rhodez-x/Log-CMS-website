<div class="container GLOBALdesign">
     <h2>Controlpanel</h2>
    <?php echo menu_line($sidenavn);
          echo $_SESSION["uploade_feedback"];
          unset($_SESSION["uploade_feedback"]);?>
    
    <div class="row">
    <nav class="col-sm-3" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
        <li><h3>Oversigt</h3></li>
        <li><a href="#sider">Tilføj/fjern sider</a></li>
      </ul>
    </nav>
    <div class="col-sm-9"> 
      <div id="sider" style="padding-top:50px;">         
        <h1>Tilføj/fjern sider</h1>
        <?php 
            try {
                $page_edit_text = '';
                $edit_page_navi_order_temp = "1";
                include($_SERVER['DOCUMENT_ROOT']."/REPLACE_ME_PATH/571204m/m530199c.php");
                $stmt = $conn->prepare("SELECT * FROM ReplaceDBnavi ORDER BY navi_order, language;");
                $stmt->execute();
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
                        
                        $page_edit_text = $page_edit_text . '<form class="form-inline" onsubmit="return confirmDelete()" action="/REPLACE_ME_PATH/570104z/contain/setup/page_handler" method="post">
                        <div class="form-group">
                        <label for="page_name">'.$edit_page_lang.'</label>
                            <input type="text" class="form-control" name="page_name" id="page_name" value="'.$edit_page_name.'">
                          </div>
                          <input type="hidden" class="form-control" name="navi_order" id="navi_order" value="'.$edit_page_navi_order.'">
                          <input type="hidden" class="form-control" name="link" id="link" value="'.$edit_page_link.'">
                          <input type="hidden" class="form-control" name="id" id="id" value="'.$edit_page_id.'">
                          <button type="submit" class="btn btn-default" name="handel" value="edit">Rediger</button>';
                          
                          if ($edit_page_lang == 'DK') {
                          $page_edit_text = $page_edit_text . '<button type="submit" class="btn btn-danger" '.$edit_page_required_disable.' name="handel" value="rm">Fjern</button>
                          <button type="submit" class="btn btn-default" name="handel" value="mv_up"><span class="glyphicon glyphicon-arrow-up"></span></button>
                          <button type="submit" class="btn btn-default" name="handel" value="mv_dw"><span class="glyphicon glyphicon-arrow-down"></span></button></form>';
                          }
                          else {
                              $page_edit_text = $page_edit_text . '</form>';
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
            
            echo $page_edit_text . '<br><form class="form-inline" action="/REPLACE_ME_PATH/570104z/contain/setup/page_handler" method="post">
                        <div class="form-group">
                        <label for="max_weight">Dansk titel </label>
                            <input type="text" class="form-control" name="page_name_dk" id="page_name" value="">
                          </div>
                        <div class="form-group">
                        <label for="max_weight">Engelsk titel </label>
                            <input type="text" class="form-control" name="page_name_en" id="page_name" value="">
                          </div>
                          <input type="hidden" class="form-control" name="add" id="add" value="1">
                          <button type="submit" class="btn btn-default">Tilføj</button></form>';
        ?>
      </div>
    </div>
  </div>
</div>