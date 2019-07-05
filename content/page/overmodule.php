<?php
$get_req_string = "";
if (strlen($_GET["req"]) <= 4096) {
    $req_array = explode('/', $_GET["req"]);
}
else {
    $req_array = array("Error");
}

if (count($req_array) == 1) {
    $get_page_name = urlencode((str_replace(".php", "",$req_array[0])));
    $get_req_string = count($req_array);
}
else if (count($req_array) > 1) {
    $get_page_name = urlencode($req_array[0]);
    $get_req_string = urlencode(str_replace(".php", "",$req_array[1]));
}
else {
    $get_page_name = "error";
}

try {
    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
    $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.name, ReplaceDBtext.text
                            FROM ReplaceDBnavi_name 
                            INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                            INNER JOIN ReplaceDBnavi ON ReplaceDBnavi.id=ReplaceDBnavi_name.parent_id
                            WHERE ReplaceDBnavi.link = ? AND ReplaceDBnavi_name.language = ? AND link != place;");
    $stmt->execute(array($get_page_name, $_SESSION['session_language']));
    if ($stmt->rowCount() == 1) {
        foreach($stmt->fetchAll() as $row) {
            $date_from_db_page_name = $row['name'];
            $date_from_db_page_text = $row['text'];
        }

        $web_page_name = $date_from_db_page_name; // Sidens navn, dette navn afgører hvilken fane i menuen der er aktiv. (Skal være identisk med det i Mysql)
    }
    else {
        $web_page_name = "Siden ikke fundet";
        $date_from_db_page_text = "<h2>Error 404</h2> Siden er ikke fundet";
        //header('Location: /');
    }
}
catch(PDOException $e) {
    $date_from_db_page_text = "Error";
    //header('Location: /');
}
$stmt = null;
$conn = null;
?>