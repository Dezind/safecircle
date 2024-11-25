<?php

include '../loginvariables.php';

$mysql = new mysqli($host, $userid, $userpw, $db);

if ($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$eventsql = "SELECT * FROM events";
$eventresults = $mysql->query($eventsql);

if (!$eventresults) {
    echo "SQL error: " . $mysql->error . " running query <hr>" . $eventsql . "<hr>";
    exit();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/site.css">
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
            flex-direction: column;
            gap: 20px;
        }
        .section {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            width: calc(24% - 40px);
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
        a {
            text-decoration: none;
            color: #bababa;
            font-size: 16px;
            font-family: Arial, sans-serif;
            display: inline-flex;
            align-items: center;
        }

        a:hover {
            color: #2e2e2e;
        }

        a span.plus {
            font-size: 20px;
            font-weight: bold;
            margin-left: 5px;
        }

        a:hover span.plus {
            color: #2e2e2e;
        }

    </style>
</head>
<body>
<h1>Admin Page</h1>
<div class="container">
    <div class="section">
        <h2>Event Edit</h2>
        <label for="event_id">Edit an Event:</label>
        <form action="editeventform.php" method="post">
            <select id="event_id" name="event_id">
                <?php while ($currentrow = $eventresults->fetch_assoc()) {
                    echo "<option value='" . $currentrow['event_id'] . "'>" . $currentrow['event_name'] . "</option>";
                } ?>
            </select>
            <button type="submit">Next</button>
            <br><br>
            <a href="addeventform.php" class="add-event">Add an Event <span class="plus">+</span></a>
        </form>
    </div>

    <div class="section">
        <h2>Add a New Event Type</h2>
        <label for="event_type">New Event Type:</label>
        <form action="inserttype.php" method="post">
            <input type="text" name="event_type" id="event_type" placeholder="Event Type"><br></br>
            <button type="submit">Next</button>
        </form>
    </div>

</div>
</body>

</html>

