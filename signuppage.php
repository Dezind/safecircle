<?php
session_start();

$host = "webdev.iyaserver.com";
$userid = "<youruserid>"; // Replace with your user ID
$userpw = "<yourpw>"; // Replace with your password
$db = "<database name>"; // Replace with your database name

include 'loginvariables.php';

$mysql = new mysqli($host, $userid, $userpw, $db);

if ($mysql->connect_errno) {
    echo "db connection error: " . $mysql->connect_error;
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle Form 1 Submission
    if (isset($_POST['form1_submitted'])) {
        // Retrieve Form 1 data
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $username = $_POST['username'];

        // Validate data
        if ($password !== $confirm_password) {
            $error = 'Passwords do not match.';
            show_form1($error);
            exit();
        }

        if (!strpos($email, '@usc.edu')) {
            $error = 'Please enter a valid USC email address.';
            show_form1($error);
            exit();
        }

        // Generate verification code
        $correctcode = generate_verification_code();

        // Store data and code in session
        $_SESSION['verification_code'] = $correctcode;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['username'] = $username;

        // Send verification email
        $to = $email;
        $subject = 'Your verification code';
        $message = 'Your code is ' . $correctcode . "copy and paste the verification code on sign up page.";
        $headers = 'From: SafeCircle';

        mail($to, $subject, $message, $headers);

        // Display verification form
        show_verification_form();
        exit();
    }

    // Handle Verification Code Submission
    if (isset($_POST['verification_submitted'])) {
        $usercode = $_POST['verification_code'];
        $correctcode = $_SESSION['verification_code'];

        if ($usercode === $correctcode) {
            // Code matches, proceed to Form 2
            show_form2();
            exit();
        } else {
            // Code does not match, show error
            $error = 'Incorrect code. Please try again.';
            show_verification_form($error);
            exit();
        }
    }

    // Handle Form 2 Submission
    if (isset($_POST['form2_submitted'])) {
        // Retrieve Form 2 data
        $_SESSION['first-name'] = $_POST['first-name'];
        $_SESSION['last-name'] = $_POST['last-name'];
        $_SESSION['phone-number'] = $_POST['phone-number'];
        $_SESSION['major'] = $_POST['major'];

        // Display Form 3
        show_form3();
        exit();
    }

    // Handle Form 3 Submission
    if (isset($_POST['form3_submitted'])) {
        // Retrieve Form 3 data
        $bio = $_POST['bio'];
        $instagram = $_POST['instagram'];

        // Handle file upload
        if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'images/profile_pics/';
            $tmp_name = $_FILES['profile-pic']['tmp_name'];
            $original_name = basename($_FILES['profile-pic']['name']);

            // Generate a unique file name
            $unique_name = uniqid() . "_" . $original_name;
            $upload_file = $upload_dir . $unique_name;

            $allowed_types = ['image/jpeg', 'image/png'];
            $file_type = $_FILES['profile-pic']['type'];
            if (!in_array($file_type, $allowed_types)) {
                echo "Invalid file type.";
                exit();
            }

            if (move_uploaded_file($tmp_name, $upload_file)) {
                $profile_pic = $upload_file;
            } else {
                echo "Failed to upload profile image.";
                exit();
            }
        } else {
            echo "No file uploaded or upload error.";
            $profile_pic = "profile_pic_placeholder.jpg";
        }

        // Retrieve all data from session
        $fname = $_SESSION['first-name'];
        $lname = $_SESSION['last-name'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $email = $_SESSION['email'];
        $phone_number = $_SESSION['phone-number'];
        $major = $_SESSION['major'];
        $bio = $bio;
        $instagram = $instagram;
        $admin = "0";

        // Prepare and execute the SQL statement
        $insertsql = $mysql->prepare("INSERT INTO users(fname, lname, username, password, email, phone_number, instagram, major, profile_picture, bio, admin) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        if (!$insertsql) {
            echo "SQL preparation error: " . $mysql->error;
            exit();
        }

        // Bind parameters to the placeholders
        $insertsql->bind_param(
            "ssssssssssi",
            $fname,
            $lname,
            $username,
            $password,
            $email,
            $phone_number,
            $instagram,
            $major,
            $profile_pic,
            $bio,
            $admin
        );

        // Execute the prepared statement
        if (!$insertsql->execute()) {
            echo "SQL execution error: " . $insertsql->error;
            exit();
        }

        // Close the statement
        $insertsql->close();

        // Retrieve the user ID
        $sql = "SELECT * FROM users WHERE email='$email'";
        $results = $mysql->query($sql);

        if (!$results) {
            echo "SQL execution error: " . $mysql->error;
            exit();
        }

        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $id = $row['user_id'];
        }

        // Clear session data
        session_unset();
        session_destroy();

        echo '<p>Signup successful! You can now <a href="emailcheckpage.php">log in</a>.</p>';
        exit();
    }
}

