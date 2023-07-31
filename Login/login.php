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
        <link rel="stylesheet" href="login.css">
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
                  <li><a href="../Cart/Cart.php"><i class="fa fa-shopping-cart"></i></a></li>

                  <?php
                }
                else
                {
                  ?>
                  <li><a class="active" href="../Login/login.php"><i class="fa fa-user"></i></a></li>
                  <?php
                }
                ?>
                </ul>
           </div>

           <div class="card-body">
             <form action="functions/authcode.php" method="POST">
               <h2>Sign In</h2>
                 <div class="form-group">
                <label for="username">Email</label>
                <input type="text" id="username" name="email" required>
                 </div>
                 <div class="form-group">
                   <label for="password">Password</label>
                   <input type="password" id="password" name="password" required>
                 </div>
                 <?php if(isset($_SESSION['message'])){ ?>
                  <p class="alert"></p> <?= $_SESSION['message']; ?>
                  <?php
                  unset($_SESSION['message']);
                  } ?>
                 <div class="form-group">
                 <button type="submit" name="log_btn" class="btn">Login</button>
              </form>
              <p class="switch-text">Don't have an account? <a href="../Login/register.php">Sign up</a></p>
           </div>
</body>
</html>