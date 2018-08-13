<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $get_page_name = htmlspecialchars($_GET["id"]);
    try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text
                                FROM ReplaceDBnavi_name 
                                INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                                WHERE ReplaceDBnavi_name.name = ? AND ReplaceDBnavi_name.language = ?;");
        $stmt->execute(array($get_page_name, $_SESSION['session_language']));
        if ($stmt->rowCount() == 1) {
            foreach($stmt->fetchAll() as $row) {
                $date_from_db_page_name = $row['name'];
                $date_from_db_page_text = $row['text'];
            }

            $web_page_name = $date_from_db_page_name; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
        }
        else {
            $date_from_db_page_text = "Page not found";
            //header('Location: /');
        }
    }
    catch(PDOException $e) {
        $date_from_db_page_text = "Error";
        //header('Location: /');
    }
    $stmt = null;
    $conn = null;
}
?>