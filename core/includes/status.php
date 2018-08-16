<div style="margin-top: 100px;">
<?php
// It's posible to make a msg on all pages if somethin is insert here
echo var_dump(LOGIN_PERMISSIONS);
$temp_arr = array(1);
echo serialize($temp_arr);
echo $page_permission;
echo in_array($page_permission, LOGIN_PERMISSIONS);
?>
</div>