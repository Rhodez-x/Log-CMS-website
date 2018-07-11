<?php
require_once $_SERVER['DOCUMENT_ROOT']."/control/content/functions.php";
require_once $_SERVER['DOCUMENT_ROOT']."/plugins/SCMS-uploade-plugin/core/plugin_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // By deafult content type can be text or post, 
    // where as text, is the content of a page, and blog is the contet 
    // of some "blogpost". 
    $_SESSION['page_content_type'] = clean_input_text($_GET["content_type"]);
    $_SESSION['page_name_text_edit'] = clean_input_text($_GET["edit_page_name"]);
    $_SESSION['page_name_lang'] = clean_input_text($_GET["edit_page_lang"]);
    
    if (!isset($_SESSION['page_name_text_edit']) || !isset($_SESSION['page_name_lang'])) {    
        $_SESSION['page_name_lang'] = 'DK';
    }

}
?>
