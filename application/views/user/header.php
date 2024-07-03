<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            color: #333;
        }

        .navbar {
            background-color: #2c3e50;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 20px 20px;
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
            font-weight: 500;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
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
        }

        .user-menu .dropdown {
            display: none;
            position: absolute;
            top: 45px; /* Adjusted for better alignment */
            right: 0;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            list-style: none;
            padding: 0;
            margin: 0;
            z-index: 1000;
            min-width: 140px;
            transition: all 0.3s ease-in-out;
        }

        .user-menu:hover .dropdown {
            display: block;
        }

        .dropdown li {
            padding: 10px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown li:last-child {
            border-bottom: none;
        }

        .dropdown li a {
            text-decoration: none;
            color: white;
            display: block;
            width: 100%;
            font-weight: 500;
        }

        .dropdown li a:hover {
            background: #e74c3c !important; /* Updated hover color with !important */
            color: white;
        }

        .content {
            margin-top: 100px;
            padding: 20px;
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
