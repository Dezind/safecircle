<?php
// Start the session to retrieve the previous answers
session_start();

// Check if the form is submitted, and save the answer to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $locationRadius = $_POST['location-radius'];

    // Store the selected location radius in the session
    $_SESSION['location-radius'] = $locationRadius;

    // Redirect to the next page (customization7.php)
    header("Location: customization7.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization</title>
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
            text-align: center;
        }

        .quiz-container {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px 30px;
            border-radius: 10px;
            width: 360px;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1),
                        0 0 20px rgba(255, 255, 255, 0.05);
        }

        .quiz-container form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .quiz-container h2 {
            font-size: 1rem;
            margin: 0 0 10px 0;
            text-align: left;
            color: white;
        }

        .slider-container {
            width: 100%;
        }

        input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            outline: none;
            border-radius: 4px;
            margin: 10px 0;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: white;
            cursor: pointer;
            border-radius: 50%;
        }

        input[type="range"]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: white;
            cursor: pointer;
            border-radius: 50%;
            border: none;
        }

        .value-display {
            color: white;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .button-container {
            display: flex;
            gap: 15px;
        }

        button {
            background-color: transparent;
            color: white;
            padding: 12px 20px;
            border: 1px solid white;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.3s ease;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        button:hover {
            border-color: white;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5),
                        0 0 30px rgba(255, 255, 255, 0.3),
                        0 0 40px rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
            background: rgba(255, 255, 255, 0.1);
            animation: glow 1.5s ease-in-out infinite;
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            }
            50% {
                box-shadow: 0 0 25px rgba(255, 255, 255, 0.5),
                            0 0 35px rgba(255, 255, 255, 0.3);
            }
            100% {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <form method="POST" action="customization5.php">
            <h2>What is your preferred location to attend (radius)?</h2>

            <!-- Slider for selecting location radius -->
            <div class="slider-container">
                <input type="range" name="location-radius" min="0" max="50" step="1" value="0" id="location-slider" required>
                <div class="value-display" id="slider-value">0 miles</div>
            </div>

            <div class="button-container">
                <button type="button" onclick="window.location.href='customization4.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to update the slider value display
        const slider = document.getElementById("location-slider");
        const valueDisplay = document.getElementById("slider-value");

        slider.addEventListener("input", function() {
            valueDisplay.textContent = `${slider.value} miles`;
        });
    </script>
</body>
</html>
