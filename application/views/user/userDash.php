<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            color: #333;
            margin: 0;
            padding: 0;
        }

        .movies-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 80px;
            padding: 20px;
            margin-left: 30px;
        }

        .now-showing {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        .movies-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 75px;
            width: 100%;
        }

        .movies-grid a{
            height: 400px;
        }

        .movie-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 250px;
            transition: transform 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .movie-card img {
            width: 100%;
            height: 85%;
        }

        .movie-card h3 {
            margin: 0;
            padding: 5px 20px;
            font-size: 18px;
            color: #333;
        }

        .movie-card p {
            margin: 0;
            padding: 0px 20px;
            font-size: 14px;
            color: #666;
        }

        .movie-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>
<div class="movies-container">
    <div class="now-showing">Now Showing</div>
    
    <?php 
    // Define today's and tomorrow's dates
    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    // Separate movies into today's and tomorrow's shows
    $todays_movies = [];
    $tomorrows_movies = [];

    foreach ($movies as $movie) {
        if ($movie->date == $today) {
            $todays_movies[] = $movie;
        } elseif ($movie->date == $tomorrow) {
            $tomorrows_movies[] = $movie;
        }
    }
    ?>

    <div class="movies-section">
        <h2>Today's Show</h2>
        <div class="movies-grid">
            <?php foreach ($todays_movies as $movie): ?>
                <a href="<?php echo base_url('viewMovie/' . $movie->id); ?>" class="movie-card">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($movie->photo); ?>" alt="Movie Photo">
                    <h3><?php echo $movie->name; ?></h3>
                    <p><?php echo $movie->genre; ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="movies-section">
        <h2>Tomorrow's Show</h2>
        <div class="movies-grid">
            <?php foreach ($tomorrows_movies as $movie): ?>
                <a href="<?php echo base_url('viewMovie/' . $movie->id); ?>" class="movie-card">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($movie->photo); ?>" alt="Movie Photo">
                    <h3><?php echo $movie->name; ?></h3>
                    <p><?php echo $movie->genre; ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php if ($this->session->flashdata('reg-success')) { ?>
        <script>
            Swal.fire({
                title: 'Successfully Logged!',
                text: 'Welcome Back',
                icon: 'success',
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Skip',
                confirmButtonColor: '#007BFF'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo base_url(''); ?>';
                }
            });
        </script>
    <?php } ?>

</body>
</html>
