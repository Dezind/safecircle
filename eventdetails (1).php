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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Velvet Underground at Ritz Theater</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
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
            padding-top: 160px;

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
<body>
<header>
    <nav class="navbar2"></nav>
</header>

<div class="top-section">
    <div class="left-column">
        <div class="image-container">
            <img src="your-image.jpg" alt="Event Header Image" class="top-image">
        </div>
        <div class="event-details">
            <h1>The Velvet Underground at Ritz Theater</h1>
            <p>On Sunday, January 5, 2025, The Velvet Underground brings their explosive energy to the Ritz Theater in Los Angeles, as part of their iconic Live Through This Tour.</p>
            <p>Sunday, January 5</p>
            <p>7:00pm - 11:00pm</p>
            <div class="location">
                <p>2820 Industrial Drive, Los Angeles CA <a href="#" style="color: white; text-decoration: none;">📍</a></p>
            </div>
        </div>
    </div>
    <div class="right-column">
        <div class="event-info">
            <h2>Hosted by</h2>
            <p>SafeCircle</p>
            <h2>Website</h2>
            <p>www.thevelvetunderground.com</p>
        </div>
    </div>
</div>

<div class="event-container">
    <div class="card">
        <div class="space-y-8">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-stats tracking-tight">Tech Conference 2024</h3>
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
                        <span class="text-lg text-stats number" style="margin-right: 7px">245</span>
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
                        <span class="text-2xl font-semibold text-stats number" style="margin-right: 7px; font-weight: bold; font-size: 23px">55</span>
                        <span class="text-sm subtle-text" style="margin-top: 3px">spots left</span>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="progress-container">
                    <div class="progress-glow" style="width: 81.67%"></div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: 81.67%"></div>
                    </div>
                </div>
                <div class="flex justify-between text-sm subtle-text px-1">
                    <span>81.67% filled</span>
                    <span>Capacity: 300</span>
                </div>
            </div>
        </div>
    </div>

    <div class="who-is-going">
        <h2>Who's Going</h2>
        <div class="friends-section">
            <h3>Friends</h3>
            <div class="friends">
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
                <button>Invite Friends</button>
            </div>
        </div>
        <div class="other-attendees-section">
            <h3>Other Attendees</h3>
            <div class="other-attendees">
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
            </div>
        </div>
    </div>

    <div class="activity">
        <h2>Activity</h2>
        <div class="activity-item">
            <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
            <p>Amy RSVPed <strong>Going</strong> two hours ago</p>
        </div>
        <div class="activity-item">
            <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
            <p>Amy RSVPed <strong>Going</strong> two hours ago</p>
        </div>
        <div class="activity-item">
            <div class="profile-image" style="background-image: url('velvetunderground.png')"></div>
            <p>Amy RSVPed <strong>Going</strong> two hours ago</p>
        </div>
    </div>
</div>
</body>
</html>
