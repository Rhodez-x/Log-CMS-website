<script>
function set_log_modal_info(content) 
{
    $("#log_modal_info").html(content);
}


function get_content_log_dashboard()
{
    var content = "";
    $.ajax({
        type: "POST",
        url: "https://logstore-dev.mitlogin.dk/gateway",
        // The key needs to match your method's input parameter (case-sensitive).
        data: '{"method": "get", "request": {"path": ""}}',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
            for (var i = data.results - 1; i >= 0; i--) {
            content += "<tr>  \
            <td>"+ data.content[i].log_id+ "</td> \
            <td>"+data.content[i].timestamp+"</td> \
            <td>"+data.content[i].log_type+"</td><td>";

            for (var j = 0; data.content[i].tags[j] != undefined; j++) 
            {
                content += data.content[i].tags[j]+ ", ";
            }

            content += "</td><td>"+data.content[i].agent_id+"</td> \
            <td><button onclick='set_log_modal_info(\""+data.content[i].content+"\")' type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#log_info_modal'>Open Log</button></td> \
            </tr>";
            }
            $("#log_dashboard_logs").html(content);
        },
        failure: function(errMsg) 
        {
            alert(errMsg);
        }
    });
}

/*
function get_content_log_dashboard()
{
    var content; 

    $.post("/control/content/index/dashboards/test_data/get_logs",
    {
        method: "get",
        },
        function(data,status){
        for (var i = data.results - 1; i >= 0; i--) {
            content += "<tr>  \
            <td>"+ data.content[i].log_id+ "</td> \
            <td>"+data.content[i].timestamp+"</td> \
            <td>"+data.content[i].log_type+"</td><td>";

            for (var j = 0; data.content[i].tags[j] != undefined; j++) 
            {
                content += data.content[i].tags[j]+ ", ";
            }

            content += "</td><td>"+data.content[i].agent_id+"</td> \
            <td><button onclick='set_log_modal_info(\""+data.content[i].content+"\")' type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#log_info_modal'>Open Log</button></td> \
            </tr>";
        }
        $("#log_dashboard_logs").html(content);
    }, 'json');
}
*/

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