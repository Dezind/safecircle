<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>HOME PAGE - (purely placeholders)</title>
    <style>
        .containerx {
            max-width: 1200px;
            margin: 0 auto;
        }

        .headerx {
            margin-bottom: 3rem;
        }

        .headerx h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .headerx p {
            color: #888;
        }

        .filtersx {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .filter-btn {
            background: transparent;
            color: #fff;
            border: 1px solid #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            background: #fff;
            color: #000;
        }

        .share-btn {
            background: #fff;
            color: #000;
            border: none;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #111;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            margin-top: 5px;
        }

        .dropdown-content a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #222;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .gallery-card {
            background: #111;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
        }

        .gallery-image {
            width: 100%;
            height: 380px;
            object-fit: cover;
        }

        .gallery-details {
            padding: 1.5rem;
        }

        .gallery-caption {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .gallery-description {
            color: #888;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
        }

        .share-btn, .download-btn {
            background: #fff;
            color: #000;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .share-btn:hover, .download-btn:hover {
            background: #ddd;
        }

        .show {
            display: block;
        }

        .hptitle {
            text-align: left;
            font-size: 2rem;
            font-weight: bold;
            margin-top: 20px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .welcometext {
            font-size: 3.5rem;
            font-weight: bold;
            text-align: center;
            margin-top: 350px;
            margin-bottom: 130px;
        }

        /*------------------- friend photos ------------------*/
        .friends {
            clear: both;
            padding-top: 2rem;
            width: 100%;
            display: flex;
            justify-content: left;
            gap: 20px;
        }

        div.gallery1 {
            margin: 5px;
            width: 150px;
            text-align: center;
            float: none;
            border: none;
        }

        div.gallery1 .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            transition: transform 0.3s ease
        }
        div.gallery1 .profile-image:hover {
            transform: translateY(-5px);
        }

        div.gallery1 .online-indicator {
            width: 12px;
            height: 12px;
            background-color: #2ecc71;
            border-radius: 50%;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        div.gallery1 .profile-container {
            position: relative;
            display: inline-block;
        }

        div.desc {
            padding: 5px;
            text-align: center;
            font-size: 1.1rem;
            color: #fff;
            border: none;
        }

        /*----------------------your safecircle panels----------------------------*/
        .event-gallery1 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .event-card1 {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 1;
            transition: transform 0.3s ease
        }
        .event-card1:hover {
            transform: translateY(-5px);
        }

        .event-image1 {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .event-title-wrapper1 {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        }

        .event-title1 {
            color: white;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .comment-icon1 {
            width: 24px;
            height: 24px;
            opacity: 0.9;
        }

        #jumptopoint {

        }


    </style>
</head>


<body onload="hideLoadingScreen()">
<?php include "header2.php"; ?>
<?php include "globe.php"; ?>
<?php include "cursor.php"; ?>


<?php include "loadingscreen.php"; ?>

<div class="containerx">
    <div class="welcometext">Welcome to your SafeCircle, Amy!

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

        <div class="gallery1">
            <div class="profile-container">
                <img src="images/homepagephotos/friend1.png" alt="Friend 1" class="profile-image">
                <div class="online-indicator"></div>
            </div>
            <div class="desc">Amy Pan</div>
        </div>

        <div class="gallery1">
            <div class="profile-container">
                <img src="images/homepagephotos/friend2.png" alt="Friend 2" class="profile-image">
                <div class="online-indicator"></div>
            </div>
            <div class="desc">Amy Pan</div>
        </div>

        <div class="gallery1">
            <div class="profile-container">
                <img src="images/homepagephotos/friend3.png" alt="Friend 3" class="profile-image">
                <div class="online-indicator"></div>
            </div>
            <div class="desc">Amy Pan</div>
        </div>

        <div class="gallery1">
            <div class="profile-container">
                <img src="images/homepagephotos/friend4.png" alt="Friend 4" class="profile-image">
                <div class="online-indicator"></div>
            </div>
            <div class="desc">Amy Pan</div>
        </div>

        <div class="gallery1">
            <div class="profile-container">
                <img src="images/homepagephotos/friend5.png" alt="Friend 5" class="profile-image">
                <!--
                <div class="online-indicator"></div>
                --->
            </div>
            <div class="desc">Amy Pan</div>
        </div>

        <div class="gallery1">
            <div class="profile-container">
                <img src="images/homepagephotos/friend6.png" alt="Friend 6" class="profile-image">
                <!--x
                <div class="online-indicator"></div>
                -->
            </div>
            <div class="desc">Amy Pan</div>
        </div>

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



<footer>
    <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
</footer>

</body>
</html>