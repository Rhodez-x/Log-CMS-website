<div class="container GLOBALdesign">
 <h2>Controlpanel</h2>
    <?php echo menu_line($sidenavn); ?>
    <div class="row">
        <div class="col-sm-12" style="border-bottom: solid; border-width: 1px; padding-bottom:10px;">
        <?php
        echo $_SESSION["uploade_feedback"];
        unset($_SESSION["uploade_feedback"]); 
        if ($activate_master_control) { ?>
        <h3>Create user:</h3>
        <form name="createForm" action="REPLACE_ME_PATH/570104z/contain/master_control/create_user" onsubmit="return validateForm()" method="post">
        <div class="form-group">
        <label for="titel">Username:</label>
        <input type="text" class="form-control" name="username" id="username">
        <span id="errUser"></span>
        </div>
        <div class="form-group">
        <label for="titel">User name:</label>
        <input type="password" class="form-control" name="password" id="password">
        <span id="errPass"></span>
        </div>
        <button type="submit" class="btn btn-default">Create user</button>
        </form>
        <?php 
        }
        else {
            echo "<h3>Deactivated</h3>Master control is deactivated, contact system admin for activation";
        }
        ?>
        </div>
    </div>
</div>