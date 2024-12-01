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

$insertsql = $mysql->prepare("INSERT INTO users(fname, lname, username, password, email, phone_number, instagram, major, profile_picture, bio) VALUES (?,?,?,?,?,?,?,?,?,?)");

if (!$insertsql) {
    echo "SQL preparation error: " . $mysql->error;
    exit();
}

$fname = $_REQUEST['first-name'];
$lname = $_REQUEST['last-name'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$email = $_REQUEST['email'];
$phone_number = $_REQUEST['phone-number'];
$major = $_REQUEST['major'];
$bio = $_REQUEST['bio'];
$instagram = $_REQUEST['instagram'];

// Bind parameters to the placeholders
$insertsql->bind_param(
    "ssssssssss",
    $fname,
    $lname,
    $username,
    $password,
    $email,
    $phone_number,
    $instagram,
    $major,
    $profile_pic,
    $bio
);

// Execute the prepared statement
if (!$insertsql->execute()) {
    echo "SQL execution error: " . $insertsql->error;
    exit();
}

// Close the statement
$insertsql->close();

$sql = "SELECT * FROM users WHERE email='$email'";

$results = $mysql->query($sql);

if(!$results) {
    echo "SQL execution error: " . $insertsql->error;
    exit();
}

if($results->num_rows > 0) {
    $row = $results->fetch_assoc();
    $id = $row['user_id'];
}
// Optionally, redirect to a success page or display a success message
echo "User successfully added to database.\n.";
echo "<br>";
echo "<a href='home.php?id=" . $id . "'>Go Home</a><br>";
echo "<a href='interests'>Select Interests</a><br>";


