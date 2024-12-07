
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-E5TVCZMWYR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-E5TVCZMWYR');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <link type="text/css" href="css/signup.css" rel="stylesheet"></link>
    <title>SIGN UP / LOG IN</title>

</head>
<?php
//
//$host = "webdev.iyaserver.com";
//$userid = "<youruserid>";
//$userpw = "<yourpw>";
//$db = "<database name>";
//
//include 'loginvariables.php';
//
//
//$mysql = new mysqli(
//    $host,
//    $userid,
//    $userpw,
//    $db
//);
//
//if ($mysql->connect_errno) {
//    echo "db connection error : " . $mysql->connect_error;
//    exit();
//}
//
//echo "db connection succeeded\n";
//?>
<body>

<?php include "globe.php" ?>
<?php include "cursor.php" ?>


<!-------------------------------<MAIN BODY>------------------------------------->

<div>
    <?php include "header.php"; ?>

    <!-------------------------------<login/signup>------------------------------------->
    <section class="hero">
        <div class="auth-container">
            <div class="auth-box">
                <div class="auth-tabs">
                    <div class="auth-tab active" onclick="switchTab('login')">Log In</div>
                    <div class="auth-tab" onclick="switchTab('signup')">Sign Up</div>
                </div>
                <!-- Replace both form tags and the submit buttons with this: -->

                <form class="auth-form active" id="login-form">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-input">
                    </div>
                    <a href="homepage.php" class="auth-button" style="text-align: center; display: block; text-decoration: none;">Log In</a>
                    <div class="auth-footer">
                        <a href="#">Forgot password?</a>
                    </div>
                </form>

                <form class="auth-form" id="signup-form">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-input">
                    </div>
                    <a href="homepage.php" class="auth-button" style="text-align: center; display: block; text-decoration: none;">Sign Up</a>
                </form>
            </div>
        </div>
    </section>

    <!-------------------------------<login>------------------------------------->

    <script>
        function switchTab(tab) {
            // Remove active class from all tabs and forms
            document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));

            // Add active class to selected tab and form
            if(tab === 'login') {
                document.querySelector('#login-form').classList.add('active');
                document.querySelectorAll('.auth-tab')[0].classList.add('active');
            } else {
                document.querySelector('#signup-form').classList.add('active');
                document.querySelectorAll('.auth-tab')[1].classList.add('active');
            }
        }
    </script>

    <footer>
        <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
    </footer>
</div>

</body>
</html>

