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
    $password = $_POST['password'];

    // Check if the email and password exist in the database
    $stmt = $mysql->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $id = $result->fetch_assoc()["user_id"];
        header("Location: home.php?id=$id");
        exit();
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
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
<?php include "globe.php" ?>
<?php include "cursor.php" ?>
<?php include "header.php"; ?>

<div class="hero">
    <!-- First Form -->
    <form id="login-form" method="post" action="" onsubmit="return validateEmail();">
        <h1>Login</h1>
        <?php if (isset($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $_REQUEST['email'] ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

<?php include "footer.php"; ?>

</body>
</html>
