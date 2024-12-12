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
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Responsive Typography */
        html {
            font-size: 16px;
        }

        body {
            line-height: 1.6;
            width: 100%;
        }

        /* Responsive Images */
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Responsive Layout */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Responsive Grid */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col {
            flex: 1;
            padding: 0 15px;
        }

        /* Mobile-First Media Queries */
        /* Tablet Styles */
        @media screen and (max-width: 768px) {
            html {
                font-size: 14px;
            }

            .col {
                flex: 0 0 100%;
            }

            /* Responsive Navigation */
            nav ul {
                flex-direction: column;
            }

            nav li {
                width: 100%;
                text-align: center;
            }
        }

        /* Mobile Styles */
        @media screen and (max-width: 480px) {
            html {
                font-size: 12px;
            }

            .container {
                padding: 0 10px;
            }
        }

        /* Responsive Typography */
        h1 {
            font-size: 2.5rem;
        }

        h2 {
            font-size: 2rem;
        }

        h3 {
            font-size: 1.5rem;
        }

        /* Responsive Tables */
        table {
            width: 100%;
            overflow-x: auto;
            display: block;
        }

        /* Responsive Embeds (like videos) */
        .responsive-embed {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
        }

        .responsive-embed iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Flexible Touch Targets */
        button,
        a,
        input,
        select {
            min-height: 44px;
            min-width: 44px;
        }

        /* Hide/Show Elements Responsively */
        .mobile-only {
            display: none;
        }

        .desktop-only {
            display: block;
        }

        @media screen and (max-width: 768px) {
            .mobile-only {
                display: block;
            }

            .desktop-only {
                display: none;
            }
        }
        .results {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 25px;
            margin-bottom: 20px;
            margin-left: -20px;
            margin-right: auto;
            max-width: 1200px;
        }

        .rounded-button {
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.8);
            color: white;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            z-index: 998;
            text-decoration: none;
            display: inline-block;
        }

        .rounded-button:hover {
            border-color: white;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5),
            0 0 30px rgba(255, 255, 255, 0.3),
            0 0 40px rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
            background: rgba(255, 255, 255, 0.1);
            animation: glow 1.5s ease-in-out infinite;
        }

        .rounded-button:active {
            transform: scale(0.98);
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            }
            50% {
                box-shadow: 0 0 25px rgba(255, 255, 255, 0.5),
                0 0 35px rgba(255, 255, 255, 0.3);
            }
            100% {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            }
        }

        .rounded-button:hover {
            animation: glow 1.5s ease-in-out infinite;
        }

        .search-bar-container {
            margin: 0 auto;
            max-width: 1200px;
        }
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
                   style="width: 100%; text-align: left; padding: 8px 0; padding-left: 0;"
                   value="<?php echo htmlspecialchars($eventname); ?>">

            <!-- Select -->
            <select name="category"
                    style="width: 100%; margin: 0; text-align: left; padding: 8px 0; padding-left: 0; color: white;">
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
                 style="width: 100%; justify-content: space-between; padding: 8px 0; padding-left: 0;">
                <span style="text-align: left; margin-left: 2px; font-family: 'Helvetica Neue', serif;">On-Campus Only</span>
                <label class="switch">
                    <input type="checkbox" name="toggle" <?php echo isset($_REQUEST['toggle']) && $_REQUEST['toggle'] == "on" ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                </label>
            </div>

            <!-- Date input -->
            <div class="date-input-container"
                 style="width: 100%; padding: 8px 0; padding-left: 2px;">
                <input type="date"
                       name="date"
                       id="dateInput"
                       style="width: 100%; text-align: left; padding-left: 0;"
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
            <button type="submit" value="submit" class="search-button" style="align-self: center;">
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



    <div class="search-bar-container">
        <?php
        $sql1 = "SELECT * FROM eventview WHERE 1=1";

        if($eventname != "") {
            $sql1 .= " AND event_name LIKE '%" . $mysql->real_escape_string($eventname) . "%'";
        }

        if($category != "All") {
            $sql1 .= " AND event_type ='" . $mysql->real_escape_string($category) . "'";
        }

        if (isset($_REQUEST['toggle']) && $_REQUEST['toggle'] == "on") {
            $sql1 .= " AND oncampus = 1";
        }

        if ($date != "") {
            $sql1 .= " AND event_date = '" . $mysql->real_escape_string($date) . "'";
        }

        $results1 = $mysql->query($sql1);

        if(!$results1) {
            echo "SQL error: ". $mysql->error . " running query <hr>" . $sql1 . "<hr>";
            exit();
        }

        // Pagination logic
        $total_results = $results1->num_rows;
        $resultsPerPage = 6;
        $total_pages = ceil($total_results / $resultsPerPage);
        $current_page = isset($_REQUEST['page']) ? max(1, intval($_REQUEST['page'])) : 1;
        $start = ($current_page - 1) * $resultsPerPage + 1;
        $end = min($start + ($resultsPerPage - 1), $total_results);
        ?>

        <!-- Results Count Display -->
        <div style="color: white; margin-left: -70px; font-family: 'Outfit', sans-serif; font-size: 16px; white-space: nowrap;">
            <?php echo ($total_results > 0) ? "Showing " . $total_results . " matching results" : "No results found"; ?>
        </div>


        <!-- Results Grid -->
        <div class="results">
            <?php
            $results1->data_seek($start - 1);
            $counter = $start;

            while($currentrow = $results1->fetch_assoc()) {
                if($counter > $end) {
                    break;
                }
                include 'event_tile.php';
                $counter++;
            }

            // Build search string for pagination
            $searchstring = "&eventname=" . urlencode($eventname) .
                "&category=" . urlencode($category) .
                "&date=" . urlencode($date);
            if (isset($_REQUEST['toggle'])) {
                $searchstring .= "&toggle=" . $_REQUEST['toggle'];
            }
            ?>
        </div>

        <!-- Pagination Controls -->
        <?php if ($total_results > 0): ?>
            <div style="padding: 0 20px 20px 20px; max-width: 1200px; margin: 0 auto;">
                <div style="float: left; margin-left: -90px;">
                    <?php if ($current_page > 1): ?>
                        <a href="?page=<?php echo ($current_page - 1) . $searchstring; ?>" class="rounded-button">Previous</a>
                    <?php endif; ?>
                </div>
                <div style="float: right;">
                    <?php if ($current_page < $total_pages): ?>
                        <a href="?page=<?php echo ($current_page + 1) . $searchstring; ?>" class="rounded-button">Next</a>
                    <?php endif; ?>
                </div>
                <div style="clear: both;"></div>

                <!-- Pagination Dots -->
                <div style="display: flex; justify-content: center; gap: 8px; margin: -20px 0; margin-left: -120px;">
                    <?php for($i = 1; $i <= $total_pages; $i++): ?>
                        <div style="
                                height: 8px;
                                width: 8px;
                                border-radius: 50%;
                                background-color: <?php echo $i === $current_page ? '#ffffff' : 'rgba(255, 255, 255, 0.5)'; ?>;
                                transition: all 0.3s ease;
                                "></div>
                    <?php endfor; ?>
                </div>
            </div>

        <?php endif; ?>
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

    // Filter panel toggle
    document.addEventListener('DOMContentLoaded', function () {
        const filterPanel = document.querySelector('.filter-panel');
        const filterToggle = document.querySelector('.filter-toggle');

        filterToggle.addEventListener('click', function () {
            filterPanel.classList.toggle('expanded');
            if (filterPanel.classList.contains('expanded')) {
                filterToggle.style.left = '100px';
            } else {
                filterToggle.style.left = '19px';
            }
        });
    });
</script>

<?php include "footer.php"; ?>
</body>
</html>