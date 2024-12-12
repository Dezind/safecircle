<?php
// Start the session to retrieve the answers
session_start();

// Check if the form is submitted, and save the answer to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $groupChoice = $_POST['group-choice'];
    $_SESSION['group-choice'] = $groupChoice;

    // Redirect to the next page (customization4.php)
    header("Location: customization4.php");
    exit;
}
?>

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
    <title>Customization 3</title>
    <!-- Same font as in customization1.php and customization2.php -->
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
            background-color: black;
            color: white;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif; /* Ensuring the same font as in customization1.php and customization2.php */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .quiz-container {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 50px 40px; /* Increased padding for more spacing */
            border-radius: 10px;
            width: 360px;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1),
                        0 0 20px rgba(255, 255, 255, 0.05);
        }

        .quiz-container h2 {
            font-size: 1.2rem;
            margin: 0 0 20px 0; /* Increased bottom margin for better spacing */
            text-align: left;
            color: white;
        }

        label {
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 15px; /* Increased space between radio and label */
            cursor: pointer;
            margin-bottom: 20px; /* Increased margin for better spacing between options */
        }

        input[type="radio"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 1px solid white;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
        }

        input[type="radio"]:checked::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 12px;
            height: 12px;
            background-color: white;
            border-radius: 50%;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px; /* Increased top margin for more space between form and buttons */
        }

        .button-container button {
            background-color: transparent;
            color: white;
            padding: 14px 24px; /* Increased button padding */
            border: 1px solid white;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 48%; /* Ensure buttons are side by side with space between */
        }

        .button-container button:hover {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5),
                        0 0 30px rgba(255, 255, 255, 0.3);
            transform: scale(1.02);
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <form method="POST" action="customization3.php">
            <h2>Do you have a group of friends that you would like to join?</h2>
            
            <label>
                <input type="radio" name="group-choice" value="Find individual friends" 
                    <?php echo isset($_SESSION['group-choice']) && $_SESSION['group-choice'] === 'Find individual friends' ? 'checked' : ''; ?> 
                    required>
                Option 1: Find individual friends
            </label>
            <label>
                <input type="radio" name="group-choice" value="Create a friend group" 
                    <?php echo isset($_SESSION['group-choice']) && $_SESSION['group-choice'] === 'Create a friend group' ? 'checked' : ''; ?>>
                Option 2: Create a friend group
            </label>
            <label>
                <input type="radio" name="group-choice" value="Join a new friend group" 
                    <?php echo isset($_SESSION['group-choice']) && $_SESSION['group-choice'] === 'Join a new friend group' ? 'checked' : ''; ?>>
                Option 3: Join a new friend group
            </label>

            <!-- Buttons to go back and next -->
            <div class="button-container">
                <button type="button" onclick="window.location.href='customization2.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
</body>
</html>
