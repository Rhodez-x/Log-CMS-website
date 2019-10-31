<div class="container GLOBALdesign">
        <div class="row">
            <div class="col-sm-12">
                <?php
                    define("wow", "".MAIN_DB_PREFIX."");
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT ".MAIN_DB_PREFIX."navi_name.name, ".MAIN_DB_PREFIX."text.text
                                            FROM ".MAIN_DB_PREFIX."navi_name 
                                            INNER JOIN ".MAIN_DB_PREFIX."text ON 
                                            ".MAIN_DB_PREFIX."navi_name.parent_id=".MAIN_DB_PREFIX."text.parent_id
                                            WHERE ".MAIN_DB_PREFIX."navi_name.name = 'Forside' 
                                            AND ".MAIN_DB_PREFIX."navi_name.language = ?");
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