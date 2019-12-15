<script>
function get_content_alarm_dashboard()
{
    var content; 

    $.get("https://logalarm-dev.mitlogin.dk/alarms",
    {
        method: "get",
    },
    function(data,status){
        for (var i = data.num_results - 1; i >= 0; i--) {
            content += "<tr>  \
            <td>"+ data.content[i].customer_id+ "</td> \
            <td>"+data.content[i].timestamp+"</td> \
            <td>"+data.content[i].name+"</td> \
            <td>"+data.content[i].severity+"</td> \
            <td><a href='/control/index?select=investegate&id="+data.content[i].customer_id+"'> <span class='glyphicon glyphicon-search'></span></a></td> \
            </tr>";
        }
        $("#alarm_dashboard_alarms").html(content);
    }, 'json');
}
</script>