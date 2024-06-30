<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background-color: #8e44ad;
            color: #ffffff;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .login-header h2 {
            margin: 0;
            font-size: 24px;
            animation: slideIn 0.8s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-form {
            padding: 30px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            text-align: left;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 16px;
            font-weight: bold;
        }

        button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-header">
            <h2>Admin Login</h2>
        </div>
        <div class="login-form">
            <form action="<?php echo base_url('adminlogin')?>" method="post">
                <label for="admin_name">Admin Email:</label>
                <input type="text" name="admin_name" value="<?php echo set_value('admin_name'); ?>" required>
                <label for="admin_password">Password:</label>
                <input type="password" name="admin_password" required>
                <button type="submit">Login as Admin</button>
            </form>
        </div>
    </div>
</body>
</html>
