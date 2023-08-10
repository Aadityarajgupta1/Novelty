<?php
session_start();
if(isset($_SESSION['auth']))
{
  header('Location: ../Home/Index.php');
  exit();
}
?>
<html>
     <head>
        <title>Novelty.com</title>
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
     </head>

   <body>

       <div id="banner" class="background" >

       <div class="navbar">
      <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
      <ul>
        <li><a  href="../Home/Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a href="../Book/Book.php">BOOKS</a></li>
        <li><a href="../Contact/Contact.php">CONTACT</a></li>
        <li><a class="active" onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
      </ul>
      <!-- <img src="Images/profile.png" class="user-pic" onclick="toggleMenu()"> -->
          <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
              <div class="user-info">
                <img src="./Images/Novelty.png" alt="Image">
                <h3>Hello Guest</h3>
              </div>
              <hr>
              <a href="../User/user.php" class="sub-menu-link">
                <img src="Images/profile.png">
                <p>Manage Profile</p>
                <span><i class="bx bx-chevron-right data"></i></span>
              </a>
              <a href="../Cart/Cart.php" class="sub-menu-link">
                <img src="Images/cart.png">
                <p>Cart</p>
                <span><i class="bx bx-chevron-right data"></i></span>
              </a>
              <a href="../Cart/my-orders.php" class="sub-menu-link">
                <img src="Images/order.png">
                <p>Track my Order</p>
                <span><i class="bx bx-chevron-right data"></i></span>
              </a>
              <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <a href="../Login/logout.php" class="sub-menu-link">
                  <img src="Images/logout.png">
                  <p>Logout</p>
                  <span><i class="bx bx-chevron-right data"></i></span>
                  </a>
                  <?php
                }
                else
                {
                  ?>
                  <a href="../Login/login.php" class="sub-menu-link">
                  <img src="Images/login.png">
                  <p>Login</p>
                  <span><i class="bx bx-chevron-right data"></i></span>
                  </a>
                  <?php
                }
                ?>
              
            </div>
          </div>
  
    </div>


           <div class="card-body">
             <form action="functions/authcode.php" method="POST">
               <h2>Sign Up</h2>
               <div class="form-group">
                 <label for="username">Name</label>
                 <input type="text" id="username" name="name" required>
               </div>
               <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" id="phone" name="phone" onInput="checkPhone()" required>
                 <span id="check-phone"></span>
               </div>
               <div class="form-group">
                 <label for="email">Email</label>
                 <input type="email" id="email" name="email" onInput="checkEmail()" required>
                 <span id="check-email"></span>
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password">
               </div>
               <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" id="confirm_password" name="cpassword" required>
               </div>


                  <?php if(isset($_SESSION['message'])){ ?>
                  <?= $_SESSION['message']; ?>
                  <?php
                  unset($_SESSION['message']);
                  } ?>
                  
                  
                  <button type="submit" id="submit" name="reg_btn" class="btn">Register</button>
             </form>
             
               <p class="switch-text">Already have an account? <a href="../Login/login.php">Sign in</a></p>
            
          </div>


          <script>
            let subMenu = document.getElementById("subMenu");

            function toggleMenu()
            {
              console.log("Function called");
              subMenu.classList.toggle("open-menu");
            }
          </script>

          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script>
            function checkEmail()
            {
               jQuery.ajax({
               url: "./functions/checkAvailability.php",
               data: 'email='+$("#email").val(),
               type: "POST",
               success:function(data){
                $("#check-email").html(data);
               },
               error:function (){}
               });
            }

            $(document).ready(function() {
            // Attach a blur event listener to the email input
            $("#email").blur(function() {
            // Hide the email availability message
            $("#check-email").html("");
            });
            });
          </script>

          <!-- <script>
            function checkPhone()
            {
               jQuery.ajax({
               url: "./functions/checkAvailability.php",
               data: 'phone='+$("#phone").val(),
               type: "POST",
               success:function(data){
                $("#check-phone").html(data);
               },
               error:function (){}
               });
            }

            $(document).ready(function() {
            // Attach a blur event listener to the email input
            $("#phone").blur(function() {
            // Hide the email availability message
            $("#check-phone").html("");
            });
            });
          </script> -->
   
  </body>
</html>