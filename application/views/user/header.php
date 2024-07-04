<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>

        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-weight: 600;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            color: #333;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .navbar {
            background-color: #2c3e50;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 15px 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            height: 70px; /* Set a fixed height for the navbar */
        }

        .navbar .nav-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            height: 100%; /* Ensure the list takes up the full height of the navbar */
        }

        .navbar .nav-list li {
            margin-right: 30px;
            position: relative;
        }

        .navbar .nav-list a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            line-height: 40px; /* Adjust the line height to match the padding */
        }

        .navbar .nav-list a:hover {
            background-color: #2980b9;
            color: #fff;
        }

        .navbar .nav-list .active a {
            background-color: #8e44ad;
            color: #fff;
        }

        .navbar .user-menu a {
            display: flex;
            align-items: center;
            cursor: pointer;
            line-height: 40px; /* Adjust the line height to match the padding */
        }

        .user-menu .dropdown {
            display: none;
            position: absolute;
            top: 55px; /* Adjusted for better alignment */
            right: 0;
            background: #34495e;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            list-style: none;
            margin: 0;
            z-index: 1000;
            min-width: 140px;
            transition: all 0.3s ease-in-out;
        }

        .user-menu:hover .dropdown {
            display: block;
        }

        .dropdown li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown li:last-child {
            border-bottom: none;
        }

        .dropdown li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 10px 20px; /* Added padding for better spacing */
            display: block;
        }

        .dropdown li a:hover {
            background: #e74c3c !important; /* Updated hover color with !important */
            color: white;
        }

    </style>
</head>
<body>
<nav class="navbar">
    <ul class="nav-list">
        <li <?php if ($active_tab == 'home') echo 'class="active"'; ?>><a href="<?php echo base_url('userHome')?>">Home</a></li>
        <?php if ($this->session->userdata('user_id')): ?>
            <li class="user-menu">
                <a><?php echo $this->session->userdata('full_name'); ?></a>
                <ul class="dropdown">
                    <li><a href="<?php echo base_url('userLogout'); ?>">Logout</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li <?php if ($active_tab == 'register') echo 'class="active"'; ?>><a href="<?php echo base_url('userRegister')?>">Register</a></li>
            <li <?php if ($active_tab == 'login') echo 'class="active"'; ?>><a href="<?php echo base_url('userLogin')?>">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

</body>
</html>
