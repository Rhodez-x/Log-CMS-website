<?php

function menu_line($active){
    $tabs=array("Admin side"=> '/570104z/index', "Indstillinger" => '/570104z/setup', "Rediger side" => '/570104z/site_editor', "Master control" => '/570104z/master_control');
    $return_string = '<ul class="nav nav-tabs">';
    foreach($tabs as $x=>$x_value) {
        if ($x == $active) {
            $return_string = $return_string . '<li class="active"><a href="'.$x_value.'">'.$x.'</a></li>' ;
        } else {
            $return_string = $return_string . '<li><a href="'.$x_value.'">'.$x.'</a></li>' ;
        }
    }

    return $return_string = $return_string . '</ul>';
}

?>