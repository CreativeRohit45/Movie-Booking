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

        /* Dropdown styles */
        .textbox-with-dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .textbox-with-dropdown input[type="text"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; /* Adjust for arrow width */
            box-sizing: border-box;
        }

        .textbox-with-dropdown .arrow {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .textbox-with-dropdown .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        .textbox-with-dropdown .dropdown-content.show {
            display: block;
        }

        .textbox-with-dropdown .dropdown-content option {
            padding: 10px;
            cursor: pointer;
        }

        .textbox-with-dropdown .dropdown-content option.selected {
            background-color: #007bff;
            color: #fff;
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
                <select id="screen_number" name="screen_number" required>
                    <option value="1" <?php echo ($movie->screen_number == 1) ? 'selected' : ''; ?>>Screen 1</option>
                    <option value="2" <?php echo ($movie->screen_number == 2) ? 'selected' : ''; ?>>Screen 2</option>
                </select>
            </div>

            <div>
                <label for="movie_time">Movie Time</label>
                <div class="textbox-with-dropdown">
                    <input type="text" id="selected_times" name="selected_times" readonly onclick="toggleDropdown()" value="<?php echo implode(', ', json_decode($movie->time)); ?>">
                    <span class="arrow">&#9660;</span>
                    <div class="dropdown-content" id="dropdownContent">
                        <option value="10 AM - 1 PM">10 AM - 1 PM</option>
                        <option value="2 PM - 5 PM">2 PM - 5 PM</option>
                        <option value="6 PM - 9 PM">6 PM - 9 PM</option>
                    </div>
                </div>
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

    <script>
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('dropdownContent');
            var selectedTimes = document.getElementById('selected_times');
            var arrow = document.querySelector('.arrow');
            
            if (event.target !== selectedTimes && event.target !== arrow) {
                dropdown.classList.remove('show');
            }
        });

        function toggleDropdown() {
            var dropdownContent = document.getElementById('dropdownContent');
            dropdownContent.classList.toggle('show');
        }

        function selectOption(option) {
            var selectedTimes = document.getElementById('selected_times');
            var currentValue = selectedTimes.value;
            var newValue = option.value;
            var timesArray = currentValue.split(', ').filter(time => time !== "");

            if (timesArray.includes(newValue)) {
                timesArray = timesArray.filter(time => time !== newValue);
            } else {
                timesArray.push(newValue);
            }

            selectedTimes.value = timesArray.join(', ');
            toggleDropdown();
        }

        document.querySelectorAll('.dropdown-content option').forEach(option => {
            option.addEventListener('click', function() {
                selectOption(option);
            });
        });
    </script>
</body>
</html>
