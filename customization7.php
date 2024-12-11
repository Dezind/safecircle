<?php
// Start the session to retrieve the previous answers
session_start();

// Check if the form is submitted, and save the answer to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect all the interests selected by the user
    $interests = $_POST['interests'] ?? [];

    // Store the user's interests in the session
    $_SESSION['interests'] = $interests;

    // Redirect to the next page or complete the process
    header("Location: thank_you.php");  // You can replace this with the next page or a thank you page
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
    <title>Customization 7</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
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

        .custom-select {
            width: 100%;
            position: relative;
        }

        .custom-select-input {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            background-color: transparent;
            color: white;
            font-size: 1rem;
            box-sizing: border-box;
            cursor: pointer;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            text-align: left;
        }

        .custom-select-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
            background-color: #000000;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-top: none;
            z-index: 10;
        }

        .custom-select-dropdown label {
            display: block;
            padding: 10px;
            cursor: pointer;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            text-align: left;
        }

        .custom-select-dropdown label:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .custom-select-dropdown label input {
            margin-right: 10px;
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

        .button-container {
            display: flex;
            gap: 15px;
        }

        .button-container button {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <form id="interests-form" action="customization7.php" method="POST">
            <h2>Select Your Interests</h2>
            <div class="custom-select">
                <input type="text" class="custom-select-input" placeholder="Select Interests" readonly>
                <div class="custom-select-dropdown">
                    <label>
                        <input type="checkbox" name="interests[]" value="Music"> Music
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Sports"> Sports
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Technology"> Technology
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Art"> Art
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Health & Wellness"> Health & Wellness
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Gaming"> Gaming
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Food"> Food
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Travel"> Travel
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Fitness"> Fitness
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Photography"> Photography
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Networking"> Networking
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Community Service"> Community Service
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Workshops"> Workshops
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Startups"> Startups
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Nature"> Nature
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Film"> Film
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Dance"> Dance
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Literature"> Literature
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Cultural Events"> Cultural Events
                    </label>
                    <label>
                        <input type="checkbox" name="interests[]" value="Science & Innovation"> Science & Innovation
                    </label>
                </div>
            </div>

            <div class="button-container">
                <button type="button" onclick="window.location.href='customization5.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>

    <script>
        // asked outside help
        const customSelect = document.querySelector('.custom-select');
        const customSelectInput = customSelect.querySelector('.custom-select-input');
        const customSelectDropdown = customSelect.querySelector('.custom-select-dropdown');
        const checkboxes = customSelectDropdown.querySelectorAll('input[type="checkbox"]');

        // asked outside help
        customSelectInput.addEventListener('click', () => {
            customSelectDropdown.style.display = 
                customSelectDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // asked outside help
        function updateSelectedInterests() {
            const selectedInterests = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            customSelectInput.value = selectedInterests.length > 0 
                ? selectedInterests.join(', ') 
                : 'Select Interests';
        }

        // asked outside help
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedInterests);
        });

        // asked outside help
        document.addEventListener('click', (event) => {
            if (!customSelect.contains(event.target)) {
                customSelectDropdown.style.display = 'none';
            }
        });

        // asked outside helpd
        document.getElementById('interests-form').addEventListener('submit', (event) => {
            const selectedInterests = Array.from(checkboxes).filter(cb => cb.checked);
            if (selectedInterests.length === 0) {
                event.preventDefault();
                alert('Please select at least one interest');
            }
        });
    </script>
</body>
</html>
