<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <title>View Movie</title>
    <style>
        .container {
            max-width: 1050px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            margin-top: 90px;
        }
        .left-side {
           width: 30%;
           padding: 20px 20px;
        }

        .left-side img{
            height: 300px;
            width: 200px;
            margin-left: 30px;
        }

        .right-side {
            width: 70%;
            padding: 0px 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .movie-details {
            font-size: 16px;
            font-family: poppins;
            margin-bottom: 20px;
            margin-left: 30px;
            font-weight: 600;
        }
        .movie-details dt {
            font-weight: bold;
            margin-top: 5px;
        }
        .movie-photo {
            width: 100%;
            cursor: pointer;
        }
        .seating-arrangement {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 20px;
        }
        .seat {
            width: 30px;
            height: 30px;
            background-color: #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .seat.selected {
            background-color: #3498db;
            color: #fff;
        }
        .options {
            margin-top: 20px;
        }
        .options label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .options select, .options input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-buttons {
            display: flex;
            justify-content: space-between;
        }
        .form-buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-buttons button.save {
            background-color: #007bff;
            color: #fff;
        }
        .form-buttons button.save:hover {
            background-color: #0056b3;
        }
        .form-buttons button.cancel {
            background-color: #e74c3c;
            color: #fff;
        }
        .form-buttons button.cancel:hover {
            background-color: #c0392b;
        }

      .tickets {
        width: 650px;
        height: fit-content;
        border: 0.4mm solid rgba(0, 0, 0, 0.08);
        border-radius: 3mm;
        box-sizing: border-box;
        padding: 10px;
        font-family: poppins;
        max-height: 96vh;
        overflow: auto;
        background: white;
        box-shadow: 0px 25px 50px -12px rgba(0, 0, 0, 0.25);
      }
      .ticket-selector {
        background: rgb(243, 243, 243);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: column;
        box-sizing: border-box;
        padding: 20px;
      }
      .head {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
      }
      .title {
        font-size: 16px;
        font-weight: 600;
      }
      .seats {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-height: 150px;
        position: relative;
      }
      .status {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
      }
      .seats::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translate(-50%, 0);
        width: 220px;
        height: 7px;
        background: rgb(141, 198, 255);
        border-radius: 0 0 3mm 3mm;
        border-top: 0.3mm solid rgb(180, 180, 180);
      }
      .item {
        font-size: 12px;
        position: relative;
      }
      .item::before {
        content: "";
        position: absolute;
        top: 50%;
        left: -12px;
        transform: translate(0, -50%);
        width: 10px;
        height: 10px;
        background: rgb(255, 255, 255);
        outline: 0.2mm solid rgb(120, 120, 120);
        border-radius: 0.3mm;
      }
      .item:nth-child(2)::before {
        background: rgb(180, 180, 180);
        outline: none;
      }
      .item:nth-child(3)::before {
        background: rgb(28, 185, 120);
        outline: none;
      }
      .all-seats {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        grid-gap: 15px;
        margin: 60px 0;
        margin-top: 20px;
        position: relative;
      }
      .seat {
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 0.5mm;
        outline: 0.3mm solid rgb(180, 180, 180);
        cursor: pointer;
      }
      .all-seats input:checked + label {
        background: rgb(28, 185, 120);
        outline: none;
      }
      .seat.booked {
        background: rgb(180, 180, 180);
        outline: none;
      }
      input {
        display: none;
      }
      .timings {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
      }
      .dates {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .dates-item {
        width: 50px;
        height: 40px;
        background: rgb(233, 233, 233);
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 10px 0;
        border-radius: 2mm;
        cursor: pointer;
      }
      .day {
        font-size: 12px;
      }
      .times {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-around;
        margin-top: 10px;
      }
      .time {
        font-size: 14px;
        width: fit-content;
        padding: 7px 14px;
        background: rgb(233, 233, 233);
        border-radius: 2mm;
        cursor: pointer;
      }
      .timings input:checked + label {
        background: rgb(28, 185, 120);
        color: white;
      }
      .price {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .total {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        font-size: 16px;
        font-weight: 500;
      }
      .total span {
        font-size: 11px;
        font-weight: 400;
      }
      .price button {
        background: rgb(60, 60, 60);
        color: white;
        font-family: poppins;
        font-size: 14px;
        padding: 7px 14px;
        border-radius: 2mm;
        outline: none;
        border: none;
        cursor: pointer;
      }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($movie->photo); ?>" alt="Movie Photo">
        <div class="movie-details">
                <dl>
                    <dt>Movie Name: <?php echo htmlspecialchars($movie->name, ENT_QUOTES, 'UTF-8'); ?></dt>

                    <dt>Genre: <?php echo htmlspecialchars($movie->genre, ENT_QUOTES, 'UTF-8'); ?></dt>

                    <dt>Screen Number: <?php echo htmlspecialchars($movie->screen_number, ENT_QUOTES, 'UTF-8'); ?></dt>

                    <dt>Price per Seat: <?php echo htmlspecialchars($movie->price, ENT_QUOTES, 'UTF-8'); ?> Rs</dt>

                    <dt>Date: <?php echo htmlspecialchars($movie->date, ENT_QUOTES, 'UTF-8'); ?></dt>  
                </dl>
            </div>
        </div>
        <div class="right-side">
            

      <div class="tickets">
        <div class="ticket-selector">
          <div class="head">
            <div class="title"> <?php echo htmlspecialchars($movie->name, ENT_QUOTES, 'UTF-8'); ?></div>
          </div>
          <div class="seats">
            <div class="status">
              <div class="item">Available</div>
              <div class="item">Booked</div>
              <div class="item">Selected</div>
            </div>
            <div class="all-seats">
              <input type="checkbox" name="tickets" id="s1" />
              <label for="s1" class="seat booked"></label>
            </div>
          </div>
          <div class="timings">       
          <div class="times">
                <?php
                foreach ($time_slots as $index => $time) {
                    $checked = $index === 0 ? 'checked' : '';
                    echo "<input type='radio' name='time' id='t$index' $checked />";
                    echo "<label for='t$index' class='time'>$time</label>";
                }
                ?>
            </div>
          </div>
        </div>
        <div class="price">
          <div class="total">
            <span> <span class="count">0</span> Tickets </span>
            <div class="amount">0</div>
          </div>
          <button type="button">Book</button>
        </div>
      </div>
    </div>
        </div>

    <script>
      let seats = document.querySelector(".all-seats");
      for (var i = 0; i < 59; i++) {
        let randint = Math.floor(Math.random() * 2);
        let booked = randint === 1 ? "booked" : "";
        seats.insertAdjacentHTML(
          "beforeend",
          '<input type="checkbox" name="tickets" id="s' +
            (i + 2) +
            '" /><label for="s' +
            (i + 2) +
            '" class="seat ' +
            booked +
            '"></label>'
        );
      }

      let tickets = seats.querySelectorAll("input");
      tickets.forEach((ticket) => {
        ticket.addEventListener("change", () => {
          let amount = document.querySelector(".amount").innerHTML;
          let count = document.querySelector(".count").innerHTML;
          amount = Number(amount);
          count = Number(count);

          if (ticket.checked) {
            count += 1;
            amount += 200;
          } else {
            count -= 1;
            amount -= 200;
          }
          document.querySelector(".amount").innerHTML = amount;
          document.querySelector(".count").innerHTML = count;
        });
      });
    </script>
</body>
</html>
