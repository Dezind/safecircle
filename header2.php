<style>
    .navbar2 {
        background-color: black;
        padding: 30px 40px; /* Increased padding for thicker header */
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
        width: 120px; /* Fixed width for left section */
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

    .profile-icon2 {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #444;
    }
</style>

<nav class="navbar2">
    <div class="nav-left2">
        <!-- Dark/Light mode toggle -->
        <svg class="nav-icon2" viewBox="0 0 24 24" fill="white">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13v6l5.2 3.2.8-1.3-4.5-2.7V7z"/>
        </svg>

        <!-- Calendar icon -->
        <svg class="nav-icon2" viewBox="0 0 24 24" fill="white">
            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
        </svg>

        <!-- Group icon -->
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

        <div class="profile-icon2"></div>
    </div>
</nav>