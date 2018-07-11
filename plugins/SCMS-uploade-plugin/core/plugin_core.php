<?php

/**
 *
 *   $title what should be the header for the form 
 *   $post_handler is the path to the file that handle the information
 *   
 *   $attached_group = We have to distincguish between the text, post or what the file is attached to,  
 *                     thefore we have to group them by something, 
 *                     This is som VARCHAR type, maincore support for text and post. 
 *
 *   $attached_id = if the uploaded file if attached to some ID, this is the id of that element. 
 *
 *   $mode 
 *   1 = Normal upload of image
 *   2 = New profile image
 *   3 = New background image
 *   4 = attach to text or post. 
 */
function SCMS_uploade_plugin_get_uploade_form($title, $mode, $post_handler = "/plugins/SCMS-uploade-plugin/core/validate_uploade", $attached_group = "" , $attached_id = 0) {
    return '<div id="change_profile_img" class="user_control">
        <h3>'.$title.':</h3>
            <form role="form" name="opretEventForm" action="'.$post_handler.'" 
                method="post" enctype="multipart/form-data"><div class="form-group">
                <input type="text" class="form-control sr-only" id="attached_id" name="attached_id" value="'.$attached_id.'">
                <input type="text" class="form-control sr-only" id="attached_group" name="attached_group" value="'.$attached_group.'">
                <input type="text" class="form-control sr-only" id="mode" name="mode" value="'.$mode.'">
                <label for="upload">Vælg billeder:</label>
                <input class="btn btn-default" name="upload[]" type="file" multiple="multiple" required />
                </div>
                <button type="submit" class="btn btn-primary">Uploade billeder</button>
            </form>
    </div>';
}

?>
