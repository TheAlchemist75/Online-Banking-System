<?php include("conn.php");?>

<html>
  <head>
    <title>Home - History | Online Banking System</title>
    <link rel = "icon" href ="Images/icon1.png" type = "image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" rel="stylesheet" href="CSS/info.css">
    <link type="text/css" rel="stylesheet" href="CSS/detailsStyle.css">
  </head>

  <body>
    <div id="par1" style="background-image: url(Images/cc.jpg);">
      <div id="content">
      <div id="Head">
      <div id="BName"><a href="Home.html" style="color: #3c005a;"> Genesis Financial Corp.</a></div>
      <div id="BHome"><a href="Home.html" style="color: white;">Home</a></div>
      <div id="BAbout"><a href="About.html" style="color: #3c005a">About</a></div>
      <div id="BContact"><a href="contact.html" style="color: #3c005a">Contact</a></div>
      </div>

      <?php
      $sql = "SELECT * FROM history";
      $result = mysqli_query($conn, $sql);
       ?>

      <div style="margin-top: 100px; margin-left: 250px;">
        <table class="styled-table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Sender</th>
              <th scope="col">Receiver</th>
              <th scope="col">Amount</th>
            </tr>
          </thead>

        <?php

        if (mysqli_num_rows($result) > 0) {
          while ($history = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php echo $history['h_id']; ?></td>
              <td><?php echo $history['h_sender']; ?></td>
              <td><?php echo $history['h_receiver']; ?></td>
              <td><?php echo $history['h_amt']; ?></td>
            </tr>

            <?php
          }
        }else{
          echo "Somethin went wrong : 0 results";
        }?>
        </table>

        <input style="margin-top: 30px; margin-left: 300px;" type="button" id="b1" value="Back" onclick="location.href = 'Info.php';">

    </div>
  </body>
  </html>
