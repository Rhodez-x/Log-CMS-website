<script>
<?php
// Her laves login scriptet. Det bliver indraget på siden hvis man ikke er logget ind.
if (!isset($_SESSION['login_user'])) {
?>
$(document).ready(function(){
    
    $("#loginbutton").click(function(event){
            
        event.preventDefault();
        
        var brugernavn = document.getElementById("brugernavn").value;
        var password = document.getElementById("password").value;
        var feedback = "";
        $.post("/REPLACE_ME_PATH/571204m/m530199l",
            {
            sendtBrugernavn: brugernavn,
            sendtPassword: password,
            },
            function(data,status){
            feedback = data;
            if (feedback == "succes") {
                document.location.href="/REPLACE_ME_PATH/";
            }
            else if (feedback == "forkert") {
                $("#loginfeedback").html("<strong>Brugernavn og password passer ikke!</strong>");
            }
            else if (feedback == "udfyld") {
                 $("#loginfeedback").html("<strong>Begge felter skal udfyldes!</strong>");
            }
            else {
                 $("#loginfeedback").html("<strong>Der er sket en fejl!</strong>");
            }
        });
        
    });
});
<?php
    }
?>
</script>
