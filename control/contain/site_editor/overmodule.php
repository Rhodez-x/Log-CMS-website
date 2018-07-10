<?php
require_once $_SERVER['DOCUMENT_ROOT']."/control/contain/functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $_SESSION['page_name_text_edit'] = $_GET["edit_page_name"];
    $_SESSION['page_name_lang'] = $_GET["edit_page_lang"];
        if (!isset($_SESSION['page_name_text_edit']) || !isset($_SESSION['page_name_lang'])) {    
            $_SESSION['page_name_lang'] = 'DK';
        }
}
?>
