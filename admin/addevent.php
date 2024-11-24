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

if (isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = '../images/banners/';
    $tmp_name = $_FILES['banner_img']['tmp_name'];
    $original_name = basename($_FILES['banner_img']['name']);

    // Generate a unique file name
    $unique_name = uniqid() . "_" . $original_name;
    $upload_file = $upload_dir . $unique_name;

     $allowed_types = ['image/jpeg', 'image/png'];
     $file_type = $_FILES['banner_img']['type'];
     if (!in_array($file_type, $allowed_types)) {
         echo "Invalid file type.";
         exit();
     }

    if (move_uploaded_file($tmp_name, $upload_file)) {
        $banner_img = $upload_file; // Set the file path for database insertion
    } else {
        echo "Failed to upload banner image.";
        exit();
    }
} else {
    echo "No file uploaded or upload error.";
    exit();
}

$stmt = $mysql->prepare("INSERT INTO events (banner_img, event_name, event_date, start_time, end_time, description, location, address, event_type_id, oncampus, creator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "SQL preparation error: " . $mysql->error;
    exit();
}

$event_name = $_REQUEST['event_name'];
$event_date = $_REQUEST['event_date'];
$start_time = $_REQUEST['start_time'];
$end_time = $_REQUEST['end_time'];
$description = $_REQUEST['description'];
$location = $_REQUEST['location'];
$address = $_REQUEST['address'];
$event_type_id = $_REQUEST['event_type_id'];
$creator = "12";

$on_campus = isset($_REQUEST['on_campus']) ? 1 : 0;

// Bind parameters to the placeholders
$stmt->bind_param(
    "ssssssssiii",
    $unique_name,
    $event_name,
    $event_date,
    $start_time,
    $end_time,
    $description,
    $location,
    $address,
    $event_type_id,
    $on_campus,
    $creator
);

// Execute the prepared statement
if (!$stmt->execute()) {
    echo "SQL execution error: " . $stmt->error;
    exit();
}

// Close the statement
$stmt->close();

// Optionally, redirect to a success page or display a success message
echo "Event created successfully.";

