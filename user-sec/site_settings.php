<?php
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  Version 6.1.0: Release of major, not compatiple with earlier realises. 
*  Full release-notes se the git repository
*/

/*
*  This is the settings for the specific site
*/


define('MAIN_DB_HOST', 'mysql'); // host
define('MAIN_DB_USER', 'my_sql_user'); // user
define('MAIN_DB_PASS', 'my_sql_password'); // pw
define('MAIN_DB_DATABASE_NAME', 'MaincoreDBdev5'); // Database name
define('MAIN_DB_PREFIX', 'ReplaceDB');

/*
*  Constants maybe have to be loaded from the DB 
*/
define('DEFAULT_PROFILE_IMG', '/design/default-profile.png'); // Default lang
define('DEFAULT_LANG', 'DK'); // Default lang
define('GLOBAL_META_LOCAL', 'da-DK'); 
define('GLOBAL_CONTACT_EMAIL', "kontakt@guld-berg.dk");
define('GLOBAL_FIRM_NAME', "Sandsized Maincore-dev");
define('GLOBAL_FIRM_DESCRIPTION', "Sandsized CMS");
define('GLOBAL_BACKUP_FILE_NAME', "Sandsized_CMS");

define('GLOBAL_FIRM_IMAGE_META', "Sandsized CMS");
define('GLOBAL_URL', "https://guld-berg.dk");

?>