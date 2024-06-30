<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <style>
        .container {
            max-width: 600px;
            margin: 10px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        small {
            color: #6c757d;
            display: block;
            margin-top: -8px;
            margin-bottom: 10px;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
        }

        button, .btn-secondary {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        button {
            background-color: #007bff;
            color: #fff;
        }

        button:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #e74c3c;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Movie</h2>
        <form action="<?php echo base_url('admin/updateMovie/' . $movie->id); ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="movie_name">Movie Name</label>
                <input type="text" id="movie_name" name="movie_name" value="<?php echo set_value('movie_name', $movie->name); ?>" required>
            </div>
            <div>
                <label for="movie_genre">Movie Genre</label>
                <input type="text" id="movie_genre" name="movie_genre" value="<?php echo set_value('movie_genre', $movie->genre); ?>" required>
            </div>
            <div>
                <label for="screen_number">Screen Number</label>
                <input type="number" id="screen_number" name="screen_number" value="<?php echo set_value('screen_number', $movie->screen_number); ?>" required>
            </div>
            <div>
                <label for="movie_time">Movie Time</label>
                <select id="movie_time" name="movie_time[]" required>
                    <?php foreach ($selected_times as $time): ?>
                        <option value="<?php echo $time['time']; ?>" <?php echo ($time['time'] == $movie->time) ? 'selected' : ''; ?>>
                            <?php echo $time['time']; ?>
                        </option>
                    <?php endforeach; ?>
                    <option value="10 AM - 1 PM" <?php echo (in_array('10 AM - 1 PM', $time['time'])) ? 'selected' : ''; ?>>10 AM - 1 PM</option>
                    <option value="2 PM - 5 PM" <?php echo (in_array('2 PM - 5 PM', $time['time'])) ? 'selected' : ''; ?>>2 PM - 5 PM</option>
                    <option value="6 PM - 9 PM" <?php echo (in_array('6 PM - 9 PM', $time['time'])) ? 'selected' : ''; ?>>6 PM - 9 PM</option>
                </select>
            </div>


            <div>
                <label for="seat_price">Seat Price</label>
                <input type="text" id="seat_price" name="seat_price" value="<?php echo set_value('seat_price', $movie->price); ?>" required>
            </div>
            <div>
                <label for="movie_date">Movie Date</label>
                <input type="date" id="movie_date" name="movie_date" value="<?php echo set_value('movie_date', $movie->date); ?>" required>
            </div>
            <div>
                <label for="movie_photo">Movie Photo</label>
                <input type="file" id="movie_photo" name="movie_photo">
                <small>Upload a new photo if you want to replace the existing one.</small>
            </div>
            <div class="form-buttons">
                <button type="submit">Update Movie</button>
                <a href="<?php echo base_url('adminView'); ?>" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
