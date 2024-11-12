<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>Event Search Results</title>
    <style>



    </style>
</head>
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

$sql = "SELECT * FROM event_types";

$results = $mysql->query($sql);

if(!$results) {
    echo "SQL error: ". $mysql->error . " running query <hr>" . $sql . "<hr>";
    exit();
}

$eventname = $_REQUEST['eventname'];
$category = $_REQUEST['category'];
$date = $_REQUEST['date'];
?>
<body>
<?php include "header.php"; ?>
<div class="container">
    <!-- Filters Section -->
    <form class="filters" action="eventresultspage.php" method="get">

        <h1>Filters</h1><br>
        <input type="text" name="eventname" placeholder="Find an event" style="width: 300px">
        <select name="category">
            <option value="All">Select Category</option>
            <?php
            while($currentrow = $results->fetch_assoc()){
                echo "<option value='" . $currentrow['event_type'] . "'>" . $currentrow['event_type'] . "</option>";
            }
            ?>
        </select>
        <!-------On Campus Button-------->
        <span>On-Campus Only</span>
        <label class="switch">
            <input type="checkbox" name="toggle">
            <span class="slider round"></span>
        </label>

        <!-------Date-------->
        <input type="date" name="date">

        <!---Search Button---->
        <button type="submit" value="submit" class="search-button">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Search
        </button>

    </form>

    <?php

    $sql1 = "SELECT * FROM eventview WHERE 1=1";

    $sql1 .= " AND event_name LIKE '%" .
        $eventname . "%'";

    if($category != "All") {
        $sql1 .= " AND event_type ='" . $category . "'";
    }

    if (isset($_REQUEST['toggle']) && $_REQUEST['toggle'] == "on") {
        $sql1 .= " AND oncampus = 1";
    }

    if ($date != "") {
        $sql1 .= " AND event_date = '" . $date . "'";
    }

    $results1 = $mysql->query($sql1);

    if(!$results1) {
        echo "SQL error: ". $mysql->error . " running query <hr>" . $sql1 . "<hr>";
        exit();
    }
    ?>

    <div class="results">
        <?php while($event = $results1->fetch_assoc()): ?>

            <div class="event-tile">
                <div class="event-image" style="background-image: url('images/arrow.png');"></div>
                <div class="event-content">
                    <div class="event-title"><?php echo $event['event_name']?></div>
                    <div class="event-details">
                        <div>
                            <?php echo date('D, M j', strtotime($event['event_date'])); ?> • <?php echo date('g:ia', strtotime($event['event_date'])); ?>
                        </div>

                        <div><?php echo $event['location'] ?></div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
