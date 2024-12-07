<?php
// Start the session to retrieve the previous answers
session_start();

// Check if the form is submitted, and save the answer to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventTiming = $_POST['event-timing'];
    $otherTiming = $_POST['other-timing'] ?? ''; // Handle "Other" option

    // Store the selected timing in the session
    $_SESSION['event-timing'] = $eventTiming;
    $_SESSION['other-timing'] = $otherTiming;

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
    <title>Customization 6</title>
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
            margin: 0;
            text-align: left;
        }

        input[type="radio"] {
            margin: 0;
            transform: scale(1.2);
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #222;
            color: white;
            font-size: 1em;
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

        #other-timing {
            display: none;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <form method="POST" action="customization6.php">
            <h2>When do you plan on attending the events?</h2>

            <!-- Answer options for event timing -->
            <label>
                <input type="radio" name="event-timing" value="next-week" required>
                Next week
            </label>
            <label>
                <input type="radio" name="event-timing" value="next-month" required>
                Next month
            </label>
            <label>
                <input type="radio" name="event-timing" value="next-year" required>
                Next year
            </label>
            <label>
                <input type="radio" name="event-timing" value="other" id="other-option" required>
                Other
            </label>

            <!-- Text input for the "Other" option -->
            <div id="other-timing">
                <label for="other-timing-input">Please specify:</label>
                <input type="text" id="other-timing-input" name="other-timing" placeholder="Enter your time frame">
            </div>

            <!-- Buttons to go back and next -->
            <div class="button-container">
                <button type="button" onclick="window.location.href='customization5.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to show/hide the "Other" text input field
        const otherOption = document.getElementById("other-option");
        const otherTimingInput = document.getElementById("other-timing");

        otherOption.addEventListener("change", function() {
            if (this.checked) {
                otherTimingInput.style.display = "block"; // Show input if "Other" is selected
            } else {
                otherTimingInput.style.display = "none"; // Hide input if not selected
            }
        });
    </script>
</body>
</html>
