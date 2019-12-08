<script>
function set_log_modal_info(content) 
{
    $("#log_modal_info").html(content);
}


function get_content_code_dashboard()
{
    var content = "";
    $.ajax({
        type: "POST",
        url: "https://joliecloud.mitlogin.dk/retrieveCode",
        // The key needs to match your method's input parameter (case-sensitive).
        data: '{"offset": 0, "limit": 20, "authorization": "valid_token" }',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
            for (var i = data.count - 1; i >= 0; i--) {
            content += "<tr>  \
            <td>"+ data.parsers[i].name+ "</td> \
            <td>"+data.parsers[i].code+"</td> \
            <td>"+data.parsers[i].type+"</td><td>";

            content += "</td><td></td> \
            <td></td> \
            </tr>";
            }
            $("#code_dashboard_logs").html(content);
        },
        failure: function(errMsg) 
        {
            alert(errMsg);
        }
    });
}

</script>
<!-- Modal -->
<div id='log_info_modal' class='modal fade' role='dialog' style='margin-top:50px;'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>Log information</h4>
      </div>
      <div class='modal-body' id='log_modal_info'>
        <p>Get and display the information about the log</p>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>