<?php
require_once (SITE_ROOT_PATH."/570304x/x530199.php"); // kernefilen
if(session_destroy()) // Destroying All Sessions
{
header("Location: /"); // Redirecting To Home Pageø
}
?>