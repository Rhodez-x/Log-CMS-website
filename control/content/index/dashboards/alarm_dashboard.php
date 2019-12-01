<?php
	function get_dashboard() 
	{
		return "<div class='well'>
					  <div class='alert alert-danger'>
    <h3>Triggered alarms:</h3>   
      </div>
            <table class='table table-striped'>
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Investegate</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><a href='/control/index?select=investegate&id=10'> <span class='glyphicon glyphicon-search'></span></a></td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
        <td><span class='glyphicon glyphicon-search'></span></td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
        <td><span class='glyphicon glyphicon-search'></span></td>
      </tr>
    </tbody>
  </table>
  </div>";
	}
?>