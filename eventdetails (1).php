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
    <title>The Velvet Underground at Ritz Theater</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000000;
            color: white;
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

        .event-container {
            padding: 120px 20px 40px;
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
            margin-bottom: 40px;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 20px;
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

        .event-poster {
            max-width: 100%;
            height: auto;
            margin-bottom: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .who-is-going h2, .photo-album h2, .activity h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .friends-section, .other-attendees-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
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

        .friends button, .album-actions button {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            padding: 10px 20px;
            font-size: 0.9rem;
            cursor: pointer;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .friends button:hover, .album-actions button:hover {
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

        .activity {
            margin-bottom: 40px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 10px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .activity-item .profile-image {
            width: 40px;
            height: 40px;
            margin-right: 15px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-item p {
            margin: 0;
            font-size: 0.9rem;
            color: white;
        }

        footer {
            background-color: black;
            color: #9ca3af;
            padding: 20px;
            text-align: center;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar2"></nav>
    </header>

    <div class="event-container">
        <div class="event-details">
            <h1>The Velvet Underground at Ritz Theater</h1>
            <p>Sunday, January 5</p>
            <p>7:00pm - 11:00pm</p>
            <div class="location">
                <p>2820 Industrial Drive, Los Angeles CA <a href="#" style="color: white; text-decoration: none;">📍</a></p>
            </div>
            <div class="event-info">
                <h2>Hosted by</h2>
                <p>SafeCircle</p>
                <h2>Website</h2>
                <p>www.thevelvetunderground.com</p>
            </div>
            <img src="velvetunderground.png" alt="The Velvet Underground Live Through This Tour" class="event-poster">
            <p>On Sunday, January 5, 2025, The Velvet Underground brings their explosive energy to the Ritz Theater in Los Angeles, as part of their iconic Live Through This Tour.</p>
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
            <div class="activity-item">
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div> 
                <p>Amy RSVPed <strong>Going</strong> two hours ago</p>
            </div>
            <div class="activity-item">
                <div class="profile-image" style="background-image: url('velvetunderground.png')"></div> 
                <p>Amy RSVPed <strong>Going</strong> two hours ago</p>
            </div>

</html>
