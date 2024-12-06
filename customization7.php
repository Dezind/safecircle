<?php
// Start the session to retrieve the previous answers
session_start();

// Check if the form is submitted, and save the answer to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect all the interests entered by the user
    $interests = $_POST['interests'];

    // Store the user's interests in the session
    $_SESSION['interests'] = $interests;

    // Redirect to the next page or complete the process (for now it just finishes the form)
    header("Location: thank_you.php");  // You can replace this with the next page or a thank you page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization 7</title>
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

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #222;
            color: white;
            font-size: 1em;
            margin-top: 10px;
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

        .interest-inputs {
            margin-top: 10px;
        }

        .interest-inputs input {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <form method="POST" action="customization7.php" id="interests-form">
            <h2>What are your interests?</h2>

            <!-- Container to hold multiple interest inputs -->
            <div id="interest-inputs-container">
                <div class="interest-inputs">
                    <label for="interests-input">Please enter your interests:</label>
                    <input type="text" name="interests[]" placeholder="Enter an interest" onblur="addInterestInput(this)">
                </div>
            </div>

            <!-- Button to go back to customization6.php -->
            <div class="button-container">
                <button type="button" onclick="window.location.href='customization6.php'">Back</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function addInterestInput(currentInput) {
            // Check if the current input is not empty and if it's the last input
            if (currentInput.value.trim() !== "" && !currentInput.nextElementSibling) {
                // Create a new input field for the next interest
                const newInputDiv = document.createElement("div");
                newInputDiv.classList.add("interest-inputs");

                const newInput = document.createElement("input");
                newInput.type = "text";
                newInput.name = "interests[]";
                newInput.placeholder = "Enter another interest";
                newInput.setAttribute("onblur", "addInterestInput(this)");

                newInputDiv.appendChild(newInput);
                document.getElementById("interest-inputs-container").appendChild(newInputDiv);

                // Scroll to the newly created input field
                newInput.scrollIntoView({ behavior: "smooth" });
            }
        }
    </script>
</body>
</html>
