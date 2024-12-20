
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-E5TVCZMWYR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-E5TVCZMWYR');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        <p>Find All The Excitement Here</p>
    </div>
</div>

<div class="container2">

<!---------------------------------------------------------------------------------------------------------------------->
<!-----------------------------------------------NEEDS PHP HERE--------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------------->

    <form class="search-bar" action="eventresultspage.php" style="margin-top: 30px" style='font-family: "Outfit", -apple-system, BlinkMacSystemFont, sans-serif;'>
        <input type="text" name="eventname" placeholder="Find an event" style="width: 300px">
        <select name="category" style='font-family: "Outfit", -apple-system, BlinkMacSystemFont, sans-serif;'>
            <option value="All" style='font-family: "Outfit", -apple-system, BlinkMacSystemFont, sans-serif;'>Select Category</option>
            <?php
            while($currentrow = $results->fetch_assoc()){
            echo "<option value='" . $currentrow['event_type'] . "'>" . $currentrow['event_type'] . "</option>";
            }
            ?>
        </select>
        <!-------On Campus Button-------->
        <div class="campus-filter" style='font-family: "Outfit", -apple-system, BlinkMacSystemFont, sans-serif;'>
            <span>On-Campus Only</span>
            <label class="switch">
                <input type="checkbox" name="toggle">
                <span class="slider round"></span>
            </label>
        </div>

        <!-------Date-------->
        <div class="date-input-container">
            <input type="date" name="date" id="dateInput">
            <button type="button" class="calendar-button" onclick="document.getElementById('dateInput').showPicker()">
                <svg class="calendar-icon" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M 6 4 h 12 a 2 2 0 0 1 2 2 v 10 a 2 2 0 0 1 -2 2 H 6 a 2 2 0 0 1 -2 -2 V 6 a 2 2 0 0 1 2 -2 M 4 8 h 16 M 8 2 v 4 M 16 2 v 4"></path>
                </svg>
            </button>
        </div>


        <!---Search Button---->
        <button type="submit" value="submit" class="search-button">
            <svg class="svg" width="28" height="28" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M 18 18 l -5 -5 m 2 -4 a 6 6 0 1 1 -12 0 a 6 6 0 0 1 12 0 Z"></path>
            </svg>

        </button>
    </form>

    <div class="categories">
        <h2>Popular Categories</h2>
        <div class="category-buttons" style="font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;">


            <?php
            $results -> data_seek(0);
            while($currentrow = $results->fetch_assoc()){
                echo "<button class='category-button' >" . $currentrow['event_type'] . "</button>";

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
<div class="cursor"></div>

<script>

    document.addEventListener('mousemove', (e) => {
        document.body.style.setProperty('--x', e.clientX + 'px');
        document.body.style.setProperty('--y', e.clientY + 'px');
    });

    // Add click effect
    document.addEventListener('click', (e) => {
        createSparkles(e.clientX, e.clientY);
    });

    function createSparkles(x, y) {
        const sparkleCount = 8;

        for(let i = 0; i < sparkleCount; i++) {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';

            const size = Math.random() * 8 + 4;
            sparkle.style.width = `${size}px`;
            sparkle.style.height = `${size}px`;

            const angle = (Math.PI * 2 * i) / sparkleCount;
            const distance = Math.random() * 50 + 30;

            const tx = Math.cos(angle) * distance;
            const ty = Math.sin(angle) * distance;

            sparkle.style.left = `${x}px`;
            sparkle.style.top = `${y}px`;
            sparkle.style.setProperty('--tx', `${tx}px`);
            sparkle.style.setProperty('--ty', `${ty}px`);

            document.body.appendChild(sparkle);

            setTimeout(() => {
                sparkle.remove();
            }, 800);
        }
    }
</script>
    <footer>
        <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
    </footer>
</div>

</body>
</html>

