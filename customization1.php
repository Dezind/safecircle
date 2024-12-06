<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization 1</title>
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

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #222;
            color: white;
            font-size: 1em;
            box-sizing: border-box;
        }

        button {
            background-color: white;
            color: black;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #555;
            color: white;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <form id="quiz-form" action="customization2.php" method="GET">
            <h2>Are you interested in finding friends at USC?</h2>
            <label>
                <input type="radio" name="usc-friends" value="yes" onclick="saveAnswer('usc-friends', 'yes')">
                Yes
            </label>
            <label>
                <input type="radio" name="usc-friends" value="no" onclick="saveAnswer('usc-friends', 'no')">
                No
            </label>

            <h2>Are you interested in finding friends in your major?</h2>
            <input type="text" id="major" name="major" placeholder="Your Major" oninput="saveAnswer('major', this.value)">

            <button type="submit">Next</button>
        </form>
    </div>

    <script>
        // Load stored values on page load
        document.addEventListener('DOMContentLoaded', function() {
            const uscFriends = localStorage.getItem('usc-friends');
            const major = localStorage.getItem('major');

            if (uscFriends) {
                document.querySelector(`input[name="usc-friends"][value="${uscFriends}"]`).checked = true;
            }
            if (major) {
                document.getElementById('major').value = major;
            }
        });

        // Save answer to localStorage
        function saveAnswer(key, value) {
            localStorage.setItem(key, value);
        }
    </script>
</body>
</html>

