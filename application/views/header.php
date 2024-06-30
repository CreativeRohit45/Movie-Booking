<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad)
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 25px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .content {
            margin-top: 70px; /* Adjust the margin to account for the fixed header */
            padding: 20px;
        }

        .hamburger-menu {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: #fff;
            transition: color 0.3s;
        }

        .nav-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .nav-list li {
            margin-right: 20px;
        }

        .nav-list a {
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-list a:hover {
            background-color: #ddd;
            color: #333;
        }

        .nav-list .active a {
            background-color: #ddd;
            color: #333;
        }

        .logout {
            margin-left: auto;
        }

        .logout a {
            color: white !important;
            text-decoration: none !important;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout a:hover {
            background-color: #c82333;
            color: white;
        }

        @media screen and (max-width: 768px) {
            .hamburger-menu {
                display: block;
                font-size: 24px;
                cursor: pointer;
                color: #fff;
                transition: color 0.3s;
                z-index: 1001; /* Ensure the hamburger icon is above the menu */
            }

            .nav-list {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background-color: #333;
                z-index: 1000;
                padding: 0;
                margin: 0;
            }

            .nav-list.active {
                display: flex;
            }

            .nav-list li {
                width: 100%;
                text-align: center;
                margin: 0;
                border-bottom: 1px solid #444;
            }

            .nav-list a {
                display: block;
                padding: 15px;
                color: white;
                text-decoration: none;
                transition: background-color 0.3s, color 0.3s;
            }

            .nav-list a:hover {
                background-color: #ddd;
                color: #333;
            }

            .logout {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="hamburger-menu" onclick="toggleMenu()">&#9776;</div>
        <ul class="nav-list">
            <li <?php if ($active_tab == 'home') echo 'class="active"'; ?>><a href="<?php echo base_url('adminView')?>">Home</a></li>
            <li <?php if ($active_tab == 'add_show') echo 'class="active"'; ?>><a href="<?php echo base_url('addShow')?>">Add Shows</a></li>
            <li <?php if ($active_tab == 'view_bookings') echo 'class="active"'; ?>><a href="<?php echo base_url('viewBookings')?>">View Bookings</a></li>
            <div class="logout"><a href="<?php echo base_url('adminlogout')?>">Logout</a></div>
        </ul>
    </nav>

    <div class="content">
        <!-- Content goes here -->
    </div>

    <script>
        function toggleMenu() {
            const navList = document.querySelector('.nav-list');
            navList.classList.toggle('active');
        }
    </script>
</body>
</html>
