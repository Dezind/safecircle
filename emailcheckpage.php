<?php
$host = "webdev.iyaserver.com";
$userid = "<youruserid>";
$userpw = "<yourpw>";
$db = "<database name>";

include 'loginvariables.php';

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if ($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $mysql->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect to login page if the email exists
        header("Location: loginpage.php?email=$email");
    } else {
        // Redirect to signup page if the email does not exist
        header("Location: signuppage.php?email=" . urlencode($email));
    }

    $stmt->close();
    $mysql->close();
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>SIGN UP / LOG IN</title>
</head>
<script>
    function validateEmail(){
        var email = document.getElementById('email').value;

        // Validate email
        if (!email.includes('@usc.edu')) {
            alert('Please enter a valid USC email address.');
            return false; // Prevent form submission
        }
    }
</script>
<?php

?>

<body>
<?php include "globe.php"?>
<?php include "cursor.php"?>

<?php include "header.php"; ?>

<div class="hero">
    <div id="email-form">
        <h1>Create Your Account</h1>
        <form method="POST" onsubmit="return validateEmail();">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="rounded-button" onclick="return loadSignUp()">Next</button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>
