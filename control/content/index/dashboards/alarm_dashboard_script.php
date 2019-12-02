<script>
function get_content_alarm_dashboard()
{
    var content; 

    $.post("/control/content/index/dashboards/test_data/get_alarms",
    {
        method: "get",
        },
        function(data,status){
        for (var i = data.results - 1; i >= 0; i--) {
            content += "<tr>  \
            <td>"+ data.alarms[i].id+ "</td> \
            <td>"+data.alarms[i].timestamp+"</td> \
            <td>"+data.alarms[i].alarm_name+"</td> \
            <td>"+data.alarms[i].agent_id+"</td> \
            <td><a href='/control/index?select=investegate&id="+data.alarms[i].id+"'> <span class='glyphicon glyphicon-search'></span></a></td> \
            </tr>";
        }
        $("#alarm_dashboard_alarms").html(content);
    }, 'json');
}
</script>