// Functions to generate verification code and display forms
function generate_verification_code() {
    do {
        $code = '';
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        for ($i = 0; $i < 4; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
    } while (!preg_match('/[A-Za-z]/', $code) || !preg_match('/[0-9]/', $code));
    return $code;
}

function show_form1($error = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- ... head content ... -->
        <title>SIGN UP - Step 1</title>
        <link type="text/css" href="css/site.css" rel="stylesheet">
        <link type="text/css" href="css/signup.css" rel="stylesheet">
    </head>
    <body>
    <?php include "globe.php"; ?>
    <?php include "cursor.php"; ?>
    <?php include "header.php"; ?>

    <div class="auth-container">
        <div class="auth-box">
            <form id="form1" method="post" action="signuppage.php">
                <h1>Sign Up - Step 1</h1>
                <?php if ($error) echo '<p style="color:red;">' . $error . '</p>'; ?>
                <hr style="margin-top:20px;margin-bottom:20px;">
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" id="email" class="form-input" name="email" value="<?php echo $_REQUEST['email']; ?>" readonly>
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
                <input type="hidden" name="form1_submitted" value="1">
                <button class="auth-button" type="submit">Next</button>
            </form>
        </div>
    </div>

    <?php include "footer.php"; ?>
    </body>
    </html>
    <?php
}

function show_verification_form($error = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- ... head content ... -->
        <title>SIGN UP - Verification</title>
        <link type="text/css" href="css/site.css" rel="stylesheet">
        <link type="text/css" href="css/signup.css" rel="stylesheet">
    </head>
    <body>
    <?php include "globe.php"; ?>
    <?php include "cursor.php"; ?>
    <?php include "header.php"; ?>

    <div class="auth-container">
        <div class="auth-box">
            <form method="post" action="signuppage.php">
                <h1>Verification</h1>
                <?php if ($error) echo '<p style="color:red;">' . $error . '</p>'; ?>
                <hr style="margin-top:20px;margin-bottom:20px;">
                <div class="form-group">
                    <label for="verification_code" class="form-label">Enter Verification Code:</label>
                    <input type="text" id="verification_code" class="form-input" name="verification_code" required>
                </div>
                <input type="hidden" name="verification_submitted" value="1">
                <button class="auth-button" type="submit">Verify</button>
            </form>
        </div>
    </div>

    <?php include "footer.php"; ?>
    </body>
    </html>
    <?php
}

function show_form2($error = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- ... head content ... -->
        <title>SIGN UP - Step 2</title>
        <link type="text/css" href="css/site.css" rel="stylesheet">
        <link type="text/css" href="css/signup.css" rel="stylesheet">
    </head>
    <body>
    <?php include "globe.php"; ?>
    <?php include "cursor.php"; ?>
    <?php include "header.php"; ?>

    <div class="auth-container">
        <div class="auth-box">
            <form id="form2" method="post" action="signuppage.php">
                <h1>Sign Up - Step 2</h1>
                <?php if ($error) echo '<p style="color:red;">' . $error . '</p>'; ?>
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
                <input type="hidden" name="form2_submitted" value="1">
                <button class="auth-button" type="submit">Next</button>
            </form>
        </div>
    </div>

    <?php include "footer.php"; ?>
    </body>
    </html>
    <?php
}

function show_form3($error = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- ... head content ... -->
        <title>SIGN UP - Step 3</title>
        <link type="text/css" href="css/site.css" rel="stylesheet">
        <link type="text/css" href="css/signup.css" rel="stylesheet">
    </head>
    <body>
    <?php include "globe.php"; ?>
    <?php include "cursor.php"; ?>
    <?php include "header.php"; ?>

    <div class="auth-container">
        <div class="auth-box">
            <form id="form3" method="post" action="signuppage.php" enctype="multipart/form-data">
                <h1>Sign Up - Step 3</h1>
                <?php if ($error) echo '<p style="color:red;">' . $error . '</p>'; ?>
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
                <input type="hidden" name="form3_submitted" value="1">
                <button type="submit" class="auth-button">Submit</button>
            </form>
        </div>
    </div>

    <?php include "footer.php"; ?>
    </body>
    </html>
    <?php
}

// If no form is submitted, display Form 1 by default
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    show_form1();
}
?>
