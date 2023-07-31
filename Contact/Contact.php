<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novelty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="./Contact.css">
</head>
<body>
           <div class="navbar">
                <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
                <ul>
                <li class="act"><a href="../Home/Index.php">HOME</a></li>
                <li><a href="../Blog/Blog.php">BLOG</a></li>
                <li><a href="../Book/Book.php">BOOKS</a></li>
                <li><a class="active" href="./Contact.php">CONTACT</a></li>
                <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <li><a href="../Login/logout.php">Logout</a></li>
                  <li><a href="../Cart/Cart.php"><i class="fa fa-shopping-cart"></i></a></li>

                  <?php
                }
                else
                {
                  ?>
                  <li><a href="../Login/login.php"><i class="fa fa-user"></i></a></li>
                  <?php
                }
                ?>
                </ul>

           </div>

           <!-- Heading -->
           <section id="page-header">

            <h2>#KnowUs</h2>
            <p>Visit us now, We'll love to have you.</p>

           </section>


           <section id="contact-details" class="section-p1 section-m1">
             <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Visit one of our agency locations or contact us today.</h2>
                <h3>Head Office</h3>
                 <div>
                    <li>
                        <i class="fa fa-map"></i>
                        <p>Kanibahal Sinchahiti Road, Lalitpur</p>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <p>novelty@gmail.com</p>
                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <p>9808389105, 9840802525</p>
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <p>Sunday to Friday: 9:00 AM to 8:00 PM</p>
                    </li>
                 </div>
             </div>
                 <div class="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.62098089304!2d85.32381207616694!3d27.667195927259915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198ceff20941%3A0x12e0bc15376c6c73!2sSwoyambhu%20International%20College!5e0!3m2!1sen!2snp!4v1688820966670!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                 </div>   
            </section>
           


             <!-- Newsletter -->
             <section id="newsletter" class="section-p1 section-m1">
              <div class="nestext">
                <h4>Sign up for Newsletter</h4>
                <p>Get E-mail updates about our latest shop and <span class="span2">special offers</span>.</p>
              </div>
              <div class="form">
                <input type="text" placeholder="Your Email Address">
                <button class="normal">Sign up</button>
              </div>
             </section>

         <!-- Footer  -->
         <footer class="section-p1">
            <div class="col">
                <img src="logo1.png" class="logo1" alt="">
                <h4>Contact</h4>
                <p><strong>Address:</strong> Lagankhel, Lalitpur (27.667803, 85.326342) </p>
                <p><strong>Phone:</strong> (+977) 9808389105 / (+977) 9840802525 </p>
                <p><strong>Hours:</strong> 10:00 - 18:00, Sun - Fri </p>
                <div class="follow">
                    <h4>Follow us</h4>
                    <div class="icon">
                        <a href="https://www.facebook.com/profile.php?id=100090264392956"><i class="fa fa-facebook-f"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.instagram.com/matri_digital/"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4>About</h4>
                <a href="#">About us</a>
                <a href="#">Delivery Information</a>
                <a href="#">Privacy policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="../Contact/Contact.php">Contact us</a>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <a href="../Login/logout.php">Sign out</a>
                  <?php
                }
                else
                {
                  ?>
                  <a href="../Login/login.php">Sign in</a>
                  <?php
                }
                ?>
                <a href="..\Cart\Cart.php">View cart</a>
                <a href="#">My Wishlist</a>
                <a href="../Cart/my-orders.php">Track my order</a>
                <a href="#">Help</a>
            </div>

            <div class="col install">
                <h4>Install App</h4>
                <p>From App Store or Google Play</p>
                <div class="row">
                    <a href="#"><img src="./Images/app.jpg" alt=""></a>
                    <a href="#"><img src="./Images/play.jpg" alt=""></a>
                </div>
                <p>Secured Payment Gateway</p>
                <a href="#"><img src="./Images/pay.png" alt=""></a>
            </div>

            <div class="copyright">
                <p>2023, Aadi - Novelty Pvt. Ltd.</p>
            </div>
        </footer>
</body>
</html>