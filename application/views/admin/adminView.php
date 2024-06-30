
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
        }

        .btn-primary {
            background-color: #3498db;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #2980b9;
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
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Data - Replace with PHP code to dynamically generate rows -->
                <tr>
                    <td>1</td>
                    <td>Movie A</td>
                    <td>10:00 AM</td>
                    <td>Screen 1</td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-primary">Edit</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

