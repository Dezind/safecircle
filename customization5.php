<?php
// Start the session to retrieve the previous answers
session_start();

// Check if the form is submitted, and save the answer to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $locationRadius = $_POST['location-radius'];

    // Store the selected location radius in the session
    $_SESSION['location-radius'] = $locationRadius;

    // Redirect to the next page (customization6.php)
    header("Location: customization6.php");
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
    <title>Customization 5</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .quiz-container {
            background-color: #333;
            padding: 40px 30px;
            border-radius: 10px;
            width: 360px;
            box-sizing: border-box;
        }

        .quiz-container form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .quiz-container h2 {
            font-size: 1em;
            margin: 0 0 10px 0;
            text-align: left;
        }

        label {
            font-size: 1em;
            margin: 0;
            text-align: left;
        }

        input[type="range"] {
            width: 100%;
            margin: 10px 0;
        }

        input[type="radio"] {
            margin: 0;
            transform: scale(1.2);
        }

        /* Style for the buttons container */
        .button-container {
            display: flex;
            justify-content: space-between;
        }

        button {
            background-color: white;
            color: black;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            width: 48%; /* Ensures buttons are side by side */
        }

        button:hover {
            background-color: #555;
            color: white;
        }

        .slider-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .value-display {
            margin-top: 10px;
            font-size: 1.2em;
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

            <!-- Buttons to go back and next -->
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
