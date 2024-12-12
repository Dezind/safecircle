<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$host = "webdev.iyaserver.com";
$userid = "<youruserid>";
$userpw = "<yourpw>";
$db = "<database name>";

include 'loginvariables.php';

$mysql = new mysqli($host, $userid, $userpw, $db);

if ($mysql->connect_errno) {
    echo "Database connection error: " . $mysql->connect_error;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $mysql->prepare("SELECT user_id, fname, lname, username, password, email, phone_number, instagram, major, profile_picture, admin 
        FROM users 
        WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if ($password == $user['password']) {
            // Regenerate session ID
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone_number'] = $user['phone_number'];
            $_SESSION['instagram'] = $user['instagram'];
            $_SESSION['major'] = $user['major'];
            $_SESSION['profile_picture'] = $user['profile_picture'];
            $_SESSION['admin'] = $user['admin'];


            header("Location: homepage.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
    $mysql->close();
}
?>

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
    <link type="text/css" href="css/signup.css" rel="stylesheet">
    <title>SIGN UP / LOG IN</title>
</head>
<script>
    function validateEmail() {
        var email = document.getElementById('email').value;

        // Validate email
        if (!email.includes('@usc.edu')) {
            alert('Please enter a valid USC email address.');
            return false; // Prevent form submission
        }
    }
</script>
<body>
<?php include "globe.php"; ?>
<?php include "cursor.php"; ?>
<?php include "header.php"; ?>

<div class="hero">
    <div class="auth-container">
        <div class="auth-box">
            <h1>Login</h1>
            <hr style="margin-top:0px;margin-bottom:20px;">
            <form id="login-form" class="auth-form active" method="post" action="">
                <?php if (isset($error_message)) : ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-input" value="<?php echo $_SESSION['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>
                <button type="submit" style="border-radius: 50px; align-content: center">Login</button>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
