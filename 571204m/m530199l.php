<?php
/* Copy-right Jørn Guldberg
Dette er filen der tjekker login
*/
include $_SERVER['DOCUMENT_ROOT']."/570304x/x530199.php";

// Her laves deb variabel der sendes tilbage. Enten med sucses eller med en fejl medelelse
$dataDerSendesTilbage = "";

// Her modtages brugernavn og adgangskode.
$tjekBrugernavn = clean_input_text($_POST["sendtBrugernavn"]);
$tjekPassword = clean_input_text($_POST["sendtPassword"]);

// Her tjekkes det om der er skrevet noget i brugernavnet og passwordet
if (!empty($tjekBrugernavn) && !empty($tjekPassword)) {
    // Hvis der findes en bruger i systemet med login navnet findes de forskellige oplysninger om brugeren.
    $tjekBrugernavn = username_check($tjekBrugernavn);
    $tjekPassword = password_crypt($tjekPassword, $tjekBrugernavn);
    // Her tjekkes det om oplysningerne findes i systemet.
    try {
        include($_SERVER['DOCUMENT_ROOT']."/571204m/m530199c.php");
        $stmt = $conn->prepare("SELECT * FROM ReplaceDBusers WHERE username_clean = ? AND password = ? ");
        $stmt->execute(array($tjekBrugernavn, $tjekPassword));
                // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() == 1) {
            foreach($stmt->fetchAll() as $row) {
                $_SESSION['login_user'] = $row['username'];
                $login_id = $row['id'];
                $dataDerSendesTilbage = "succes";
            }
        } 
        else {
            $dataDerSendesTilbage = "forkert";
        }
    }
    catch(PDOException $e) {
            echo "Error: ";
    }
    $stmt = null;
    $conn = null;
}
else {
$dataDerSendesTilbage = "udfyld";    
}
echo $dataDerSendesTilbage;
?>