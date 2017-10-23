<div class="container GLOBALdesign">
    <h2>Controlpanel</h2>
    <?php echo menu_line($web_page_name);
    echo $_SESSION["uploade_feedback"];
    unset($_SESSION["uploade_feedback"]);?>

    <div class="row">
        <nav class="col-sm-3" id="myScrollspy">
            <ul class="nav nav-pills nav-stacked">
                <li><h3>Oversigt</h3></li>
                <li><a href="#password">Ændre profiloplysninger</a></li>
                <li><a href="#username">Ændre brugernavn</a></li>
                <li><a href="#password">Ændre password</a></li>
            </ul>
        </nav>
        <div class="col-sm-6">
            <div id="username"> 
                <h2>Ændre brugernavn:</h2>
                <form name="createForm" action="/570104z/contain/master_control/create_user" onsubmit="return validateForm()" method="post">
                    <div class="form-group">
                    <label for="titel">Nyt brugernavn:</label>
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
            <div id="password">
                <h2>Ændre password:</h2>
                <form name="createForm" action="/570104z/contain/master_control/create_user" onsubmit="return validateForm()" method="post">
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
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div>