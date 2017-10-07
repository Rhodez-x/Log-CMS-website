<div class="container GLOBALdesign">
        <div class="row">
            <div class="col-sm-12">
                <?php
                echo 'hello<br><br><br><br>hello';
                    include($_SERVER['DOCUMENT_ROOT']."/REPLACE_ME_PATH/571204m/m530199c.php");
                    $stmt = $conn->prepare("SELECT text FROM ReplaceDBtext WHERE page_name = 'index' AND language = ?;");
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