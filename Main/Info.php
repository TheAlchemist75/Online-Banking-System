<?php include("conn.php"); ?>

<html>
  <head>
    <title>Home - Info | Online Banking System</title>
    <link rel = "icon" href ="Images/icon1.png" type = "image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" rel="stylesheet" href="CSS/info.css">
  </head>

  <body>
    <div id="par1" style="background-image: url(Images/cc.jpg);">
      <div id="Head">
      <div id="BName"><a href="Home.html" style="color: #3c005a;"> Genesis Financial Corp.</a></div>
      <div id="BHome"><a href="Home.html" style="color: white;">Home</a></div>
      <div id="BAbout"><a href="About.html" style="color: #3c005a">About</a></div>
      <div id="BContact"><a href="contact.html" style="color: #3c005a">Contact</a></div>
      </div>

      <?php
      $sql = "SELECT * FROM users";
      $result = mysqli_query($conn, $sql);
       ?>

      <div id="table1">

        <table class="styled-table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Balance</th>
              <th scope="col">Transfer</th>
            </tr>
          </thead>

        <?php

        if (mysqli_num_rows($result) > 0) {
          while ($users = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php echo $users['u_id']; ?></td>
              <td><?php echo $users['u_name']; ?></td>
              <td><?php echo $users['u_email']; ?></td>
              <td><?php echo $users['u_bal']; ?></td>
              <td><a id="view1" href="details.php?u_id=<?php echo $users['u_id']; ?>">View</a></td>
            </tr>

            <?php
          }
        }else{
          echo "Somethin went wrong : 0 results";
        }?>
        </table>

      </div>
    </div>
  </body>
  </html>
