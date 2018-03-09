<div class="container GLOBALdesign">
        <div class="row">
            <div class="col-sm-12">
                <?php
                echo $_SESSION["contact_send"];
                unset($_SESSION["contact_send"]);
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text
                                            FROM ReplaceDBnavi_name 
                                            INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                            WHERE ReplaceDBnavi_name.name = 'contact' AND ReplaceDBnavi_name.language = ?");
                    $stmt->execute(array($_SESSION['session_language']));
                            // set the resulting array to associative
                    if ($stmt->rowCount() == 1) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo $row['text'];
                        }
                    } 
                ?>
  <form action="/content/contact/process" id="contactForm" onsubmit="return validateContactForm()" method="post">
<div class="form-group">
  	<label for="mail"><?php echo $lang_data_mail . ":" ?></label>
  	<input type="text" class="form-control" name="mail" id="mail" value="<?php echo $_SESSION["contact_mail"]; unset($_SESSION["contact_mail"]); ?>">
  	<span id="errMail" style="color:red;"><?php echo $_SESSION["contact_mail_Err"]; unset($_SESSION["contact_mail_Err"]); ?></span>
  </div>
  <div class="form-group">
  	<label for="usr"><?php echo $lang_data_name . ":" ?></label>
  	<input type="text" class="form-control" name="name" id="name" value="<?php echo $_SESSION["contact_name"]; unset($_SESSION["contact_name"]); ?>">
  	<span id="errName" style="color:red;"><?php echo $_SESSION["contact_name_Err"]; unset($_SESSION["contact_name_Err"]); ?></span>
  </div>
    <div class="form-group">
      <label for="comment"><?php echo $lang_data_comment . ":" ?></label>
      <textarea class="form-control" style="resize: none;" rows="5" name="comment" id="comment"><?php echo $_SESSION["contact_comment"]; unset($_SESSION["contact_comment"]); ?></textarea>
      <span id="errComment" style="color:red;"><?php echo $_SESSION["contact_comment_Err"]; unset($_SESSION["contact_comment_Err"]); ?></span>
    </div>
     <button type="submit" class="btn btn-success">Send</button>
  </form>
            </div>
        </div>
</div>
