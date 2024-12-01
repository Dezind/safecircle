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

$sql = "SELECT * FROM users";

$results = $mysql->query($sql);

if(!$results) {
    echo "mysql query error : " . $mysql->error;
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
    function storeFormValues() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const firstName = document.getElementById('first-name').value;
        const lastName = document.getElementById('last-name').value;
        const username = document.getElementById('username').value;
        const phoneNumber = document.getElementById('phone-number').value;
        const major = document.getElementById('major').value;

        if (password != confirmPassword) {
            alert('Passwords do not match.');
            return false;
        }

        if (!email.includes('@usc.edu')) {
            alert('Please enter a valid USC email address.');
            return false;
        }

        localStorage.setItem('email', email);
        localStorage.setItem('password', password);
        localStorage.setItem('confirm-password', confirmPassword);
        localStorage.setItem('first-name', firstName);
        localStorage.setItem('last-name', lastName);
        localStorage.setItem('username', username);
        localStorage.setItem('phone-number', phoneNumber);
        localStorage.setItem('major', major);

        document.getElementById('signup-form').style.display = 'none';
        document.getElementById('interests-form').style.display = 'block';

    }

    function combineAndSubmit() {
        document.getElementById('hidden-email').value = localStorage.getItem('email');
        document.getElementById('hidden-password').value = localStorage.getItem('password');
        document.getElementById('hidden-confirm-password').value = localStorage.getItem('confirm-password');
        document.getElementById('hidden-first-name').value = localStorage.getItem('first-name');
        document.getElementById('hidden-last-name').value = localStorage.getItem('last-name');
        document.getElementById('hidden-username').value = localStorage.getItem('username');
        document.getElementById('hidden-phone-number').value = localStorage.getItem('phone-number');
        document.getElementById('hidden-major').value = localStorage.getItem('major');

    }

</script>
<?php

?>

<body>
<?php include "globe.php"?>
<?php include "cursor.php"?>

<?php include "header.php"; ?>

<div class="hero">
    <!-- First Form -->
    <form id="signup-form" method="post" action="signup.php" onsubmit="storeFormValues(); return false;">
        <h1>Complete Your Account - Step 1</h1>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $_REQUEST['email'] ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="form-group">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first-name" required>
        </div>
        <div class="form-group">
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last-name" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="phone-number">Phone Number:</label>
            <input type="text" id="phone-number" name="phone-number" required>
        </div>
        <div class="form-group">
            <label for="major">Major:</label>
            <input type="text" id="major" name="major" required>
        </div>
        <button class="rounded-button" type="submit">Next</button>
    </form>

    <!-- Second Form -->
    <form id="interests-form" method="post" action="signup.php" enctype="multipart/form-data" style="display: none;" onsubmit="combineAndSubmit();">
        <h1>Complete Your Account - Step 2</h1>
        <div class="form-group">
            <label for="profile-pic">Profile Pic:</label>
            <input type="file" id="profile-pic" name="profile-pic">
        </div>
        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" rows="4" placeholder="Enter bio"></textarea>
        </div>
        <div class="form-group">
            <label for="instagram">Instagram:</label>
            <input type="text" id="instagram" name="instagram">
        </div>

        <!-- Hidden inputs to store values from the first form -->
        <input type="hidden" id="hidden-email" name="email">
        <input type="hidden" id="hidden-password" name="password">
        <input type="hidden" id="hidden-confirm-password" name="confirm-password">
        <input type="hidden" id="hidden-first-name" name="first-name">
        <input type="hidden" id="hidden-last-name" name="last-name">
        <input type="hidden" id="hidden-username" name="username">
        <input type="hidden" id="hidden-phone-number" name="phone-number">
        <input type="hidden" id="hidden-major" name="major">

        <button type="submit" class="rounded-button">Submit</button>
    </form>

</div>

<?php include "footer.php"; ?>

</body>


</html>
