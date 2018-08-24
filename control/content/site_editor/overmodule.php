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

function get_sub_page_menu($pagename) {
    /*
     * This fuction is returning the selector for a page to be a sub page under som page
     * It detedcts if the page is already a subpage for a page. 
     */
    
    $make_page_subpage_pages = "";
    $is_already_subpage = false;
    $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
    $stmt = $conn->prepare("SELECT ReplaceDBnavi_name.id, ReplaceDBnavi_name.name, ReplaceDBtext.text, ReplaceDBnavi.place
                FROM ReplaceDBnavi_name 
                INNER JOIN ReplaceDBtext ON ReplaceDBnavi_name.parent_id=ReplaceDBtext.parent_id
                INNER JOIN ReplaceDBnavi ON ReplaceDBnavi.id=ReplaceDBtext.parent_id
                WHERE ReplaceDBnavi.place = 'standart' GROUP BY ReplaceDBnavi_name.name;");
    $stmt->execute();
            // set the resulting array to associative
    if ($stmt->rowCount() > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            if ($pagename == $row['name']) {
                $make_page_subpage_pages .= "<option value='".$row['name']."' selected>".$row['name']."</option>";
                $is_already_subpage = true;
            }
            else {
                $make_page_subpage_pages .= "<option value='".$row['name']."'>".$row['name']."</option>";
            }
        }
        if (!$is_already_subpage) {
            $make_page_subpage_pages = '<option disabled selected>Vælg hvilken side</option>'.$make_page_subpage_pages;
        }

    }                                                
    
    return '<div class="input-group">
            <select class="form-control" name="sub_page" id="sub_page">
                '.$make_page_subpage_pages.'
            </select>
            </div>';
    
}
?>
