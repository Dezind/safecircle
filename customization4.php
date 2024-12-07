<?php
// Start the session to retrieve the previous answers
session_start();

// Check if the form is submitted, and save the answer to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transportationAmount = $_POST['transportation-amount'];
    $transportationType = $_POST['transportation-type'];

    // Store answers in the session
    $_SESSION['transportation-amount'] = $transportationAmount;
    $_SESSION['transportation-type'] = $transportationType;

    // Redirect to the next page (e.g., customization5.php)
    header("Location: customization5.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization 4</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
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
            backdrop-filter: blur(10px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1), 0 0 20px rgba(255, 255, 255, 0.05);
        }

        .quiz-container form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .quiz-container h2 {
            font-size: 1.2rem;
            margin: 0 0 10px 0;
            text-align: left;
            color: white;
        }

        label {
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            margin-bottom: 10px; /* Increased space between each label */
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

        input[type="range"] {
            width: 100%;
            margin: 10px 0;
        }

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
            font-size: 1rem;
            width: 48%;
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
        <form method="POST" action="customization4.php">
            <h2>How much are you willing to spend on transportation?</h2>

            <!-- Slider for selecting transportation amount -->
            <div class="slider-container">
                <input type="range" name="transportation-amount" min="0" max="1000" step="10" value="0" id="transportation-slider" required>
                <div class="value-display" id="slider-value">$0</div>
            </div>

            <!-- Transportation type options -->
            <h3>Select your transportation type:</h3>
            <label>
                <input type="radio" name="transportation-type" value="own" required>
                I have my own transportation
            </label>
            <label>
                <input type="radio" name="transportation-type" value="public" required>
                I take public transportation
            </label>
            <label>
                <input type="radio" name="transportation-type" value="uber" required>
                I take Uber/Lyft/taxi
            </label>

            <!-- Buttons to go back and next -->
            <div class="button-container">
                <button type="button" onclick="window.location.href='customization3.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to update the slider value display
        const slider = document.getElementById("transportation-slider");
        const valueDisplay = document.getElementById("slider-value");

        slider.addEventListener("input", function() {
            valueDisplay.textContent = `$${slider.value}`;
        });
    </script>
</body>
</html>
