<?php
require_once $_SERVER['DOCUMENT_ROOT']."/control/content/functions.php";
require_once $_SERVER['DOCUMENT_ROOT']."/plugins/SCMS-uploade-plugin/core/plugin_core.php";

$available_to_edit = true; // This is set to false, if some fatal setting occur

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // By deafult content type can be text or post, 
    // where as text, is the content of a page, and blog is the contet 
    // of some "blogpost". 
    if (!empty($_GET["content_type"])) {
        $_SESSION['page_content_type'] = clean_input_text($_GET["content_type"]);
    }

    if (!empty($_GET["id"])) {
        $_SESSION['page_parent_id'] = clean_input_text($_GET["id"]);
    }

    if (empty($_SESSION['page_name_lang'])) {    
        $_SESSION['page_name_lang'] = 'DK';
    }

}
?>
