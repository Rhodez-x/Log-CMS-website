<?php
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 4.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/

require_once ($_SERVER['DOCUMENT_ROOT']."/core/system_core.php"); // kernefilen
if(session_destroy()) // Destroying All Sessions
{
header("Location: /"); // Redirecting To Home Pageø
}
?>