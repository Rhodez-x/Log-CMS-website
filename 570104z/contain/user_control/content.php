<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
*/
?>

<div class="container GLOBALdesign">
    <h2>Controlpanel</h2>
    <?php echo menu_line($web_page_name);
    echo $_SESSION["uploade_feedback"];
    unset($_SESSION["uploade_feedback"]); 

    if (!empty($_SESSION["new_user_name"])) {
        $username_form_value = $_SESSION["new_username"];
        unset($_SESSION["new_username"]);
    } 
    else {
        $username_form_value = $_SESSION["login_user"];
    }

    ?>

    <div class="row">
        <nav class="col-sm-3" id="myScrollspy">
            <ul class="nav nav-pills nav-stacked">
                <li><h3>Oversigt</h3></li>
                <li><a href="#username">Ændre brugernavn</a></li>
                <li><a href="#password">Ændre password</a></li>
                <li><a href="#profile">Ændre profiloplysninger</a></li>
            </ul>
        </nav>
        <div class="col-sm-6">
            <div id="username"> 
                <h2>Ændre brugernavn:</h2>
                <form name="createForm" action="/570104z/contain/master_control/create_user" onsubmit="return confirmAction()" method="post">
                    <div class="form-group">
                    <label for="titel">Nyt brugernavn:</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $username_form_value; ?>">
                    <span id="errUser"></span>
                    </div>
                    <div class="form-group">
                    <label for="titel">Indtast nuværende password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span id="errPass"></span>
                    </div>
                    <?php echo $_SESSION["change_username_feedback"]; ?>
                    <button type="submit" class="btn btn-default">Create user</button>
                </form>
            </div>
            <Hr / > 
            <div id="password">
                <h2>Ændre password:</h2>
                <form name="createForm" action="/570104z/contain/master_control/create_user" onsubmit="return confirmAction()" method="post">
                    <div class="form-group">
                    <label for="titel">Indtast nyt password:</label>
                    <input type="text" class="form-control" name="username" id="username">
                    <span id="errUser"></span>
                    </div>
                    <div class="form-group">
                    <label for="titel">Gentag nyt password:</label>
                    <input type="text" class="form-control" name="username" id="username">
                    <span id="errUser"></span>
                    </div>
                    <div class="form-group">
                    <label for="titel">Indtast nuværende password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span id="errPass"></span>
                    </div>
                    <button type="submit" class="btn btn-default">Create user</button>
                </form>
            </div>
            <Hr / >
            <div id="profile">
                <h2>Ændre profiloplysninger:</h2>
                Dette er kun et test exempel
                <form name="createForm" action="/570104z/contain/user_control/user_handler" onsubmit="return confirmAction()" method="post">
                    <div class="form-group">
                    <label for="titel">Fornavn:</label>
                    <input type="text" class="form-control" name="username" id="username">
                    <span id="errUser"></span>
                    </div>
                    <div class="form-group">
                    <label for="titel">Efternavn:</label>
                    <input type="text" class="form-control" name="username" id="username">
                    <span id="errUser"></span>
                    </div>
                    <div class="form-group">
                    <label for="titel">E-mail:</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span id="errPass"></span>
                    </div>
                    <button type="submit" class="btn btn-default">Opdater</button>
                </form>
            </div>
            <Hr / >  
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div>