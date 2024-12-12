<?php
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

// Fetch event data from rsvp_view
$eventId = $_REQUEST['event_id']; // Replace with dynamic event_id if needed
$sql = "SELECT event_name, capacity, (SELECT COUNT(*) FROM rsvp_view WHERE event_id = " . $eventId . ") AS signups,
               CAST(capacity AS UNSIGNED) - (SELECT COUNT(*) FROM rsvp_view WHERE event_id = " . $eventId . ") AS spots_left,
               ROUND(((SELECT COUNT(*) FROM rsvp_view WHERE event_id = " . $eventId . ") / CAST(capacity AS UNSIGNED)) * 100, 2) AS progress_percent,
               event_date, start_time, end_time, location, description
        FROM rsvp_view
        WHERE event_id = " . $eventId . "
        LIMIT 1";

$result = $mysql->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $eventName = $row['event_name'];
    $capacity = $row['capacity'];
    $signups = $row['signups'];
    $spotsLeft = $row['spots_left'];
    $progressPercent = $row['progress_percent'];
    $eventDate = $row['event_date'];
    $startTime = $row['start_time'];
    $endTime = $row['end_time'];
    $location = $row['location'];
    $description = $row['description'];
    ?>
    <div class="event-container">
        <div class="card">
            <div class="space-y-8">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-stats tracking-tight"><?php echo $eventName; ?></h3>
                    <div class="trending-badge">
                        <svg class="icon w-4 h-4" viewBox="0 0 24 24">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                        Trending
                    </div>
                </div>

                <div class="flex items-center justify-between px-4">
                    <div class="flex items-center">
                        <svg class="icon w-5 h-5 text-stats opacity-80" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-lg text-stats number" style="margin-right: 7px"><?php echo $signups; ?></span>
                            <span class="text-sm subtle-text">signups</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="icon w-5 h-5 text-stats opacity-80" viewBox="0 0 24 24">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                            <path d="M4 22h16"></path>
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                        </svg>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-2xl font-semibold text-stats number" style="margin-right: 7px; font-weight: bold; font-size: 23px"><?php echo $spotsLeft; ?></span>
                            <span class="text-sm subtle-text" style="margin-top: 3px">spots left</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="progress-container">
                        <div class="progress-glow" style="width: <?php echo $progressPercent; ?>%"></div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: <?php echo $progressPercent; ?>%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between text-sm subtle-text px-1">
                        <span><?php echo $progressPercent; ?>% filled</span>
                        <span>Capacity: <?php echo $capacity; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} // End of if condition
?>