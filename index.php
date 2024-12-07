
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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>SafeCircle - Connect, Discover, and Share</title>
</head>

<body  onload="hideLoadingScreen()">

<?php include "loadingscreen.php"; ?>

<?php include "globe.php"; ?>

<?php include "cursor.php"; ?>

<div id="content" style="display:none;">
<?php include "header.php"; ?>

    <section class="hero">
        <br><br><br><br><br><br><br><br>

        <h1 class="tagline">Discover New Friends and Events – <br>
            Find Your Safe Circle for Every Adventure</h1>
        <button onclick="window.location.href='emailcheckpage.php'" class="rounded-button">Join Now</button>
        <br>
        <!--DOWN ARROW SCROLL BUTTON TEST-->
        <img class="arrow" src="images/arrow.png" alt="pic of arrow" onClick="document.getElementById('concerts').scrollIntoView({ behavior: 'smooth' });" />

        <br><br><br>
    </section>

    <section class="section" id="concerts">

        <h3>DISCOVER EVENTS</h3><br>
        <button onclick="window.location.href='searchresult.php'" class="rounded-button">Find Events</button>
    </section>

    <div class="hover-gallery">
        <img src="images/galleryphotos/party1.gif" alt="placeholder">
        <img src="images/galleryphotos/party2.gif" alt="placeholder">
        <img src="images/galleryphotos/party3.gif" alt="placeholder">
        <img src="images/galleryphotos/party4.gif" alt="placeholder">
    </div>

    <section class="section" id="friends">
        <h3>MEET FRIENDS</h3><br>
        <button onclick="alert('FIND FRIENDS (COMING SOON)')" class="rounded-button">Find Friends</button>
    </section>

<!-- (GONNA TRY TO FIX THIS - TONGFEI)
    <div class="hover-gallery">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
    </div>
-->
    <section class="section" id="events">
        <h3>MAKE MEMORIES</h3><br>
        <button onclick="window.location.href='signuppage.php'">Join SafeCircle</button>
    </section>

<!-- (GONNA TRY TO FIX THIS - TONGFEI)
    <div class="hover-gallery">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
    </div>
-->

<!--------------------HOVER GALLERY CODE---------------------->
    <script>
        const heading = document.querySelector('h3');
        const gallery = document.querySelector('.hover-gallery');

        heading.addEventListener('mouseenter', () => {
            gallery.classList.add('visible');
        });

        heading.addEventListener('mouseleave', () => {
            gallery.classList.remove('visible');
        });

        document.addEventListener('mousemove', (e) => {
            const offset = -250; // Distance from cursor
            gallery.style.left = `${e.clientX + offset}px`;
            gallery.style.top = `${e.clientY + offset}px`;
        });
    </script>


    <script>
        const heading2 = document.querySelector('#friends');
        const gallery2 = document.querySelector('.hover-gallery');

        heading2.addEventListener('mouseenter', () => {
            gallery2.classList.add('visible');
        });

        heading2.addEventListener('mouseleave', () => {
            gallery2.classList.remove('visible');
        });

        document.addEventListener('mousemove', (e) => {
            const offset = -250; // Distance from cursor
            gallery2.style.left = `${e.clientX + offset}px`;
            gallery2.style.top = `${e.clientY + offset}px`;
        });
    </script>

    <script>
        const heading3 = document.querySelector('#events');
        const gallery3 = document.querySelector('.hover-gallery');

        heading3.addEventListener('mouseenter', () => {
            gallery2.classList.add('visible');
        });

        heading3.addEventListener('mouseleave', () => {
            gallery2.classList.remove('visible');
        });

        document.addEventListener('mousemove', (e) => {
            const offset = -250; // Distance from cursor
            gallery3.style.left = `${e.clientX + offset}px`;
            gallery3.style.top = `${e.clientY + offset}px`;
        });
    </script>
<!--------------------HOVER GALLERY CODE---------------------->

    <section class="section" id="join">
        <h2>FIND YOUR SAFECIRCLE</h2>
        <br><br>
        <button onclick="window.location.href='signuppage.php'" class="rounded-button" >Join Now</button>
    </section>

<?php include "footer.php"; ?>
</div>

</body>
</html>

