<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
    <title>Event Search Results</title>
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

$eventname = $_REQUEST['eventname'] ?? '';
$category = $_REQUEST['category'] ?? 'All';
$date = $_REQUEST['date'] ?? '';
?>

<body class="results-page">
<?php include "header.php"; ?>

<div class="container">
    <!-- Filter Panel -->
    <div class="filter-panel">
        <form class="search-bar" action="eventresultspage.php" method="get">
            <!-- Input -->
            <input type="text"
                   name="eventname"
                   placeholder=" Find an event"
                   style="width: 100%;
                          text-align: left;
                          padding: 8px 0;
                          padding-left: 0;"
                   value="<?php echo htmlspecialchars($eventname); ?>">

            <!-- Select -->
            <select name="category"
                    style="width: 100%;
                           margin: 0;
                           text-align: left;
                           padding: 8px 0;
                           padding-left: 0;
                           color: white;">
                <option value="All">Select Category</option>
                <?php
                while($currentrow = $results->fetch_assoc()){
                    $selected = ($category == $currentrow['event_type']) ? 'selected' : '';
                    echo "<option value='" . $currentrow['event_type'] . "' $selected>" . $currentrow['event_type'] . "</option>";
                }
                ?>
            </select>

            <!-- Campus filter -->
            <div class="campus-filter"
                 style="width: 100%;
                        justify-content: space-between;
                        padding: 8px 0;
                        padding-left: 0;">
                <span style="text-align: left; margin-left: 2px; font-family: 'Helvetica Neue', serif;">On-Campus Only</span>
                <label class="switch">
                    <input type="checkbox" name="toggle" <?php echo isset($_REQUEST['toggle']) && $_REQUEST['toggle'] == "on" ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                </label>
            </div>

            <!-- Date input -->
            <div class="date-input-container"
                 style="width: 100%;
                        padding: 8px 0;
                        padding-left: 2px;">
                <input type="date"
                       name="date"
                       id="dateInput"
                       style="width: 100%;
                              text-align: left;
                              padding-left: 0;"
                       value="<?php echo htmlspecialchars($date); ?>"
                       placeholder="mm/dd/yyyy">
                <button type="button"
                        class="calendar-button"
                        onclick="document.getElementById('dateInput').showPicker()">
                    <svg class="calendar-icon" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M 6 4 h 12 a 2 2 0 0 1 2 2 v 10 a 2 2 0 0 1 -2 2 H 6 a 2 2 0 0 1 -2 -2 V 6 a 2 2 0 0 1 2 -2 M 4 8 h 16 M 8 2 v 4 M 16 2 v 4"></path>
                    </svg>
                </button>
            </div>

            <!-- Search button -->
            <button type="submit"
                    value="submit"
                    class="search-button"
                    style="align-self: center;">
                <svg class="svg" width="26" height="26" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M 18 18 l -5 -5 m 2 -4 a 6 6 0 1 1 -12 0 a 6 6 0 0 1 12 0 Z"></path>
                </svg>
            </button>
        </form>

    </div>
    <div class="filter-toggle">
        <svg width="27" height="80" viewBox="0 0 30 80" xmlns="http://www.w3.org/2000/svg" class="arrow-svg">
            <path d="M10 20 L20 40 L10 60" />
        </svg>
    </div>

    <!-- Results Grid -->

    <div class="results">
        <?php
        $sql1 = "SELECT * FROM eventview WHERE 1=1";

        if($eventname != "") {
            $sql1 .= " AND event_name LIKE '%" . $eventname . "%'";
        }

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

        while($currentrow = $results1->fetch_assoc()): ?>
            <?php include 'event_tile.php'?>
        <?php endwhile; ?>
    </div>
</div>

<div class="cursor"></div>

<script>
    // Cursor effect
    document.addEventListener('mousemove', (e) => {
        document.body.style.setProperty('--x', e.clientX + 'px');
        document.body.style.setProperty('--y', e.clientY + 'px');
    });

    // Sparkle effect
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

    document.addEventListener('DOMContentLoaded', function () {
        const filterPanel = document.querySelector('.filter-panel');
        const filterToggle = document.querySelector('.filter-toggle');

        filterToggle.addEventListener('click', function () {
            // Toggle the 'expanded' class on the filter panel
            filterPanel.classList.toggle('expanded');

            // Adjust the toggle position based on panel state
            if (filterPanel.classList.contains('expanded')) {
                filterToggle.style.left = '100px';
            } else {
                filterToggle.style.left = '19px'; // Adjust to match the collapsed panel position
            }
        });
    });

</script>

<?php include "footer.php"; ?>
</body>

</html>