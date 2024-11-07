
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>Event Search Page</title>
</head>
<?php
//
//$host = "webdev.iyaserver.com";
//$userid = "<youruserid>";
//$userpw = "<yourpw>";
//$db = "<database name>";
//
//include 'loginvariables.php';
//
//
//$mysql = new mysqli(
//    $host,
//    $userid,
//    $userpw,
//    $db
//);
//
//if ($mysql->connect_errno) {
//    echo "db connection error : " . $mysql->connect_error;
//    exit();
//}
//
//echo "db connection succeeded\n";
//?>
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

    <div class="search-bar">
        <!-------Category Dropdown-------->
        <select id="category">
            <option value="Music">Select Category</option>
            <option value="Music">Music</option>
            <option value="Sports">Sports</option>
            <option value="Technology">Technology</option>
            <option value="Art">Art</option>
            <option value="Health & Wellness">Health & Wellness</option>
            <option value="Gaming">Gaming</option>
            <option value="Food">Food</option>
            <option value="Travel">Travel</option>
            <option value="Fitness">Fitness</option>
            <option value="Photography">Photography</option>
            <option value="Networking">Networking</option>
            <option value="Community Service">Community Service</option>
            <option value="Workshops">Workshops</option>
            <option value="Startups">Startups</option>
            <option value="Nature">Nature</option>
            <option value="Film">Film</option>
            <option value="Dance">Dance</option>
            <option value="Literature">Literature</option>
            <option value="Cultural Events">Cultural Events</option>
            <option value="Science & Innovation">Science & Innovation</option>
        </select>
        <!-------On Campus Button-------->
        <div class="toggle-container">
            <span>On-Campus Only</span>
            <div class="toggle" id="campus-toggle">
                <div class="toggle-thumb"></div>
            </div>
        </div>
        <!-------Date-------->
        <input type="date">
        <!------Distance------->
        <input type="text" placeholder="Distance (miles)">
        <!-----Zip Code------>
        <input type="text" placeholder="ZIP Code">

        <!---Search Button---->
        <button class="search-button">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Search
        </button>
    </div>

    <div class="categories">
        <h2>Popular Categories</h2>
        <div class="category-buttons">
            <button class="category-button">Music</button>
            <button class="category-button">Sports</button>
            <button class="category-button">Technology</button>
            <button class="category-button">Art</button>
            <button class="category-button">Health & Wellness</button>
            <button class="category-button">Gaming</button>
            <button class="category-button">Food</button>
            <button class="category-button">Travel</button>
            <button class="category-button">Fitness</button>
            <button class="category-button">Photography</button>
            <button class="category-button">Networking</button>
            <button class="category-button">Community Service</button>
            <button class="category-button">Workshops</button>
            <button class="category-button">Startups</button>
            <button class="category-button">Nature</button>
            <button class="category-button">Film</button>
            <button class="category-button">Dance</button>
            <button class="category-button">Literature</button>
            <button class="category-button">Cultural Events</button>
            <button class="category-button">Science & Innovation</button>
        </div>
    </div>

    <div class="events">
        <h2>Events Of The Month</h2>
        <p>Discover the upcoming trending events</p>
        <div class="event-grid">
            <div class="event-card">
                <div class="event-placeholder">Event Image Placeholder</div>
            </div>
            <div class="event-card">
                <div class="event-placeholder">Event Image Placeholder</div>
            </div>
            <div class="event-card">
                <div class="event-placeholder">Event Image Placeholder</div>
            </div>
            <div class="event-card">
                <div class="event-placeholder">Event Image Placeholder</div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle functionality
    const toggle = document.getElementById('campus-toggle');
    toggle.addEventListener('click', function() {
        this.classList.toggle('active');
    });

    // Category buttons
    const categoryButtons = document.querySelectorAll('.category-button');
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            console.log('Selected category:', this.textContent);
        });
    });

    // Search button
    const searchButton = document.querySelector('.search-button');
    searchButton.addEventListener('click', function() {
        const category = document.getElementById('category').value;
        const isOnCampus = document.getElementById('campus-toggle').classList.contains('active');
        console.log('Search clicked:', { category, isOnCampus });
    });
</script>

    <footer>
        <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
    </footer>
</div>

</body>
</html>

