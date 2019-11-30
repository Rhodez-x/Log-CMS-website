<div class="container-fluid GLOBALdesign">
<div class="row">
    <nav class="col-sm-2">
      <ul class="nav nav-pills nav-stacked">
        <li><h3>Services</h3></li>
        <li><a href="/control/master_control#user">General info</a></li>
        <li><a href="/control/master_control#members">Log handling</a></li>
        <li><a href="/control/master_control#sider">Code handling</a></li>
        <li><a href="/control/master_control#backup">Subscription</a></li>
        <li><a href="/control/master_control#plugs">Agents monitoring</a></li>
      </ul>
    </nav>
    <div class="col-sm-10">
    <?php echo menu_line($web_page_name);
          echo $_SESSION["uploade_feedback"];
          unset($_SESSION["uploade_feedback"]);?>
    <h2>Dashboard</h2>
    </div>
  </div>
</div>