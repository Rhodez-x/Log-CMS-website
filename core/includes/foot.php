<?php
    echo '<footer class="container text-center">
    <div class="container" style="padding-top:25px;">© Copyright 2004 - '.date('Y').' '.GLOBAL_FIRM_NAME.' | All Rights Reserved <a href="#" data-toggle="modal" data-target="#myModal" style="font-size: 20px;"><span class="glyphicon glyphicon-log-in"></span></a></div></footer>'; 
    
    if (!empty($sidenspecialescript)) {
    	include $_SERVER['DOCUMENT_ROOT']. "/" .$sidenssti.$sidenspecialescript;
    }
?>

    </body>
</html>