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

$event_type = $_POST['event_type'];

$check_sql = "SELECT * FROM event_types WHERE event_type = '$event_type'";
$check_result = $mysql->query($check_sql);

if ($check_result->num_rows > 0) {
    // Entry already exists
    echo "The event type '$event_type' already exists.";
    exit();
} else {
    // Proceed with the insert
    $sql = "INSERT INTO event_types (event_type) VALUES ('$event_type')";
    $results = $mysql->query($sql);

    if (!$results) {
        echo "SQL error: " . $mysql->error . " running query <hr>" . $sql . "<hr>";
        exit();
    } else {
        echo "Event type '$event_type' added successfully.";
    }
}