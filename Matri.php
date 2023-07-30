<?php
session_start();
require './Dashboard/configer/dbcon.php';
?>
 <?php if(isset($_SESSION['message'])){ ?>
<p class="alert"></p> <?= $_SESSION['message']; ?>
<?php
unset($_SESSION['message']);
} ?>

<html>
     <head>
        <title>Novelty.com</title>
        <link rel="stylesheet" href="Style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
        <!-- <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"/> -->
       
       
     </head>

   <body>

       <div id="banner" class="background" >

           <div class="navbar">
               <a href="./matri.php"><img src="logo.png" class="logo"></a>
                <ul>
                <li><a class="active" href="./matri.php">HOME</a></li>
                <li><a href="./Blog/Blog.php">BLOG</a></li>
                <li><a href="./Book/Book.php">BOOKS</a></li>
                <li><a href="./Contact/Contact.php">CONTACT</a></li>
                <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <li><a href="./Login/logout.php">Logout</a></li>
                  <li><a href="./Cart/Cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                  <?php
                }
                else
                {
                  ?>
                  <li><a href="./Login/login.php">Login</a></li>
                  <?php
                }
                ?>
                
                </ul>

           </div>

           <div class="content">
                <h1>WE ARE EVERYTHING YOU NEED</h1>
                <p>We offers a diverse range of products across multiple categories, providing a one-stop-shop for all your shopping needs.<br> With a user-friendly interface and secure payment gateway, enjoy a seamless shopping experience<br> and excellent customer service.</p>
          
            </div>

       </div>

       <section id="feature">
       <div class="title-text">
       <p>FEATURES</p>
       <h1>Why Choose Us?</h1>
       </div>

       <div class="feature-box">
           <div class="features">


                <h1 class="h1">Unlimited Books</h1>  
                <div class="features-desc">
                    <div class="feature-icon">
                        <i class="fa fa-shield" aria-hidden="true"></i>
                    </div>
                    <div class="feature-text">
                      <p>Unleash your imagination's flight, with boundless worlds and endless delight. Dive into the realms untold, where unlimited books unfold.</p>  
                    </div>
                </div>

                <h1 class="h1">Novels</h1>  
                <div class="features-desc">
                    <div class="feature-icon">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </div>
                    <div class="feature-text">
                      <p>Novels breathe life into ink and paper, weaving tales that our hearts forever savor. Immerse your soul, let the stories ignite, as novels transport you to realms beyond sight.</p>  
                    </div>
                </div>


                <h1 class="h1">Affordable price</h1>  
                <div class="features-desc">
                    <div class="feature-icon">
                        <i class="fa fa-inr" aria-hidden="true"></i>
                    </div>
                    <div class="feature-text">
                      <p>Quality need not be compromised, as affordable prices harmonize. Discover value that doesn't break the bank, where cost and excellence walk hand in hand.</p>  
                    </div>
                </div>


           </div>
           <div class="features-img">
            <img src="1.jpg">
           </div>

       </div>
       </section>

       <!-- Loader Section
       <div class="loader-container">
             <img src="./Loader.gif" alt="">
       </div> -->

      <!--Services -->
      <section id="product1" class="section-p1">
      <div class="title-text">
                <p>BOOKS</p>
                <h1>Popular Books</h1>
                </div>
            <div class="pro-container">
           
              <?php
              $query = "SELECT * FROM products WHERE status='0' LIMIT 8";
              $query_run = mysqli_query($con, $query);
              $check_products = mysqli_num_rows($query_run) > 0;

              if($check_products)
              {
                  while($row = mysqli_fetch_array($query_run))
                  {
                    ?>
                    <a href="./Book/sproduct.php?product=<?=$row['slug'];?>">
                    <div class="pro">
                    <img src="./Dashboard/main/uploads/<?= $row['image']; ?>" alt="All Images">
                    <div class="des">
                        <span><?php echo $row['name']; ?></span>
                        <h5><?php echo $row['author']; ?></h5>
                        <div class="star">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <h4>Rs.<?php echo $row['selling_price']; ?></h4>
                    </div></a>
                    <button class="addToCartBtn" value="<?=$row['id'];?>"><i class="fa fa-shopping-cart"></i></button>

                    </div>
                  
                    <?php                   
                  }
              }
              else
              {
                echo "No Products Found";
              }
              ?>
            </div>
          </section>

        <!-- Action -->
        <section id="banner1" class="section-m1">
            <h4>!!OFFER OFFER OFFER!!</h4>
            <h2>Upto <span class="span3">50% Off</span> on all Business Books.</h2>
            <a href="./Book/Book.php">
            <button class="normal">Explore More</button>
            </a>
        </section>

        <!-- Text Banner -->
        <section id="banner2">
            <div class="banner-box">
                <h2>Winter Sale</h2>
                <h3>Winter Offers - 30% off</h3>
            </div>

             <div class="banner-box banner-box2">
                <h2>Summer Sale</h2>
                <h3>Summer Offers - 20% off</h3>
            </div>

            <!-- <div class="banner-box banner-box3">
                <h2>Winter Sale</h2>
                <h3>Winter Offers - 20% off</h3>
            </div> --> 

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
                <a href="./Contact/Contact.php">Contact us</a>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <a href="./Login/logout.php">Sign out</a>
                  <?php
                }
                else
                {
                  ?>
                  <a href="./Login/login.php">Sign in</a>
                  <?php
                }
                ?>
                <a href="C:\Users\user\Desktop\Documents\Matri\Novelty\Webpage\Cart\Cart.html">View cart</a>
                <a href="#">My Wishlist</a>
                <a href="#">Track my order</a>
                <a href="#">Help</a>
            </div>

            <div class="col install">
                <h4>Install App</h4>
                <p>From App Store or Google Play</p>
                <div class="row">
                    <a href="#"><img src="app.jpg" alt=""></a>
                    <a href="#"><img src="play.jpg" alt=""></a>
                </div>
                <p>Secured Payment Gateway</p>
                <a href="#"><img src="pay.png" alt=""></a>
            </div>

            <div class="copyright">
                <p>2023, Aadi - Novelty Pvt. Ltd.</p>
            </div>
        </footer>
     
       
       
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./Book/sbook.js"></script>
        <!-- <script src="script.js"></script> -->
   </body>  
</html>