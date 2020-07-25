<?php
session_start();

            // define variables and set to empty values
$nameErr = $emailErr = $hesloErr = $popisErr = "";
$meno = $email = $heslo = $popis = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["meno"])) {
        $nameErr = "vložte meno";
        unset($_SESSION['OK']);
    } else {
        $meno = test_input($_POST["meno"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$meno)) {
            $nameErr = "Only letters and white space allowed";
            unset($_SESSION['OK']);
        } else {
            $_SESSION['OK'] = 1;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "vložte e-mail";
        unset($_SESSION['OK']);
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            unset($_SESSION['OK']);
        } else {
            $_SESSION['OK'] = 1;
        }

    }

    if (empty($_POST["heslo"])) {
        $hesloErr = "vložte heslo";
        unset($_SESSION['OK']);
    } else {
        $_SESSION['OK'] = 1;

        $heslo = test_input($_POST["heslo"]);

    }

    if (empty($_POST["popis"])) {
        $popisErr = "zadajte niečo o vás";
        unset($_SESSION['OK']);
    } else {
        $_SESSION['OK'] = 1;
        $popis = test_input($_POST["popis"]);
    }



}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>