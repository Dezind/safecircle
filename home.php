<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['user_id'];
$email = $_SESSION['email'];

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

$sql = "SELECT * FROM users WHERE user_id = '$id'";

$results = $mysql->query($sql);

if (!$results) {
    echo "Database query failed " . $mysql->error;
}

if ($results->num_rows > 0) {
    $row = $results->fetch_assoc();
    $fname = htmlspecialchars($row['fname']);
    $userid = $row['user_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password exist in the database
    $stmt = $mysql->prepare("SELECT * FROM users WHERE user_id = '$id'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        exit();
    } else {
        $error_message = "Somethings wrong";
    }

    $stmt->close();
    $mysql->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>SafeCircle - Connect, Discover, and Share</title>
</head>

<body  onload="hideLoadingScreen()">

<?php include "loadingscreen.php"; ?>

<?php include "cursor.php"; ?>

<div id="content" style="display:none;">
    <?php include "nav.php"; ?>
    <section class="hero">
        <br><br><br><br><br><br><br><br>

        <h1 class="tagline" id="greeting"></h1>

        <button onclick="window.location.href='searchresult.php'" class="rounded-button">Find an Event</button>
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
        <button onclick="alert('LOGIN PAGE')" class="rounded-button">Join SafeCircle</button>
    </section>

    <!-- (GONNA TRY TO FIX THIS - TONGFEI)
        <div class="hover-gallery">
            <img src="images/banners/banner.png" alt="placeholder">
            <img src="images/banners/banner.png" alt="placeholder">
            <img src="images/banners/banner.png" alt="placeholder">
            <img src="images/banners/banner.png" alt="placeholder">
        </div>
    -->
    <script>
        function getGreeting() {
            const currentHour = new Date().getHours();
            let greeting;
            let user = "<?php echo $row['fname'] ?>";

            if (currentHour >= 5 && currentHour < 12) {
                greeting = "Good Morning, ";
            } else if (currentHour >= 12 && currentHour < 17) {
                greeting = "Good Afternoon, ";
            } else {
                greeting = "Good Evening, ";
            }

            let usergreeting = greeting + user;

            document.getElementById("greeting").innerHTML = usergreeting;
        }

        getGreeting();
    </script>
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
        <br>
        <button onclick="window.location.href='signuppage.php'" class="rounded-button" >Join Now</button>
    </section>

    <?php include "globe.php"; ?>

    <?php include "footer.php"; ?>
</div>

</body>
</html>

