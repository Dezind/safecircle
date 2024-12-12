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
    .navbar2 {
        background-color: black;
        padding: 30px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .nav-left2 {
        display: flex;
        align-items: center;
        gap: 20px;
        width: 120px;
    }

    .nav-icon2 {
        width: 24px;
        height: 24px;
        cursor: pointer;
    }

    .logo2 {
        font-size: 1rem;
        font-weight: bold;
        color: white;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-family: "Helvetica Neue", serif;
        margin-top:5px;
    }

    a {
        color: white;
        text-decoration: none;
    }

    .search-container2 {
        flex-grow: 0;
        width: 250px;
        position: relative;
        margin-left: auto;
        margin-right: 20px;
    }

    .search-bar2 {
        width: 100%;
        padding: 8px 40px 8px 15px;
        border-radius: 20px;
        border: none;
        background-color: #333;
        color: white;
    }

    .search-icon2 {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
    }

    .nav-right2 {
        display: flex;
        align-items: center;
        gap: 20px;
        width: 120px;
        justify-content: flex-end;
    }

    .notification-icon2 {
        position: relative;
    }

    .notification-badge2 {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Updated profile icon styles */
    .profile-dropdown {
        position: relative;
        display: inline-block;
    }

    .profile-icon2 {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #ffffff;
        cursor: pointer;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }


    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #333;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        border-radius: 10px;
        z-index: 1001;
        margin-top:20px;
        margin-left: -110px;
    }

    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
        border-radius: 10px;
        pointer-events: auto;
    }

    .dropdown-content a:hover {
        background-color: #5a5a5a;

    }


    .profile-dropdown.active .dropdown-content {
        display: block;
    }
</style>

<nav class="navbar2">
    <div class="nav-left2">
        <svg class="nav-icon2" viewBox="0 0 24 24" fill="white">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13v6l5.2 3.2.8-1.3-4.5-2.7V7z"/>
        </svg>

        <svg class="nav-icon2" viewBox="0 0 24 24" fill="white">
            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
        </svg>

        <svg class="nav-icon2" viewBox="0 0 24 24" fill="white">
            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
        </svg>
    </div>

    <div class="logo2">
        <h1><a href="homepage.php">SAFECIRCLE</a></h1>
    </div>

    <div class="search-container2">
        <input type="text" class="search-bar2" placeholder="Search...">
        <a href="eventresultspage.php">
            <svg class="search-icon2" viewBox="0 0 24 24" fill="white">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
        </a>
    </div>

    <div class="nav-right2">
        <div class="notification-icon2">
            <svg class="nav-icon2" viewBox="0 0 24 24" fill="white">
                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/>
            </svg>
            <div class="notification-badge2">1</div>
        </div>

        <!--------------------------PROFILE PIC DROPDOWN----------------------------->
        <div class="profile-dropdown">
            <div class="profile-icon2" style="background-image: url('images/profile_pics/<?php echo $_SESSION['profile_picture']?>');"></div>
            <div class="dropdown-content">
                <a href="">My Accounts</a>
                <a href="">SafeCircles</a>
                <?php
                // Check if the user is an admin
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                    echo '<a href="https://amypan.webdev.iyaserver.com/safecircle/admin/adminpage.php">Admin Page</a>';
                }
                ?>
                <a href="user_preference_quiz.php">Preference Quiz</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Select all anchor tags within .dropdown-content or modify selector as needed
        const links = document.querySelectorAll('.dropdown-content a');

        links.forEach(function (link) {
            link.addEventListener('click', function (e) {
                // Prevent default link behavior if needed
                e.preventDefault();

                // Ensure navigation to the link's href works
                if (this.href) {
                    window.location.href = this.href;
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const profileDropdown = document.querySelector('.profile-dropdown');
        const profileIcon = document.querySelector('.profile-icon2');

        // Toggle dropdown on profile icon click
        profileIcon.addEventListener('click', function(e) {
            profileDropdown.classList.toggle('active');
            e.stopPropagation();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileDropdown.contains(e.target)) {
                profileDropdown.classList.remove('active');
            }
        });
    });
</script>