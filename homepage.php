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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <link type="text/css" href="css/homepage.css" rel="stylesheet"
    <title>HOME PAGE - (purely placeholders)</title>
        <style></style>
</head>


<body onload="hideLoadingScreen()">
<?php include "header2.php"; ?>
<?php include "cursor.php"; ?>


<?php include "loadingscreen.php"; ?>


<div class="containerx">
    <div class="welcometext">Welcome to your SafeCircle, <?php echo $_SESSION['fname'] ?>!

        <br><br>
        <!--DOWN ARROW SCROLL BUTTON TEST-->
        <img class="arrow" src="images/arrow.png" alt="pic of arrow" onClick="document.getElementById('jumptopoint').scrollIntoView({ behavior: 'smooth' });" />

    </div>

    <div class="headerx">
        <h1 class="hptitle" id="jumptopoint">Event Suggestions</h1>
        <br>
        <div class="filtersx">
            <button class="filter-btn" onclick="toggleDropdown('eventType')">
                EVENT TYPE ▼
                <div id="eventTypeDropdown" class="dropdown-content">
                    <?php
                    $sql = "SELECT * FROM event_types";

                    $results = $mysql->query($sql);

                    if(!$results) {
                        echo "SQL error: ". $mysql->error . " running query <hr>" . $sql . "<hr>";
                        exit();
                    }

                    while($currentrow = $results->fetch_assoc()){
                        echo "<option value='" . $currentrow['event_type'] . "'>" . $currentrow['event_type'] . "</option>";
                    }
                    ?>
                    <a href="#">Music</a>
                    <a href="#">Art</a>
                    <a href="#">Sports</a>
                    <a href="#">Food</a>
                </div>
            </button>
            <button class="filter-btn" onclick="toggleDropdown('date')">
                DATE ▼
                <div id="dateDropdown" class="dropdown-content">
                    <a href="#">Today</a>
                    <a href="#">This Week</a>
                    <a href="#">This Month</a>
                    <a href="#">All</a>
                </div>
            </button>
            <button class="filter-btn" onclick="toggleDropdown('location')">
                LOCATION ▼
                <div id="locationDropdown" class="dropdown-content">
                    <a href="#">Near Me</a>
                    <a href="#">Downtown</a>
                    <a href="#">Suburbs</a>
                    <a href="#">All</a>
                </div>
            </button>
            <button class="filter-btn" onclick="toggleDropdown('price')">
                PRICE ▼
                <div id="priceDropdown" class="dropdown-content">
                    <a href="#">Free</a>
                    <a href="#">Under $50</a>
                    <a href="#">Under $100</a>
                    <a href="#">All</a>
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
    $results1 = $mysql->query($sql1);

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
    // Optionally, you could add pagination controls here.
    // For example:
    // echo '<a href="?start='.($start-5).'">Previous</a> | <a href="?start='.($start+5).'">Next</a>';
    ?>



    <div class="gallery-container clearfix">
        <div class="gallery-grid">

            <div class="gallery-card">

                <img src="images/homepagephotos/homep1.png" alt="Event 1" class="gallery-image">

                <div class="gallery-details">

                    <h3 class="gallery-caption">Event #1</h3>
                    <p class="gallery-description">Event #1 Description</p>

                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>

                </div>

            </div>




            <div class="gallery-card">
                <img src="images/homepagephotos/homep2.png" alt="Event 2" class="gallery-image">
                <div class="gallery-details">
                    <h3 class="gallery-caption">Event #2</h3>
                    <p class="gallery-description">Event #2 Description</p>
                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>
                </div>
            </div>
            <div class="gallery-card">
                <img src="images/homepagephotos/homep3.png" alt="Event 3" class="gallery-image">
                <div class="gallery-details">
                    <h3 class="gallery-caption">Event #3</h3>
                    <p class="gallery-description">Event #3 Description</p>
                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>
                </div>
            </div>
            <div class="gallery-card">
                <img src="images/homepagephotos/homep4.png" alt="Event 4" class="gallery-image">
                <div class="gallery-details">
                    <h3 class="gallery-caption">Event #4</h3>
                    <p class="gallery-description">Event #4 Description</p>
                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-----------------------------------Featured Events-------------------------------->

    <div class="hptitle">Featured Events</div>
    <br>

    <div class="gallery-container clearfix">
        <div class="gallery-grid">
            <div class="gallery-card">
                <img src="images/homepagephotos/homep5.png" alt="Event 5" class="gallery-image">
                <div class="gallery-details">
                    <h3 class="gallery-caption">Event #5</h3>
                    <p class="gallery-description">Event #5 Description</p>
                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>
                </div>
            </div>
            <div class="gallery-card">
                <img src="images/homepagephotos/homep6.png" alt="Event 6" class="gallery-image">
                <div class="gallery-details">
                    <h3 class="gallery-caption">Event #6</h3>
                    <p class="gallery-description">Event #6 Description</p>
                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>
                </div>
            </div>
            <div class="gallery-card">
                <img src="images/homepagephotos/homep7.png" alt="Event 7" class="gallery-image">
                <div class="gallery-details">
                    <h3 class="gallery-caption">Event #7</h3>
                    <p class="gallery-description">Event #7 Description</p>
                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>
                </div>
            </div>
            <div class="gallery-card">
                <img src="images/homepagephotos/homep8.png" alt="Event 8" class="gallery-image">
                <div class="gallery-details">
                    <h3 class="gallery-caption">Event #8</h3>
                    <p class="gallery-description">Event #8 Description</p>
                    <div class="button-group">
                        <button class="share-btn">Share</button>
                        <button class="download-btn">RSVP</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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