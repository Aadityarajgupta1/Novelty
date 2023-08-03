<?php
include '../../Dashboard/configer/dbcon.php';

if(!empty($_POST["email"])) {
    $query = "SELECT * FROM users WHERE email='" . $_POST["email"] . "'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    if($count>0) {
      echo "<span style='color:red'> Sorry Email already exists .</span>";
      echo "<script>$('#submit').prop('disabled',true);</script>";
    }else{
      echo "<span style='color:green'> Email available for Registration .</span>";
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
  }

  elseif(!empty($_POST["phone"])) {
    $query = "SELECT * FROM users WHERE phone='" . $_POST["phone"] . "'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    if($count>0) {
      echo "<span style='color:red'> Sorry this number already exists .</span>";
      echo "<script>$('#submit').prop('disabled',true);</script>";
    }else{
      echo "<span style='color:green'> Looks Good .</span>";
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
  }




?>