<?php
require_once $_SERVER['DOCUMENT_ROOT']."/control/content/functions.php";
require_once $_SERVER['DOCUMENT_ROOT']."/plugins/SCMS-uploade-plugin/core/plugin_core.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // By deafult content type can be text or post, 
    // where as text, is the content of a page, and blog is the contet 
    // of some "blogpost". 
    $_SESSION['page_content_type'] = clean_input_text($_GET["content_type"]);
    $_SESSION['page_parent_id'] = clean_input_text($_GET["id"]);
    $_SESSION['page_name_lang'] = clean_input_text($_GET["edit_page_lang"]);
    
    if (empty($_SESSION['page_name_lang'])) {    
        $_SESSION['page_name_lang'] = 'DK';
    }

}
?>
