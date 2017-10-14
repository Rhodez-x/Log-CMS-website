<script>
    function validateForm() {
        var ok = true;
        var user = document.forms["create"]["username"].value;
        if (user == "") {
            errUser
            $("#errUser").html("<b> <?php echo $lang_data_must_be_filled; ?> </b>");
            ok = false;
        }

        var pass = document.forms["create"]["password"].value;
        if (pass == "") {
            $("#errPass").html("<b> <?php echo $lang_data_must_be_filled; ?> </b>");
            ok  = false;
        }
        return ok;
    }
    function confirmDelete() {
        return confirm("Bekræft ved at klikke ok");
    }
</script>