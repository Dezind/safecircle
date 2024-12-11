<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: emailcheckpage.php");
    exit();
}

$host = "webdev.iyaserver.com";
$userid = "<youruserid>";
$userpw = "<yourpw>";
$db = "<database name>";

include 'loginvariables.php';

$mysql = new mysqli($host, $userid, $userpw, $db);

if ($mysql->connect_errno) {
    echo "Database connection error: " . $mysql->connect_error;
    exit();
}


?>
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
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <link type="text/css" href="css/homepage.css" rel="stylesheet"
    <title>HOME PAGE - (purely placeholders)</title>
    <style></style>
</head>
<script>
    function setFilter(key, value) {
        // Get current query parameters
        const url = new URL(window.location.href);
        url.searchParams.set(key, value); // set or update the filter param
        window.location.href = url.toString(); // reload page with new params
    }

</script>


<body>
<?php include "header2.php"; ?>
<?php include "cursor.php"; ?>

<div class="containerx">
    <div class="welcometext">Welcome to your SafeCircle, <?php echo $_SESSION['fname'] ?>!

        <br><br>
        <!--DOWN ARROW SCROLL BUTTON TEST-->
        <img class="arrow" src="images/arrow.png" alt="pic of arrow" onClick="document.getElementById('jumptopoint').scrollIntoView({ behavior: 'smooth' });" />

    </div>


    <div class="hptitle" >Personalized Suggestions</div>
    <br>
    <?php
    $start = !empty($_REQUEST['start']) ? (int)$_REQUEST['start'] : 1;
    $end = $start + 3;
    $counter = 1;

    $preferencesql = "SELECT * FROM event_preference_view WHERE user_id = '" . $_SESSION['user_id'] . "' AND event_date >= CURRENT_DATE()";

    $preferences = $mysql->query($preferencesql);

    if(!$preferences) {
        echo "SQL error: ". $mysql->error . " running query <hr>" . $preferencesql . "<hr>";
        exit();
    }
    ?>
    <div class="gallery-container clearfix">
        <div class="gallery-grid">
            <?php while($currentrow = $preferences->fetch_assoc()): ?>
                <?php if($counter >= $start && $counter <= $end): ?>
                    <div class="gallery-card">
                        <img src="images/banners/<?php echo htmlspecialchars($currentrow['banner_img']); ?>" alt="Event Banner" class="gallery-image">
                        <div class="gallery-details">
                            <h3 class="gallery-caption"><?php echo htmlspecialchars($currentrow['event_name']); ?></h3>
                            <p class="gallery-description">
                                <?php echo date('D, M j', strtotime($currentrow['event_date'])); ?> •
                                <?php echo date('g:ia', strtotime($currentrow['start_time'])); ?>
                            </p>
                            <div class="button-group">
                                <button class="share-btn">Share</button>
                                <button class="download-btn">RSVP</button>
                            </div>
                        </div> <!-- /.gallery-details -->
                    </div> <!-- /.gallery-card -->
                <?php endif; ?>

                <?php
                // Increment the counter after each row
                $counter++;

                // If we've printed all the events we need, break out of the loop
                if($counter > $end) {
                    break;
                }
                ?>
            <?php endwhile; ?>
        </div>
    </div>

    <?php
    echo '<a href="?start='.($start-5).'">Previous</a> | <a href="?start='.($start+5).'">Next</a>';
    ?>


    <?php
    $sql = "SELECT * FROM event_types";

    $results = $mysql->query($sql);

    if(!$results) {
        echo "SQL error: ". $mysql->error . " running query <hr>" . $sql . "<hr>";
        exit();
    }
    ?>


    <div class="headerx">
        <h1 class="hptitle" id="jumptopoint">Event Suggestions</h1>
        <br>
        <div class="filtersx">
            <button class="filter-btn" onclick="toggleDropdown('eventType')">
                EVENT TYPE ▼
                <div id="eventTypeDropdown" class="dropdown-content">
                    <?php while($currentrow = $results->fetch_assoc()): ?>
                        <a href="#" onclick="setFilter('event_type', '<?php echo $currentrow['event_type'] ?>')"><?php echo $currentrow['event_type'] ?></a>
                    <?php endwhile; ?>
                    <a href="#" onclick="setFilter('event_type', 'all')">Today</a>
                </div>
            </button>
            <button class="filter-btn" onclick="toggleDropdown('date')">
                DATE ▼
                <div id="dateDropdown" class="dropdown-content">
                    <a href="#" onclick="setFilter('event_date', 'today')">Today</a>
                    <a href="#" onclick="setFilter('event_date', 'this_week')">This Week</a>
                    <a href="#" onclick="setFilter('event_date', 'this_month')">This Month</a>
                    <a href="#" onclick="setFilter('event_date', 'all')">All</a>
                </div>
            </button>
            <button class="filter-btn" onclick="toggleDropdown('location')">
                LOCATION ▼
                <div id="locationDropdown" class="dropdown-content">
                    <a href="#" onclick="setFilter('oncampus', 'oncampus')">On Campus</a>
                    <a href="#" onclick="setFilter('oncampus', 'downtown')">Downtown</a>
                    <a href="#" onclick="setFilter('oncampus', 'all')">All</a>
                </div>
            </button>
        </div>
    </div>




    <!-----------------------------------Recommended Events-------------------------------->

    <div class="hptitle" >Recommended for You</div>
    <br>


    <?php
    // Ensure that $mysql is an active MySQLi connection.
    // Example:
    // $mysql = new mysqli("localhost", "username", "password", "database");
    // if($mysql->connect_error) {
    //     die("Connection failed: " . $mysql->connect_error);
    // }

    // Determine the 'start' index, defaulting to 1 if not provided
    $start = !empty($_REQUEST['start']) ? (int)$_REQUEST['start'] : 1;
    $end = $start + 3;
    $counter = 1;

    $sql1 = "SELECT * FROM eventview WHERE event_date >= CURRENT_DATE()";

    if (!empty($_GET['event_type']) && $_GET['event_type'] !== 'all') {
        $eventType = $_GET['event_type'];
        $sql1 .= " AND event_type = '$eventType'";
    } else {
        $sql1 .= "";
    }

    if (!empty($_GET['event_date'])) {
        $date = $_GET['event_date'];


        // Determine which filter to apply.
        if ($date === 'today') {
            // Filter for events that have today's date
            $sql1 .= " AND event_date = CURDATE()";
        } elseif ($date === 'this_week') {
            // Filter for events in the current week.
            // YEARWEEK() returns the year and week number;
            // using YEARWEEK with CURDATE() isolates the current week's events.
            $sql1 .= " AND YEARWEEK(event_date, 1) = YEARWEEK(CURDATE(), 1)";
        } elseif ($date === 'this_month') {
            // Filter for events occurring in the current month.
            $sql1 .= " AND MONTH(event_date) = MONTH(CURDATE()) AND YEAR(event_date) = YEAR(CURDATE())";
        } elseif ($date !== 'all') {
            // If $date is presumably a specific date in YYYY-MM-DD format, filter by that exact date.
            $sql1 .= "";
        }
    }

    if (!empty($_GET['oncampus'])) {
        $oncampus = $_GET['oncampus'];


        // Determine which filter to apply.
        if ($oncampus === 'oncampus') {
            // Filter for events that have today's date
            $sql1 .= " AND oncampus = '1'";
        } elseif ($oncampus === 'downtown') {
            $sql1 .= " AND oncampus = '0'";
        } elseif ($oncampus === 'all') {
            $sql1 .= "";
        }
    }

    $results1 = $mysql->query($sql1);

    if($results1 < 1) {
        echo "<div class='hptitle' >No Results</div>";
    }

    if(!$results1) {
        echo "SQL error: ". htmlspecialchars($mysql->error) . " running query <hr>" . htmlspecialchars($sql1) . "<hr>";
        exit();
    }

    ?>

    <div class="gallery-container clearfix">
        <div class="gallery-grid">
            <?php while($currentrow = $results1->fetch_assoc()): ?>
                <?php if($counter >= $start && $counter <= $end): ?>
                    <div class="gallery-card">
                        <img src="images/banners/<?php echo htmlspecialchars($currentrow['banner_img']); ?>" alt="Event Banner" class="gallery-image">
                        <div class="gallery-details">
                            <h3 class="gallery-caption"><?php echo htmlspecialchars($currentrow['event_name']); ?></h3>
                            <p class="gallery-description">
                                <?php echo date('D, M j', strtotime($currentrow['event_date'])); ?> •
                                <?php echo date('g:ia', strtotime($currentrow['start_time'])); ?>
                            </p>
                            <div class="button-group">
                                <button class="share-btn">Share</button>
                                <button class="download-btn">RSVP</button>
                            </div>
                        </div> <!-- /.gallery-details -->
                    </div> <!-- /.gallery-card -->
                <?php endif; ?>

                <?php
                // Increment the counter after each row
                $counter++;

                // If we've printed all the events we need, break out of the loop
                if($counter > $end) {
                    break;
                }
                ?>
            <?php endwhile; ?>
        </div>
    </div>

    <?php
    echo '<a href="?start='.($start-5).'">Previous</a> | <a href="?start='.($start+5).'">Next</a>';
    ?>


    <!-----------------------------------Featured Events-------------------------------->



    <!----------------------------------FRIENDS---------------------------------------->
    <h1 class="hptitle">Friends</h1>
    <div class="friends">
        <?php
        $userid = $_SESSION['user_id'];

        $stmt = $mysql->prepare("SELECT f.friendship_id, f.user_id_1, f.user_id_2, CONCAT(u2.fname, ' ', u2.lname) AS user_2_name, u2.profile_picture FROM friends f JOIN users u1 ON f.user_id_1 = u1.user_id JOIN users u2 ON f.user_id_2 = u2.user_id WHERE f.status = 'Accepted' AND u1.user_id = ?;");
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            echo "<div class='gallery1'>
            <div class='profile-container'>
                <img src='images/profile_pics/" . $row['profile_picture'] .  "' class='profile-image'>
                <div class='online-indicator'></div>
            </div>
            <div class='desc'>" . $row['user_2_name'] . "</div>
        </div>";
        }

        ?>
    </div>

    <!--------------------------------Your Safecircles-------------------------------------->
    <h1 class="hptitle">Your SafeCircles</h1>
    <div class="event-gallery1">
        <div class="event-card1">
            <img src="images/homepagephotos/beach.jpg" alt="Beach Girlies" class="event-image1">
            <div class="event-title-wrapper1">
                <div class="event-title1">Beach Girlies</div>
                <svg class="comment-icon1" viewBox="0 0 24 24" fill="white">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
            </div>
        </div>

        <div class="event-card1">
            <img src="images/homepagephotos/nyc.jpg" alt="NYC" class="event-image1">
            <div class="event-title-wrapper1">
                <div class="event-title1">NYC</div>
                <svg class="comment-icon1" viewBox="0 0 24 24" fill="white">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
            </div>
        </div>

        <div class="event-card1">
            <img src="images/homepagephotos/party.jpg" alt="Party Girls" class="event-image1">
            <div class="event-title-wrapper1">
                <div class="event-title1">Party Girls</div>
                <svg class="comment-icon1" viewBox="0 0 24 24" fill="white">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
            </div>
        </div>

        <div class="event-card1">
            <img src="images/homepagephotos/poker.jpg" alt="Poker Night" class="event-image1">
            <div class="event-title-wrapper1">
                <div class="event-title1">Poker Night</div>
                <svg class="comment-icon1" viewBox="0 0 24 24" fill="white">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
            </div>
        </div>
    </div>






</div>
<!---------------------------------------------DROPDOWN SCRIPT----------------------------------------------------->
<script>

    let currentOpenDropdown = null;
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId + 'Dropdown');

        if (currentOpenDropdown && currentOpenDropdown !== dropdown) {
            currentOpenDropdown.classList.remove('show');
        }
        dropdown.classList.toggle('show');
        currentOpenDropdown = dropdown.classList.contains('show') ? dropdown : null;
        event.stopPropagation();
    }

    document.addEventListener('click', function(event) {
        if (!event.target.matches('.filter-btn')) {
            if (currentOpenDropdown) {
                currentOpenDropdown.classList.remove('show');
                currentOpenDropdown = null;
            }
        }
    });

    document.querySelectorAll('.dropdown-content a').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();

            const parentButton = this.closest('.filter-btn');
            const buttonText = parentButton.childNodes[0];
            const newText = this.textContent + ' ▼';
            buttonText.textContent = newText;

            if (currentOpenDropdown) {
                currentOpenDropdown.classList.remove('show');
                currentOpenDropdown = null;
            }
        });
    });
</script>
<!---------------------------------------------DROPDOWN SCRIPT----------------------------------------------------->



<footer>
    <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
</footer>
<?php include "globe.php"; ?>

</body>
</html>