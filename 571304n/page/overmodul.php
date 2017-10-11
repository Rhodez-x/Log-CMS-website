<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $get_page_name = htmlspecialchars($_GET["id"]);
    try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("SELECT * FROM ReplaceDBtext WHERE page_name = ? AND language = ? AND required = 0");
        $stmt->execute(array($get_page_name, $_SESSION['session_language']));
        if ($stmt->rowCount() == 1) {
            foreach($stmt->fetchAll() as $row) {
                $date_from_db_page_name = $row['page_name'];
                $date_from_db_page_text = $row['text'];
            }
        }
        else {
            $date_from_db_page_text = "Page not found";
            //header('Location: /');
        }
    }
    catch(PDOException $e) {
        $date_from_db_page_text = "Error $MAIN_DB_HOST";
        //header('Location: /');
    }
    $stmt = null;
    $conn = null;
}
?>