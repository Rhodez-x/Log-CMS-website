<?php

/**
 *
 * $title what should be the header for the form 
 * $post_handler is the path to the file that handle the information
 */
function user_data_get_change_profile_img_form($title, $post_handler = "/plugins/SCMS-uploade-plugin/core/validate_uploade") {
    return '<div id="change_profile_img" class="user_control">
        <h2>'.$title.':</h2>
            <form role="form" name="opretEventForm" action="'.$post_handler.'" 
                method="post" enctype="multipart/form-data"><div class="form-group">
                <input type="text" class="form-control sr-only" id="mode" name="mode" value="2">
                <label for="upload">Vælg billeder:</label>
                <input class="btn btn-default" name="upload[]" type="file" multiple="multiple" required />
                </div>
                <button type="submit" class="btn btn-primary">Uploade billeder</button>
            </form>
    </div>';
}

?>
