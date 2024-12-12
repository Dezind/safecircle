<?php
// Start the session to store the answers
session_start();

// Check if the form is submitted, and save the answers to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $genderPreference = $_POST['gender-preference'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

    // Store answers in the session
    $_SESSION['gender-preference'] = $genderPreference;
    $_SESSION['gender'] = $gender;

    // Redirect to the next page (customization3.php)
    header("Location: customization3.php");
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
    <title>Customization 2</title>
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
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #000000;
            color: white;
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
            margin: 0 0 20px 0; /* Increased bottom margin */
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

        #gender-options {
            margin-left: 30px; /* Indent to visually associate with "Yes" */
            margin-top: 20px; /* Increased margin to separate from the "Yes" option */
            display: none; /* Initially hidden */
            flex-direction: column;
            gap: 15px; /* Increased gap between gender options */
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px; /* Increased top margin for better spacing */
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
        <form method="POST" action="customization2.php">
            <h2>Do you have a gender preference?</h2>
            
            <label>
                <input type="radio" name="gender-preference" value="yes" 
                    <?php echo isset($_SESSION['gender-preference']) && $_SESSION['gender-preference'] === 'yes' ? 'checked' : ''; ?> 
                    required>
                Yes
            </label>
            <div id="gender-options" style="display: <?php echo isset($_SESSION['gender-preference']) && $_SESSION['gender-preference'] === 'yes' ? 'flex' : 'none'; ?>;">
                <label>
                    <input type="radio" name="gender" value="male" 
                        <?php echo isset($_SESSION['gender']) && $_SESSION['gender'] === 'male' ? 'checked' : ''; ?>>
                    Male
                </label>
                <label>
                    <input type="radio" name="gender" value="female" 
                        <?php echo isset($_SESSION['gender']) && $_SESSION['gender'] === 'female' ? 'checked' : ''; ?>>
                    Female
                </label>
                <label>
                    <input type="radio" name="gender" value="other" 
                        <?php echo isset($_SESSION['gender']) && $_SESSION['gender'] === 'other' ? 'checked' : ''; ?>>
                    Other
                </label>
            </div>

            <label>
                <input type="radio" name="gender-preference" value="no" 
                    <?php echo isset($_SESSION['gender-preference']) && $_SESSION['gender-preference'] === 'no' ? 'checked' : ''; ?> 
                    required>
                No
            </label>

            <div class="button-container">
                <button type="button" onclick="window.location.href='customization1.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>

    <script>
        // Show/hide gender options based on preference
        document.querySelectorAll('input[name="gender-preference"]').forEach(input => {
            input.addEventListener('change', function() {
                const genderOptions = document.getElementById('gender-options');
                genderOptions.style.display = this.value === 'yes' ? 'flex' : 'none';
            });
        });
    </script>
</body>
</html>
