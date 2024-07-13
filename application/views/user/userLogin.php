<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>

    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    }
    body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    }

    .wrapper{
    width: 420px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(9px);
    color: #fff;
    border-radius: 12px;
    padding: 30px 40px;
    }
    .wrapper h1{
    font-size: 36px;
    text-align: center;
    }
    .wrapper .input-box{
    position: relative;
    width: 100%;
    height: 50px;
    
    margin: 30px 0;
    }
    .input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255, 255, 255, .2);
    border-radius: 40px;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
    }
    .input-box input::placeholder{
    color: #fff;
    }
    .input-box i{
    position: absolute;
    right: 20px;
    top: 30%;
    transform: translate(-50%);
    font-size: 20px;

    }
    .wrapper .remember-forgot{
    display: flex;
    justify-content: space-between;
    font-size: 14.5px;
    margin: -15px 0 15px;
    }
    .remember-forgot label input{
    accent-color: #fff;
    margin-right: 3px;

    }
    .remember-forgot a{
    color: #fff;
    text-decoration: none;

    }
    .remember-forgot a:hover{
    text-decoration: underline;
    }
    .wrapper .btn{
    width: 100%;
    height: 45px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
    }
    .wrapper .register-link{
    font-size: 14.5px;
    text-align: center;
    margin: 20px 0 15px;

    }
    .register-link p a{
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    }
    .register-link p a:hover{
    text-decoration: underline;
    }

  </style>
</head>
<body>
  <div class="wrapper">
    <form action="<?php echo base_url('userLogin')?>" method="post">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" placeholder="Email" name="email" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div>
      <button type="submit" class="btn">Login</button>
      <div class="register-link">
        <p>Dont have an account? <a href="<?php echo base_url('userRegister')?>">Register</a></p>
      </div>
    </form>
  </div>

      <?php if($this->session->flashdata('fail')){?>		
        <Script>
          Swal.fire({
            title: 'Sorry',
            text: 'Invalid email or password!!',
            type: 'error',
            timer: 3000,
                      icon: 'warning',
            showConfirmButton: false
          });
        </Script>
			<?php }?>

      <?php if($this->session->flashdata('success')){?>		
        <Script>
          Swal.fire({
            title: 'Congrats',
            text: 'Registration successful. You can now login !!',
            type: 'success',
            timer: 3000,
                      icon: 'warning',
            showConfirmButton: false
          });
        </Script>
			<?php }?>
</body>
</html>