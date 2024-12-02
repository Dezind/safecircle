<?php
$host = "webdev.iyaserver.com";
$userid = "youruserid"; // Replace with your user ID
$userpw = "yourpw"; // Replace with your password
$db = "yourdatabase"; // Replace with your database name

include 'loginvariables.php';

$mysql = new mysqli($host, $userid, $userpw, $db);

if ($mysql->connect_errno) {
    echo "db connection error: " . $mysql->connect_error;
    exit();
}

$sql = "SELECT * FROM users";
$results = $mysql->query($sql);

if (!$results) {
    echo "mysql query error: " . $mysql->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <link type="text/css" href="css/signup.css" rel="stylesheet">
    <title>SIGN UP / LOG IN</title>
    <script>
        function storeFormValues() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const username = document.getElementById('username').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            if (!email.includes('@usc.edu')) {
                alert('Please enter a valid USC email address.');
                return false;
            }

            localStorage.setItem('email', email);
            localStorage.setItem('password', password);
            localStorage.setItem('username', username);

            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'block';
            document.getElementById('form3').style.display = 'none';

            return false;
        }

        function storeFormValues2() {
            const firstName = document.getElementById('first-name').value;
            const lastName = document.getElementById('last-name').value;
            const phoneNumber = document.getElementById('phone-number').value;
            const major = document.getElementById('major').value;

            localStorage.setItem('first-name', firstName);
            localStorage.setItem('last-name', lastName);
            localStorage.setItem('phone-number', phoneNumber);
            localStorage.setItem('major', major);

            document.getElementById('form2').style.display = 'none';
            document.getElementById('form3').style.display = 'block';

            return false;
        }

        function combineAndSubmit() {
            document.getElementById('hidden-email').value = localStorage.getItem('email');
            document.getElementById('hidden-password').value = localStorage.getItem('password');
            document.getElementById('hidden-username').value = localStorage.getItem('username');
            document.getElementById('hidden-first-name').value = localStorage.getItem('first-name');
            document.getElementById('hidden-last-name').value = localStorage.getItem('last-name');
            document.getElementById('hidden-phone-number').value = localStorage.getItem('phone-number');
            document.getElementById('hidden-major').value = localStorage.getItem('major');

            return true;
        }
    </script>
</head>
<body>
<?php include "globe.php" ?>
<?php include "cursor.php" ?>
<?php include "header.php"; ?>

<div class="auth-container">
    <div class="auth-box">
        <!-- First Form -->
        <form id="form1" class="auth-form active" method="post" action="signup.php" onsubmit="return storeFormValues();">
            <h1>Sign Up - Step 1</h1>
            <hr style="margin-top:20px;margin-bottom:20px;">
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="text" id="email" class="form-input" name="email" value="<?php echo $_REQUEST['email'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" class="form-input" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password" class="form-label">Confirm Password:</label>
                <input type="password" id="confirm-password" class="form-input" name="confirm-password" required>
            </div>
            <div class="form-group">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" class="form-input" name="username" required>
            </div>
            <button class="auth-button" type="submit">Next</button>
        </form>

        <!-- Second Form -->
        <form id="form2" class="auth-form" method="post" action="signup.php" onsubmit="return storeFormValues2();" style="display: none;">
            <h1>Sign Up - Step 2</h1>
            <hr style="margin-top:20px;margin-bottom:20px;">
            <div class="form-group">
                <label for="first-name" class="form-label">First Name:</label>
                <input type="text" id="first-name" class="form-input" name="first-name" required>
            </div>
            <div class="form-group">
                <label for="last-name" class="form-label">Last Name:</label>
                <input type="text" id="last-name" class="form-input" name="last-name" required>
            </div>
            <div class="form-group">
                <label for="phone-number" class="form-label">Phone Number:</label>
                <input type="text" id="phone-number" class="form-input" name="phone-number" required>
            </div>
            <div class="form-group">
                <label for="major" class="form-label">Major:</label>
                <input type="text" id="major" class="form-input" name="major" required>
            </div>
            <button class="auth-button" type="submit">Next</button>
        </form>

        <!-- Final Form -->
        <form id="form3" method="post" action="signup.php" enctype="multipart/form-data" style="display: none;" onsubmit="combineAndSubmit();">
            <h1>Sign Up - Step 3</h1>
            <hr style="margin-top:20px;margin-bottom:20px;">
            <div class="form-group">
                <label for="profile-pic" class="form-label">Profile Pic:</label>
                <input type="file" id="profile-pic" class="form-input" name="profile-pic">
            </div>
            <div class="form-group">
                <label for="bio" class="form-label">Bio:</label>
                <textarea id="bio" class="form-input" name="bio" rows="4" placeholder="Enter bio"></textarea>
            </div>
            <div class="form-group">
                <label for="instagram" class="form-label">Instagram:</label>
                <input type="text" id="instagram" class="form-input" name="instagram">
            </div>

            <!-- Hidden inputs to store values from the previous forms -->
            <input type="hidden" id="hidden-email" name="email">
            <input type="hidden" id="hidden-password" name="password">
            <input type="hidden" id="hidden-username" name="username">
            <input type="hidden" id="hidden-first-name" name="first-name">
            <input type="hidden" id="hidden-last-name" name="last-name">
            <input type="hidden" id="hidden-phone-number" name="phone-number">
            <input type="hidden" id="hidden-major" name="major">

            <button type="submit" class="auth-button">Submit</button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
