
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>Event Search Page</title>
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
?>
<body>
<?php include "header.php"; ?>


<div class="hero2">

    <div class="hero2-content">

        <h1>GROUP EVENTS</h1>
        <p>You'll find all the excitement right here!</p>
    </div>
</div>

<div class="container2">

<!---------------------------------------------------------------------------------------------------------------------->
<!-----------------------------------------------NEEDS PHP HERE--------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------------->

    <form class="search-bar" action="eventresultspage.php">
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
            <svg class="svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Search
        </button>
    </form>

    <div class="categories">
        <h2>Popular Categories</h2>
        <div class="category-buttons">


            <?php
            $results -> data_seek(0);
            while($currentrow = $results->fetch_assoc()){
                echo "<button class='category-button'>" . $currentrow['event_type'] . "</button>";

            }
            ?>
        </div>
    </div>

    <div class="events">
        <h2>Events Of The Month</h2>
        <p>Discover the upcoming trending events</p>
        <?php
        $sql1 = "SELECT * FROM eventview WHERE event_date >= CURRENT_DATE() ORDER BY event_date ASC LIMIT 4";

        $results1 = $mysql->query($sql1);

        if(!$results1) {
            echo "SQL error: ". $mysql->error . " running query <hr>" . $sql1 . "<hr>";
            exit();
        }


        ?>


        <div class="event-grid">
            <?php while($currentrow = $results1->fetch_assoc()): ?>
<?php include 'event_tile.php'; ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<!--<script>-->
<!--    // Toggle functionality-->
<!--    const toggle = document.getElementById('campus-toggle');-->
<!--    toggle.addEventListener('click', function() {-->
<!--        this.classList.toggle('active');-->
<!--    });-->
<!---->
<!--    // Category buttons-->
<!--    const categoryButtons = document.querySelectorAll('.category-button');-->
<!--    categoryButtons.forEach(button => {-->
<!--        button.addEventListener('click', function() {-->
<!--            console.log('Selected category:', this.textContent);-->
<!--        });-->
<!--    });-->
<!---->
<!--    // Search button-->
<!--    const searchButton = document.querySelector('.search-button');-->
<!--    searchButton.addEventListener('click', function() {-->
<!--        const category = document.getElementById('category').value;-->
<!--        const isOnCampus = document.getElementById('campus-toggle').classList.contains('active');-->
<!--        console.log('Search clicked:', { category, isOnCampus });-->
<!--    });-->
<!--</script>-->

    <footer>
        <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
    </footer>
</div>

</body>
</html>

