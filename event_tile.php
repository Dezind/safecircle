
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Tile Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .event-tile {
            width: 300px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .event-image {
            width: 100%;
            height: 180px;
            background-size: cover;
            background-position: center;
        }
        .event-content {
            padding: 15px;
            background-color: #fff;
        }
        .event-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .event-details {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 8px;
        }
        .event-price {
            font-size: 1em;
            color: #333;
        }
    </style>
</head>
<body>
<div class="event-tile">
    <div class="event-image" style="background-image: url('images/arrow.png');"></div>
    <div class="event-content">
        <div class="event-title">Commerce Casino Presents: Mariachi Vargas, Mexican...</div>
        <div class="event-details">
            <div>Fri, Nov 22 • 6:00 PM</div>
            <div>The Commerce Casino & Hotel</div>
        </div>
    </div>
</body>
</html>
