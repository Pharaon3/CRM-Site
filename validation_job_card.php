<?php
// define variables and initialize with empty values
$nameErr = $surnameErr = "";
$name = $surname = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["first_name"])) {
        $nameErr = "Missing";
    }
    else {
        $name = $_POST["first_name"];
    }

    if (empty($_POST["surname"])) {
        $surnameErr = "Missing";
    }
    else {
        $surname = $_POST["surname"];
    }
}