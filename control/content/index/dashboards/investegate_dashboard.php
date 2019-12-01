<?php
	function get_dashboard() 
	{
		return "<div class='well'>
					  <div class='alert alert-warning'>
    <h3>Relevant logs:</h3>   
      </div>
            <table class='table table-striped'>
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Show log</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#myModal'>Open Log</button></td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
                <td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#myModal'>Open Log</button></td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
                <td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#myModal'>Open Log</button></td>
      </tr>
    </tbody>
  </table>
<Hr \>
  <div class='alert alert-info'>
  <h2>Conclusion</h2>
  </div>
    <form>
    <div class='form-group'>
      <label for='comment'>Comment:</label>
      <textarea class='form-control' rows='5' id='comment'></textarea>
    </div>
    <div class='btn-group'>
      <button type='submit' class='btn btn-danger'>Escalate</button>
      <button type='submit' class='btn btn-success'>Resolved</button>
    </div>
  </form>

  </div> 



<!-- Modal -->
<div id='myModal' class='modal fade' role='dialog' style='margin-top:50px;'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>Log information</h4>
      </div>
      <div class='modal-body'>
        <p>Get and display the information about the log</p>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>

";
	}
?>