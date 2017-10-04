<?php
$loginsidelevel = 2;
require_once $_SERVER['DOCUMENT_ROOT']."/REPLACE_ME_PATH/570304x/x530199.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['page_name_text_edit'] = $_POST["edit_page_name"];
    $_SESSION['page_name_lang'] = $_POST["edit_page_lang"];
        if (!isset($_SESSION['page_name_text_edit']) || !isset($_SESSION['page_name_lang'])) {    
            $_SESSION['page_name_lang'] = 'DK';
        }
}
header("location: /REPLACE_ME_PATH/570104z/site_editor");
?>