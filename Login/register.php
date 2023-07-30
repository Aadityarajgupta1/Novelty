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
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
        <!-- <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"/> -->
       
       
     </head>

   <body>

       <div id="banner" class="background" >

           <div class="navbar">
               <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
                <ul>
                <li><a href="../Home/Index.php">HOME</a></li>
                <li><a href="../Blog/Blog.php">BLOG</a></li>
                <li><a href="../Book/Book.php">BOOKS</a></li>
                <li><a href="../Contact/Contact.php">CONTACT</a></li>
                <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <li><a href="../Login/Logout/logout.php">Logout</a></li>
                  <?php
                }
                else
                {
                  ?>
                  <li><a class="active" href="../Login/login.php">Login</a></li>
                  <?php
                }
                ?>
                <li><a href="../Cart/Cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
           </div>


           <div class="card-body">
             <form action="functions/authcode.php" method="POST">
               <h2>Sign Up</h2>
               <div class="form-group">
                 <label for="username">Username</label>
                 <input type="text" id="username" name="name" required>
               </div>
               <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" id="phone" name="phone" min="10" max="10" required>
               </div>
               <div class="form-group">
                 <label for="email">Email</label>
                 <input type="email" id="email" name="email" required>
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" required>
               </div>
               <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" id="confirm_password" name="cpassword" required>
               </div>


                  <?php if(isset($_SESSION['message'])){ ?>
                  <p class="alert"></p> <?= $_SESSION['message']; ?>
                  <?php
                  unset($_SESSION['message']);
                  } ?>
                  
                  
                  <button type="submit" name="reg_btn" class="btn">Register</button>
             </form>
             
               <p class="switch-text">Already have an account? <a href="../Login/login.php">Sign in</a></p>
            
          </div>

  </body>
</html>