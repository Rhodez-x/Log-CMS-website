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
        $.post("/571204m/m530199l",
            {
            sendtBrugernavn: brugernavn,
            sendtPassword: password,
            },
            function(data,status){
            feedback = data;
            if (feedback == "succes") {
                document.location.href="/";
            }
            else if (feedback == "wrong") {
                $("#loginfeedback").html("<strong>Brugernavn og password passer ikke!</strong>");
            }
            else if (feedback == "empty") {
                $("#loginfeedback").html("<strong>Begge felter skal udfyldes!</strong>");
            }
            else if (deactive == "deactive") {
                $("#loginfeedback").html("<strong>Din bruger er deaktiveret, kontakt en adminstrator af siden</strong>");
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
