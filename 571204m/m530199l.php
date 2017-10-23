<?php
/* Sandsized CMS - By Guld-berg.dk software technologies
*  Developed by Jørn Guldberg
*  Copyright (C) Jørn Guldberg - Guld-berg.dk All Rights Reserved. 
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
        $conn = get_db_connection(MAIN_DB_HOST, MAIN_DB_DATABASE_NAME, MAIN_DB_USER, MAIN_DB_PASS);
        $stmt = $conn->prepare("SELECT * FROM ReplaceDBusers WHERE username_clean = ? AND password = ? ");
        $stmt->execute(array($tjekBrugernavn, $tjekPassword));
                // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() == 1) {
            foreach($stmt->fetchAll() as $row) {
                $_SESSION['login_user'] = $row['username'];
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