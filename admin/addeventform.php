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
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$sql = "SELECT * FROM event_types";

$results = $mysql->query($sql);

if(!$results) {
    echo "mysql query error : " . $mysql->error;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .section {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            width: calc(33% - 40px);
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
        }
        select, textarea {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Event Edit Section -->
    <form class="section" action="addevent.php" method="post" enctype="multipart/form-data">

        <h2>Create an Event:</h2>

        <label for="banner_img">Banner Image:</label>
        <input type="file" id="banner_img" name="banner_img" required>

        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" value="" placeholder="Enter event name" required>

        <label for="event_type">Event Type:</label>
        <select id="event_type" name="event_type_id">
        <?php
            while($currentrow = $results->fetch_assoc()) {
                echo '<option value="'.$currentrow['event_type_id'].'">'.$currentrow['event_type'].'</option>';
            }
            ?>
        </select>

        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" value="" required>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" value="" required>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" value="" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter event description" required></textarea>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="" placeholder="Name of the location" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="" placeholder="street, city, state zipcode (ex: 1111, Los Angeles, CA 90007)" style="font-style: italic" required>

        <br><br>

        <div>On Campus? <input type="checkbox" id="on_campus" name="on_campus"></div>

        <button type="submit">Save</button>
    </form>

</div>
</body>
</html>