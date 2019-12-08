<?php
	function get_dashboard() 
	{
		return "<div class='well'>
					  <div class='alert alert-info'>
    <h3>Code managentment:</h3>   
      </div>
            <table class='table table-striped'>
    <thead>
      <tr>
        <th>Code id</th>
        <th>Time</th>
        <th>View/edit code</th>
        <th>delete</th>
        <th>x</th>
        <th>x</th>
      </tr>
    </thead>
    <tbody id='code_dashboard_logs'>
      <tr>
        <td>Loading</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Create new code</td>
        <td></td>
        <td></td>
        <td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#code_edit_modal'>Create code</button></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
  </div>

<!-- Modal -->
<div id='code_edit_modal' class='modal fade' role='dialog' style='margin-top:50px;'>
  <div class='modal-dialog modal-lg'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>Code edit</h4>
      </div>
      <div style='height: 500px;' class='modal-body' id='code_ecit_body'>
  <div id='editor'>function foo(items) {
    var x = 'All this is syntax highlighted';
    return x;
	}
  </div>
    
<script src='/plugins/ace/src-noconflict/ace.js' type='text/javascript' charset='utf-8'></script>
<script>
    var editor = ace.edit('editor', {showPrintMargin: false,});
    editor.setTheme('ace/theme/monokai');
    editor.session.setMode('ace/mode/javascript');
</script>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-success' data-dismiss='modal'>Save</button>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>
";
	}
?>