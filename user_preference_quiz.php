<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: emailcheckpage.php");
    exit();
}

$host = "webdev.iyaserver.com";
$userid = "<youruserid>";
$userpw = "<yourpw>";
$db = "<database name>";

include 'loginvariables.php';

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if ($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

// Fetch existing user preferences
$user_id = $_SESSION['user_id'];
$user_preferences = [];
$user_pref_sql = "SELECT event_type_id FROM user_preference WHERE user_id = ?";
$stmt = $mysql->prepare($user_pref_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $user_preferences[] = $row['event_type_id'];
}
$stmt->close();

// Fetch all event types
$sql = "SELECT * FROM event_types";
$results = $mysql->query($sql);

if (!$results) {
    echo "SQL error: " . $mysql->error . " running query <hr>" . $sql . "<hr>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submitted_interests = isset($_POST['interest']) ? $_POST['interest'] : [];

    // Find interests to add
    $new_interests = array_diff($submitted_interests, $user_preferences);

    foreach ($new_interests as $new_interest) {
        $stmt = $mysql->prepare("INSERT INTO user_preference (user_id, event_type_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $new_interest);

        if (!$stmt->execute()) {
            echo "Error inserting interest: " . $mysql->error;
        }

        $stmt->close();
    }

    // Find interests to remove
    $removed_interests = array_diff($user_preferences, $submitted_interests);

    foreach ($removed_interests as $removed_interest) {
        $stmt = $mysql->prepare("DELETE FROM user_preference WHERE user_id = ? AND event_type_id = ?");
        $stmt->bind_param("ii", $user_id, $removed_interest);

        if (!$stmt->execute()) {
            echo "Error deleting interest: " . $mysql->error;
        }

        $stmt->close();
    }

    echo "Preferences updated successfully!";
    echo "<a href='homepage.php'>Back to home page</a>";
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
    <form id="interests-form" action="" method="POST">
        <h2>Select Your Interests</h2>
        <div class="custom-select">
            <div>
                <?php
                while ($interest = $results->fetch_assoc()) {
                    $checked = in_array($interest['event_type_id'], $user_preferences) ? "checked" : "";
                    echo "<label> 
           <input type='checkbox' name='interest[]' value='" . $interest['event_type_id'] . "' $checked>" . $interest['event_type'] . "
          </label>";
                }
                ?>

            </div>
        </div>

        <div class="button-container">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

</body>
</html>
