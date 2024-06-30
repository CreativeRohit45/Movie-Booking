
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Running Shows</title>
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
        <h1>Running Shows</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Movie Name</th>
                    <th>Date</th>
                    <th>Show Time</th>
                    <th>Screen</th>
                    <th>Price</th>
                    <th>Seats Left</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($movies)): ?>
                    <?php foreach ($movies as $index => $movie): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $movie->name; ?></td>
                            <td><?php echo $movie->date; ?></td>
                            <td><?php echo $movie->time; ?></td>
                            <td><?php echo $movie->screen_number; ?></td>
                            <td><?php echo $movie->price; ?></td>
                            <td><!-- Add logic to display seats left --></td>
                            <td><a href="<?php echo base_url('admin/editMovie/' . $movie->id); ?>" class="btn btn-primary">Edit</a></td>
                            <td><a href="<?php echo base_url('admin/deleteMovie/' . $movie->id); ?>" class="btn btn-secondary">Delete</a></td>
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

