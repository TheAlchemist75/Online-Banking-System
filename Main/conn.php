<?php
$conn = mysqli_connect("localhost", "root", "", "bank");

if(!$conn){
  die("Uh Oh, unable to connect. Issue : " . mysqli_connect_error());
}
?>
