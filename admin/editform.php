<?php
$host = "webdev.iyaserver.com";
$userid = "<youruserid>";
$userpw = "<yourpw>";
$db = "<database name>";

include '../loginvariables.php';

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if ($mysql->connect_errno) {
    echo "db connection error: " . $mysql->connect_error;
    exit();
}

$event_id = $_REQUEST['event_id'];

$stmt = $mysql->prepare("SELECT banner_img FROM events WHERE event_id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Event not found.";
    exit();
}

$row = $result->fetch_assoc();
$existing_banner_img = $row['banner_img'];
$stmt->close();

echo "Existing Banner Image: $existing_banner_img<br>";

$upload_dir = '../images/banners/';

if (isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['banner_img']['tmp_name'];
    $original_name = basename($_FILES['banner_img']['name']);

    // Generate a unique file name
    $unique_name = uniqid() . "_" . $original_name;
    $upload_file = $upload_dir . $unique_name;

    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $file_type = $_FILES['banner_img']['type'];
    if (!in_array($file_type, $allowed_types)) {
        echo "Invalid file type.";
        exit();
    }

    if (move_uploaded_file($tmp_name, $upload_file)) {
        $banner_img = $upload_file;
    } else {
        echo "Failed to upload banner image.";
        exit();
    }
} else {
    $unique_name = $existing_banner_img;
}

// Prepare the UPDATE statement
$stmt = $mysql->prepare("UPDATE events SET banner_img = ?, event_name = ?, event_date = ?, start_time = ?, end_time = ?, description = ?, location = ?, address = ?, event_type_id = ? WHERE event_id = ?");

if (!$stmt) {
    error_log("SQL preparation error: " . $mysql->error);
    echo "An error occurred while updating the event.";
    exit();
}

// Retrieve form data
$event_name     = $_REQUEST['event_name'];
$event_date     = $_REQUEST['event_date'];
$start_time     = $_REQUEST['start_time'];
$end_time       = $_REQUEST['end_time'];
$description    = $_REQUEST['description'];
$location       = $_REQUEST['location'];
$address        = $_REQUEST['address'];
$event_type_id  = $_REQUEST['event_type_id'];

$stmt->bind_param(
    "ssssssssii",
    $unique_name,
    $event_name,
    $event_date,
    $start_time,
    $end_time,
    $description,
    $location,
    $address,
    $event_type_id,
    $event_id
);

// Execute the prepared statement
if (!$stmt->execute()) {
    error_log("SQL execution error: " . $stmt->error);
    echo "An error occurred while updating the event.";
    exit();
} else {
    echo "Event successfully updated.";
    echo "<a href='adminpage.php'>Back to admin page</a>";
}

$stmt->close();
