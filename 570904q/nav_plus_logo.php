<?php

/*
Copy-right Jørn Guldberg
*/
function loggetind($login_level) {
    if ($login_level > 49) {
        $admin_menu = '<li><a href="/REPLACE_ME_PATH/570104z/index">Kontrolpanel</a></li>';
    }
    $navnbar = '
          <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi ' . $_SESSION['login_user'] . '
        <span class="caret"></span></a>
        <ul class="dropdown-menu" style="background-color:black;">
        <li style="color: white;"></li>
          '.$admin_menu.'
        <li><a href="/REPLACE_ME_PATH/logout">Log ud</a></li>
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
        
        </div>
      </div>
      
    </div>
  </div>';
}
// <a href="/glemt">Glemt kode?</a> is removed, as long as its only the admins which can logon no need for forgotten passwprd
/*
If a logo has to be added
<div class="container-fluid" style="background-color:#161511;">
    <img style="margin-top:50px;" class="img-responsive center-block" src="/570404v/logo.jpg" alt="logo"> 
</div>

Add flags to nav bar to select lang
<li><form style="padding-right:10px; padding-top:15px;">
    <input type="hidden" id="lang" name="lang" value="DK">
    <input type="image" name="submit" src="/570404v/dk.svg"  height="20px" border="0" alt="Submit" />
</form></li> 
<li><form style="padding-right:10px; padding-top:15px;">
        <input type="hidden" id="lang" name="lang" value="GB">
        <input type="image" name="submit" src="/570404v/gb.svg" height="20px" border="0" alt="Submit" />
</form></li> 
*/
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
            <a class="navbar-brand" href="/REPLACE_ME_PATH/index">vinylmusix.com</a>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right small">
                    <?php
                        try {
                            include($_SERVER['DOCUMENT_ROOT']."/REPLACE_ME_PATH/571204m/m530199c.php");
                            $stmt = $conn->prepare("SELECT * FROM ReplaceDBnavi WHERE Language = ? ORDER BY navi_order;");
                            $stmt->execute(array($_SESSION['session_language']));
                            if ($stmt->rowCount() > 0) {
                                foreach($stmt->fetchAll() as $row) {
                                    echo '<li><a href="/ReplaceDB/'.$row['link'].'">'.$row['name'].'</a></li>';
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
                    echo loggetind($login_level);
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
                <li>
                    <a href="/kurv" id="cart" style="margin-right:30px;" >
                            <?php
                            echo '<span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;">';
                            $session_cart_count = count( $_SESSION['session_carts']);
                            if ($session_cart_count != 0) {
                            echo '<span style="font-size:16px;">'.$session_cart_count.'</span>';
                            }
                            else {
                                echo '<span>&nbsp;</span>';
                            }
                            echo '</span>';
                            ?>
                        
                    </a>
                </li>
                
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