<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $get_page_name = htmlspecialchars($_GET["id"]);
    try {
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("SELECT GBone_navi_name.name, GBone_text.text
                                FROM GBone_navi_name 
                                INNER JOIN GBone_text ON GBone_navi_name.parent_id=GBone_text.parent_id
                                WHERE GBone_navi_name.name = ? AND GBone_navi_name.language = ?;");
        $stmt->execute(array($get_page_name, $_SESSION['session_language']));
        if ($stmt->rowCount() == 1) {
            foreach($stmt->fetchAll() as $row) {
                $date_from_db_page_name = $row['page_name'];
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