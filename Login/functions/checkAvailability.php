<?php
include '../../Dashboard/configer/dbcon.php';

if (!empty($_POST["email"])) {
  $email = $_POST["email"];

  // Use prepared statement to prevent SQL injection
  $query = "SELECT * FROM users WHERE email = ?";
  $stmt = mysqli_prepare($con, $query);
  mysqli_stmt_bind_param($stmt, "s", $email);  // "s" for string parameter
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  
  $count = mysqli_num_rows($result);
  if ($count > 0) {
      echo "<span style='color:red'>Sorry, Email already exists.</span>";
      echo "<script>$('#submit').prop('disabled', true);</script>";
  } else {
      echo "<span style='color:green'>Email available for Registration.</span>";
      echo "<script>$('#submit').prop('disabled', false);</script>";
  }

  mysqli_stmt_close($stmt);
}

  if(!empty($_POST["phone"])) {
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