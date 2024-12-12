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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Velvet Underground at Ritz Theater</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
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
        body {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000000;
            color: white;
            padding-top: 80px;
        }

        .navbar2 {
            background-color: black;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .top-section {
            display: flex;
            gap: 40px;
            max-width: 800px;
            margin: 0 auto 40px;
            padding: 0 20px;
        }

        .left-column {
            flex: 2;
        }

        .right-column {
            flex: 1;
        }

        .image-container {
            margin-bottom: 20px;
        }

        .top-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .event-container {
            padding: 0 20px 40px;
            max-width: 800px;
            margin: 0 auto;
        }

        .event-details h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .event-details p {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #a3a3a3;
        }

        .location {
            font-size: 0.9rem;
            color: #9ca3af;
            margin-bottom: 40px;
        }

        .event-info {
            margin-bottom: 0;
            background-color: rgba(255, 255, 255, 0.05);
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right:20px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .event-info h2 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: white;
        }

        .event-info p {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #a3a3a3;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            width: 100%;
            color: white;
            margin-bottom: 40px;
            margin-top: 50px;
        }

        .progress-container {
            position: relative;
            margin: 32px 0;
            padding: 4px;
        }

        .progress-bar {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            height: 8px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar-fill {
            background: white;
            height: 100%;
            transition: width 0.3s ease;
            position: relative;
            border-radius: 100px;
            box-shadow:
                    0 0 20px rgba(255, 255, 255, 1),
                    0 0 40px rgba(255, 255, 255, 0.8),
                    0 0 60px rgba(255, 255, 255, 0.6),
                    0 0 80px rgba(255, 255, 255, 0.4);
        }

        .progress-glow {
            position: absolute;
            top: 50%;
            left: 0;
            height: 8px;
            background: white;
            filter: blur(16px);
            opacity: 0.6;
            transform: translateY(-50%);
            transition: width 0.3s ease;
            border-radius: 100px;
        }

        .icon {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .text-stats {
            color: white;
        }

        .subtle-text {
            color: rgba(255, 255, 255, 0.7);
        }

        .trending-badge {
            background: rgba(255, 255, 255, 0.1);
            padding: 4px 12px;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            letter-spacing: 0.3px;
        }

        .number {
            letter-spacing: -0.5px;
        }

        .space-y-8 {
            padding: 24px;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .space-x-2 {
            margin-left: 1rem;
        }

        .space-x-3 {
            margin-left: 0.75rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .px-1 {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }

        .who-is-going h2, .photo-album h2, .activity h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .friends-section, .other-attendees-section {
            margin-bottom: 20px;

            padding: 0px 20px 20px 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .friends-section h3, .other-attendees-section h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 5px;
        }

        .friends, .other-attendees {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .friends button {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            padding: 10px 20px;
            font-size: 0.9rem;
            cursor: pointer;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .friends button:hover {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            transform: scale(1.02);
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 10px;
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .activity-item .profile-image {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }

        .activity-item p {
            margin: 0;
            font-size: 0.9rem;
            color: white;
        }
    </style>
</head>
<?php include 'header2.php' ?>
<body>


<?php

$sql = "SELECT * FROM eventview WHERE event_id = " . $_REQUEST['event_id'];

$results = $mysql->query($sql);

if(!$results) {
    echo "SQL error: ". htmlspecialchars($mysql->error) . " running query <hr>" . htmlspecialchars($sql) . "<hr>";
    exit();
}

while($row = $results->fetch_assoc()) {
    $event_name     = $row['event_name'];
    $event_date     = $row['event_date'];
    $start_time     = $row['start_time'];
    $end_time       = $row['end_time'];
    $description    = $row['description'];
    $location       = $row['location'];
    $address        = $row['address'];
    $address        = $row['address'];
    $event_type  = $row['event_type'];
    $banner_img = $row['banner_img'];
}
?>
<div class="top-section">
        <div class="image-container">
            <img src="https://amypan.webdev.iyaserver.com/safecircle/images/banners/<?php echo htmlspecialchars($banner_img); ?>" alt="Event Header Image" class="top-image">
        </div>
</div>

<div class="top-section">
    <div class="left-column">
        <div class="event-details">
            <h1><?php echo $event_name ?></h1>
            <p><?php echo $description ?></p>
        </div>
    </div>
    <div class="right-column">
        <div class="event-info">
            <h2><?php echo date('D, M j', strtotime($event_date)); ?></h2>
            <p><?php echo date('g:ia', strtotime($start_time)); ?></p>
            <h2><?php echo $location ?></h2>
            <p><?php echo $address ?></p>
        </div>
    </div>
</div>

<?php include 'rsvp_graphic.php' ?>

<?php

$eventId = $_REQUEST['event_id']; // Replace with dynamic event_id if needed
$currentUser = $_SESSION['user_id']; // Replace with the logged-in user's name

$sqlFriends = "SELECT DISTINCT users.username AS friend_name, users.profile_picture FROM friends JOIN rsvp_view ON (friends.user_id_1 = rsvp_view.user_id OR friends.user_id_2 = rsvp_view.user_id) 
    JOIN users ON users.user_id = rsvp_view.user_id WHERE rsvp_view.event_id = ". $eventId ." 
                 AND (friends.user_id_1 = '". $currentUser ."')";

$resultFriends = $mysql->query($sqlFriends);

// Fetch other attendees (non-friends)
$sqlAttendees = "SELECT users.username AS attendee_name, users.profile_picture 
                 FROM rsvp_view
                 JOIN users ON users.user_id = rsvp_view.user_id
                 WHERE rsvp_view.event_id = ". $eventId ."
                 ";
$resultAttendees = $mysql->query($sqlAttendees);

$mysql->close();
?>

<div class="event-container">

    <!-- Who's Going Section -->
    <div class="who-is-going">
        <h2>Who's Going</h2>

        <!-- Friends Section -->
        <div class="friends-section">
            <h3>Friends</h3>
            <div class="friends">
                <?php
                if ($resultFriends->num_rows > 0) {
                    while ($friend = $resultFriends->fetch_assoc()) {
                        echo "<div class='profile-image' style='background-image: url(https://ddelgatt.webdev.iyaserver.com/acad276/safecircle/images/profile_pics/" . $friend['profile_picture'] . ")'></div>";
                    }
                } else {
                    echo "<p>No friends attending yet.</p>";
                }
                ?>
                <button>Invite Friends</button>
            </div>
        </div>

        <!-- Other Attendees Section -->
        <div class="other-attendees-section">
            <h3>Other Attendees</h3>
            <div class="other-attendees">
                <?php
                if ($resultAttendees->num_rows > 0) {
                    while ($attendee = $resultAttendees->fetch_assoc()) {
                        echo "<div class='profile-image' style='background-image: url(https://ddelgatt.webdev.iyaserver.com/acad276/safecircle/images/profile_pics/" . $attendee['profile_picture'] . ")'></div>";
                    }
                } else {
                    echo "<p>No other attendees yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>

</div>

</body>
</html>
