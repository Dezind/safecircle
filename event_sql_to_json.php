<?php
$host = "webdev.iyaserver.com";
$userid = "<youruserid>"; // Replace with your user ID
$userpw = "<yourpw>"; // Replace with your password
$db = "<database name>"; // Replace with your database name

include 'loginvariables.php';

// Create database connection
$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

// Set the charset to handle special characters
$mysql->set_charset("utf8");

// Check for connection errors
if ($mysql->connect_errno) {
    echo "Database connection error: " . $mysql->connect_error;
    exit();
}

// Default SQL query with basic filters
$sql = "SELECT event_name, event_date, start_time, banner_img, event_type FROM eventview WHERE event_date >= CURRENT_DATE()";

// Apply filters based on query parameters (optional)
if (!empty($_GET['event_type'])) {
    $eventType = $mysql->real_escape_string($_GET['event_type']);
    $sql .= " AND event_type = '$eventType'";
}

if (!empty($_GET['event_date'])) {
    $date = $mysql->real_escape_string($_GET['event_date']);
    if ($date === 'today') {
        $sql .= " AND event_date = CURDATE()";
    } elseif ($date === 'this_week') {
        $sql .= " AND YEARWEEK(event_date, 1) = YEARWEEK(CURDATE(), 1)";
    } elseif ($date === 'this_month') {
        $sql .= " AND MONTH(event_date) = MONTH(CURDATE()) AND YEAR(event_date) = YEAR(CURDATE())";
    }
}

// Execute the query
$results = $mysql->query($sql);

// Check for query errors
if (!$results) {
    echo "SQL error: " . $mysql->error;
    exit();
}

// Setup JSON array to hold query results
$json_array = array();

while ($currentrow = $results->fetch_assoc()) {
    // Add each row to the JSON array
    $json_array[] = $currentrow;
}

// Encode the array into a JSON string
$json2 = json_encode($json_array, JSON_UNESCAPED_UNICODE);

// Output the JSON string
echo $json2;


