
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booked Tickets</title>
    <style>

        .container {
            max-width: 1200px;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons {
            text-align: right;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 5px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #3498db;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #2980b9;
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
        <h1>Booked Tickets</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Movie Name</th>
                    <th>Date</th>
                    <th>Show Time</th>
                    <th>Screen</th>
                    <th>Price Paid</th>
                    <th>Seats Selected</th>
                    <th>Customer Name</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings)): ?>
                    <?php foreach ($bookings as $index => $book): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $book->movie_name; ?></td>
                            <td><?php echo $book->booking_date; ?></td>
                            <td><?php echo $book->time_slot; ?></td>
                            <td><?php echo $book->screen_number; ?></td>
                            <td><?php echo $book->price; ?></td>
                            <td><?php echo $book->selected_seats; ?></td>
                            <td><?php echo $book->customer_name; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No movies found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

