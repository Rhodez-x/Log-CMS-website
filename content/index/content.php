<div class="container GLOBALdesign">
        <div class="row">
            <div class="col-sm-12">
                <?php
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text
                                            FROM ReplaceDBnavi_name 
                                            INNER JOIN ReplaceDBtext ON 
                                            ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                            WHERE ReplaceDBnavi_name.name = 'forside' 
                                            AND ReplaceDBnavi_name.language = ?");
                    $stmt->execute(array($_SESSION['session_language']));
                            // set the resulting array to associative
                    if ($stmt->rowCount() == 1) {
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchAll() as $row) {
                            echo $row['text'];
                        }
                    } 
                ?>
            </div>
    </div>
</div>