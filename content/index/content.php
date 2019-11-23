<div class="container GLOBALdesign">
        <div class="row">
            <div class="col-sm-12">
                <?php
                    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                    $stmt = $conn->prepare("SELECT ".MAIN_DB_PREFIX."navi_name.name, ".MAIN_DB_PREFIX."text.text, ".MAIN_DB_PREFIX."navi.permission
                            FROM ".MAIN_DB_PREFIX."navi_name 
                            INNER JOIN ".MAIN_DB_PREFIX."text ON ".MAIN_DB_PREFIX."navi_name.parent_id=".MAIN_DB_PREFIX."text.parent_id
                            INNER JOIN ".MAIN_DB_PREFIX."navi ON ".MAIN_DB_PREFIX."navi.id=".MAIN_DB_PREFIX."navi_name.parent_id
                            WHERE ".MAIN_DB_PREFIX."navi.link = 'index' AND ".MAIN_DB_PREFIX."navi_name.language = ? AND link != place;");
                    $stmt->execute(array($_SESSION['session_language']));
                            // set the resulting array to associative
                    if ($stmt->rowCount() == 1) 
                    {
                        foreach($stmt->fetchAll() as $row) 
                        {
                            if (check_permission($row['permission']) )
                            {
                                echo $row['text'];
                            }
                            else 
                            {
                                echo "<h2>Page is under construction</h2>";
                            }
                        }
                    }
                    else 
                    {
                        echo "<h2>Error 404</h2> Siden er ikke fundet";
                    }
                ?>
            </div>
    </div>
</div>