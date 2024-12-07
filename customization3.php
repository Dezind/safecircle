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
    </style>
</head>
<body>
    <div class="quiz-container">
        <!-- Form for the question on customization3.php -->
        <form method="POST" action="customization3.php">
            <h2>Do you have a group of friends that you would like to join?</h2>
            
            <label>
                <input type="radio" name="group-choice" value="Find individual friends" required>
                Option 1: Find individual friends
            </label>
            <label>
                <input type="radio" name="group-choice" value="Create a friend group" required>
                Option 2: Create a friend group
            </label>
            <label>
                <input type="radio" name="group-choice" value="Join a new friend group" required>
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
