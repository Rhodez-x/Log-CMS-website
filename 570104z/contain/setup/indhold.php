<div class="container GLOBALdesign">
     <h2>Controlpanel</h2>
    <?php echo menu_line($web_page_name);
          echo $_SESSION["uploade_feedback"];
          unset($_SESSION["uploade_feedback"]);?>
    
    <div class="row">
    <nav class="col-sm-3" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
        <li><h3>Oversigt</h3></li>
        <li><a href="#setting">Special settings</a></li>
      </ul>
    </nav>
    <div class="col-sm-9">
    <div id="setting" style="padding-top:50px;">
        Special setting
    </div>
    </div>
  </div>
</div>