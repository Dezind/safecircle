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

    // Redirect to the next page (e.g., customization5.php or a final page)
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
