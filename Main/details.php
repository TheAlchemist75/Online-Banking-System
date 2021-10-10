<?php include("conn.php");

if(isset($_POST['submit']))
{
    $from = $_GET['u_id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where u_id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * from users where u_id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';
        echo '</script>';
    }


    else if($amount > $sql1['u_bal'])
    {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';
        echo '</script>';
    }


    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Uh Oh, You cannot transfer Zero value!')";
         echo "</script>";
     }


    else {

                $newbalance = $sql1['u_bal'] - $amount;
                $sql = "UPDATE users set u_bal=$newbalance where u_id=$from";
                mysqli_query($conn,$sql);


                $newbalance = $sql2['u_bal'] + $amount;
                $sql = "UPDATE users set u_bal=$newbalance where u_id=$to";
                mysqli_query($conn,$sql);

                $sender = $sql1['u_name'];
                $receiver = $sql2['u_name'];
                $sql = "INSERT INTO history(`h_sender`, `h_receiver`, `h_amt`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='history.php';
                           </script>";

                }

                $newbalance= 0;
                $amount =0;
        }

}

?>

<html>
  <head>
    <title>Home - Details | Online Banking System</title>
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
    $id = $_GET['u_id'];
    $sql = "SELECT * FROM users WHERE u_id ='$id'";
    $result = mysqli_query($conn, $sql);
     ?>

     <div id="table3">
       <table class="styled-table">
         <thead>
           <tr>
             <th scope="col">Name</th>
             <th scope="col">Email</th>
             <th scope="col">Balance</th>
           </tr>
         </thead>

         <?php

            if (mysqli_num_rows($result) > 0) {
            while ($users = mysqli_fetch_assoc($result)){
          ?>
           <tr>
             <td><?php echo $users['u_name']; ?></td>
             <td><?php echo $users['u_email']; ?></td>
             <td><?php echo $users['u_bal']; ?></td>
           </tr>

        <?php
         }
        }else{
         echo "Somethin went wrong : 0 results";
        }?>
       </table>

       <div id="form2">
         <form method="POST">
           <div><label id="lb1">Receiver :</label></div>
            <select style="margin-top: 8px; height: 30px; width: 200px;" name="to" required>
              <option value="" disabled selected>Choose</option>
                <?php
                  $sql = "SELECT * FROM users where u_id!=$id";
                  $result=mysqli_query($conn,$sql);
                  if(!$result)
                  {
                    echo "Uh Oh, unable to connect ".$sql."<br>".mysqli_error($conn);
                  }
                  while($rows = mysqli_fetch_assoc($result)) {
                ?>
                <option value="<?php echo $rows['u_id'];?>" >
                    <?php echo $rows['u_name'] ;?> : Balance -
                    <?php echo $rows['u_bal'] ;?>
                </option>
                <?php
                }
                ?>
          </select><br>

          <div style="margin-top: 30px;"><label id="lb2">Amount:</label></div>
          <input style="margin-top: 8px; height: 30px; width: 200px;" type="number" name="amount" required>

          <div id="btn">
            <button style="margin-top: 30px;" name="submit" type="submit" id="b1">Transfer</button>
            <button name="back"  id="b2" onclick="location.href = 'Info.php';">Back</button>
          </div>
      </form>
      </div>
    </div>
  </div>
  </div>
</body>
</html>
