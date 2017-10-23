<?php
$loginsidelevel = 5;
require_once $_SERVER['DOCUMENT_ROOT']."/570304x/x530199.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['page_name_text_edit'] = $_POST["edit_page_name"];
    $_SESSION['page_name_lang'] = $_POST["edit_page_lang"];
        if (!isset($_SESSION['page_name_text_edit']) || !isset($_SESSION['page_name_lang'])) {    
            $_SESSION['page_name_lang'] = 'DK';
        }
}
header("location: /570104z/site_editor");
?>