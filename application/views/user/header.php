<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            color: #333;
        }

        .navbar {
            background-color: #1a1a1a;
            overflow: hidden;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 25px 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar .nav-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            margin-right: 30px;
        }

        .navbar .nav-list li {
            margin-right: 30px;
        }

        .navbar .nav-list a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar .nav-list a:hover {
            background-color: #3498db;
            color: #fff;
        }

        .navbar .nav-list .active a {
            background-color: #8e44ad;
            color: #fff;
        }

        .navbar .logout a {
            color: white !important;
            text-decoration: none !important;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            background-color: #e74c3c;
        }

        .navbar .logout a:hover {
            background-color: #c0392b;
            color: white;
        }

        .content {
            margin-top: 100px; /* Adjust the margin to account for the fixed header */
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-list">
            <li <?php if ($active_tab == 'home') echo 'class="active"'; ?>><a href="<?php echo base_url('userHome')?>">Home</a></li>
            <li <?php if ($active_tab == 'register') echo 'class="active"'; ?>><a href="<?php echo base_url('userRegister')?>">Register</a></li>
            <li <?php if ($active_tab == 'login') echo 'class="active"'; ?>><a href="<?php echo base_url('userLogin')?>">Login</a></li>
        </ul>
    </nav>
</body>
</html>
