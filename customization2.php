<?php
// Start the session to store the answers
session_start();

// Check if the form is submitted, and save the answer to the session
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
        <!-- Form that posts to customization2.php -->
        <form method="POST" action="customization2.php">
            <h2>Do you have a gender preference?</h2>
            
            <label>
                <input type="radio" name="gender-preference" value="yes" required>
                Yes
            </label>
            <label>
                <input type="radio" name="gender-preference" value="no" required>
                No
            </label>

            <!-- Gender options to show if 'Yes' is clicked -->
            <div id="gender-options" style="display: none;">
                <label>
                    <input type="radio" name="gender" value="male">
                    Male
                </label>
                <label>
                    <input type="radio" name="gender" value="female">
                    Female
                </label>
                <label>
                    <input type="radio" name="gender" value="other">
                    Other
                </label>
            </div>

            <!-- Buttons to go back and next -->
            <div class="button-container">
                <button type="button" onclick="window.history.back()">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>

    <script>
        // Show gender options if "Yes" is selected
        document.querySelectorAll('input[name="gender-preference"]').forEach((input) => {
            input.addEventListener('change', function() {
                const genderOptions = document.getElementById('gender-options');
                if (this.value === 'yes') {
                    genderOptions.style.display = 'block';
                } else {
                    genderOptions.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>

