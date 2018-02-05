<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/
function menu_line($active){
    $tabs=array(
        /* Menu list for controlpanel
        *  name, path, and loginlevel,
        * If the user is not an admin, the tabs will not be avible.
        */ 
        array("Min side", '/control/index', 9),
        array("Mine indstillinger", '/control/user_control', 9), 
        array("Rediger side", '/control/site_editor', 49),
        array("Master control", '/control/master_control', 49)
        );
    $return_string = '<ul class="nav nav-tabs">';
    foreach($tabs as $tab) {
        if ($tab[2] < LOGIN_LEVEL) {
            if ($tab[0] == $active) {
                $return_string = $return_string . '<li class="active"><a href="'.$tab[1].'">'.$tab[0].'</a></li>' ;
            } else {
                $return_string = $return_string . '<li><a href="'.$tab[1].'">'.$tab[0].'</a></li>' ;
            }
        }
    }

    return $return_string = $return_string . '</ul>';
}

?>