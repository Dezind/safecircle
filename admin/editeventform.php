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

$sql = "SELECT * FROM events WHERE event_id = ".$_REQUEST['event_id'];

$results = $mysql->query($sql);

if(!$results) {
    echo "mysql query error : " . $mysql->error;
};

$event = $results->fetch_assoc();



$sql1 = "SELECT * FROM event_types";

$results1 = $mysql->query($sql1);

if(!$results1) {
    echo "mysql query error : " . $mysql->error;
}

$typesql = "SELECT * FROM event_types WHERE event_type_id = ".$event['event_type_id'];

$typeresults = $mysql->query($typesql);

$eventtype = $typeresults->fetch_assoc();

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
        .image-upload {
            position: relative;
            cursor: pointer;
        }

        #banner_preview {
            width: 100%;
            max-width: 500px; /* Adjust as needed */
            height: auto;
            display: block;
            margin-bottom: 10px;
        }

        .upload-button {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            max-width: 300px; /* Match the image width */
            cursor: pointer;
        }

        .upload-button:hover {
            background-color: #0056b3;
        }

        #banner_img {
            display: none; /* Hide the default file input */
        }

    </style>
</head>
<body>
<div class="container">
    <!-- Event Edit Section -->
    <form class="section" action="editform.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">


        <h2>Make edits to <?php echo $event["event_name"]; ?></h2>

        <div class="image-upload">
            <label for="banner_img">
                <img id="banner_preview" src="../images/banners/<?php echo $event['banner_img']; ?>" alt="Banner Image Preview">
                <div class="upload-button">Click to change banner image</div>
            </label>
            <input type="file" id="banner_img" name="banner_img" accept="image/*">
        </div>

        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" value="<?php echo $event["event_name"]; ?>" required>

        <label for="event_type">Event Type:</label>
        <select id="event_type" name="event_type_id">
            <option value="<?php echo $eventtype['event_type_id']; ?>"><?php echo $eventtype['event_type']; ?></option>
            <option value="<?php echo $eventtype['event_type_id']; ?>">-------------------------------</option>
            <?php
            while($currentrow = $results1->fetch_assoc()) {
                echo '<option value="'.$currentrow['event_type_id'].'">'.$currentrow['event_type'].'</option>';
            }
            ?>
        </select>

        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" value="<?php echo $event["event_date"]; ?>" required>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" value="<?php echo date("H:i", strtotime($event["start_time"])); ?>" required>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" value="<?php echo date("H:i", strtotime($event["end_time"])); ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo $event["description"]; ?></textarea>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $event["location"]; ?>" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $event["address"]; ?>" required>

        <br><br>

        <button type="submit">Save</button>
    </form>

</div>
<script>
    document.getElementById('banner_img').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('banner_preview').src = URL.createObjectURL(file);
        }
    });
</script>
</body>
</html>