<?php
if($_SESSION["loggedin"] == "yes") {
    $email = $_SESSION["email"];
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $phone_number = $_SESSION["phone_number"];
}