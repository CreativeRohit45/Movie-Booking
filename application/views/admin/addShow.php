<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Movie</title>
    <style>

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 14px;
        }

        input, select {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Movie</h1>
        <form action="<?php echo base_url('addMovie')?>" method="post" enctype="multipart/form-data">
            <label for="movie_photo">Movie Photo:</label>
            <input type="file" id="movie_photo" name="movie_photo" accept="image/*" required>

            <label for="movie_name">Movie Name:</label>
            <input type="text" id="movie_name" name="movie_name" required>

            <label for="movie_genre">Movie Genre:</label>
            <input type="text" id="movie_genre" name="movie_genre" required>

            <label for="screen_number">Screen Number:</label>
            <select id="screen_number" name="screen_number" required>
                <option value="1">Screen 1</option>
                <option value="2">Screen 2</option>
            </select>

           <label for="movie_time">Movie Timing:</label>
            <select id="movie_time" name="movie_time[]" required multiple>
                <option value="10 AM - 1 PM">10:00 AM - 1:00 PM</option>
                <option value="2 PM - 5 PM">2:00 PM - 5:00 PM</option>
                <option value="6 PM - 9 PM">6:00 PM - 9:00 PM</option>
            </select>


            <label for="seat_price">Price per Seat:</label>
            <input type="number" id="seat_price" name="seat_price" min="0" step="0.01" required>

            <label for="movie_date">Movie Date:</label>
            <input type="date" id="movie_date" name="movie_date" required>

            <button type="submit">Add Movie</button>
        </form>
    </div>
</body>
</html>
