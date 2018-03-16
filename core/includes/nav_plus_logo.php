<?php
/** Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*  @version 5.0.0 - Major update, not compatiple with earlier realises. 
*  Full release-notes se the github repository
*/
function loggetind() {
    //if (LOGIN_LEVEL > 49) {
    //    $admin_menu = '<li><a href="/control/index">Kontrolpanel</a></li>';
    //}
    $navnbar = '
          <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi ' . $_SESSION['login_user'] . '
        <span class="caret"></span></a>
        <ul class="dropdown-menu" style="background-color:black;">
        <li style="color: white;"></li>
        <li><a href="/control/index">Kontrolpanel</a></li>
          '.$admin_menu.'
        <li><a href="/logout">Log ud</a></li>
        </ul>
      </li>';
    return $navnbar;
}

function loginBoks() {
echo '<div class="modal fade" id="myModal" role="dialog" style="z-index: 9999;">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div style="color:black;" class="modal-body">
        <form role="form">
         <div class="form-group">
            <label for="brugernavn">Brugernavn:</label>
            <input type="text" class="form-control" id="brugernavn">
         </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password">
        </div>
        <button type="submit" id="loginbutton" class="btn btn-default">Login</button>
        <span class="text-danger" id="loginfeedback"></span>
        </form>
        <a href="/user-recovery">Glemt password?</a>
        
        </div>
      </div>
      
    </div>
  </div>';
}
?>

<div class="container">
    
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
                <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index"><?php echo GLOBAL_FIRM_NAME; ?></a>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right small">
                    <?php
                        try {
                            $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
                            $stmt = $conn->prepare("SELECT GBone_navi.link, GBone_navi_name.name
                                                    FROM GBone_navi
                                                    INNER JOIN GBone_navi_name ON GBone_navi.id=GBone_navi_name.parent_id 
                                                    WHERE GBone_navi.place = 'standart'
                                                    ORDER BY navi_order;");
                            $stmt->execute(array($_SESSION['session_language']));
                            if ($stmt->rowCount() > 0) {
                                foreach($stmt->fetchAll() as $row) {
                                    echo '<li><a href="/'.$row['link'].'">'.$row['name'].'</a></li>';
                                }
                            }
                        }
                        catch(PDOException $e) {
                                $feedback = "Der er sket en fejl.";
                        }
                        $stmt = null;
                        $conn = null;
                    ?>
                    <?php
                    if(isset($_SESSION['login_user'])) {
                    // Hvis man er logget ind
                    echo loggetind(LOGIN_LEVEL);
                    }
                    // Her kommer der en besked om at man er logget ud.
                    if($_SESSION["loggetud"] == 1) {
                        echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Du er nu logget ud</strong>
                        </div>';
                        $_SESSION["loggetud"] = 0;
                    }
                    ?>
                
            </ul>
        </div>
        </div>
    </nav>
    <?php
        if(!isset($_SESSION['login_user'])) { 
            loginBoks();
        }   
    ?>
</div>