<?php
include('../Login/functions/userMyfunctions.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novelty</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="./Book.css">
    
</head>
<body>
           <div class="navbar">
             <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
                <ul>
                <li class="act"><a href="../Home/Index.php">HOME</a></li>
                <li><a href="../Blog/Blog.php">BLOG</a></li>
                <li><a class="active" href="./Book.php">BOOKS</a></li>
                <li><a href="../Contact/Contact.php">CONTACT</a></li>
                <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <li><a href="../Login/Logout.php">Logout</a></li>
                  <?php
                }
                else
                {
                  ?>
                  <li><a href="../Login/login.php">Login</a></li>
                  <?php
                }
                ?>
                <li><a href="../Cart/Cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>

           </div>

           <!-- Heading -->
           <section id="page-header">

           <h2>#RealityEscape</h2>
           <p>Reading opens doors to infinite knowledge, sparks boundless imagination, and nurtures the soul.</p>

           </section>
           
          <!-- Categories -->
           <div class="select-menu">
               <div class="select-btn">
                  <span class="sBtn-text">Categories</span>
                  <i class="bx bx-chevron-down"></i>
               </div>               
                 <ul class="options">
               
                 <?php
                  $categories = getAllActive("categories");

                  if(mysqli_num_rows($categories) > 0)
                  {
                     foreach($categories as $item)
                    {
                        ?>
                          <a href="./products.php?category=<?= $item['slug']; ?>" >
                            <li class="option">
                            <i class="bx bx-book"></i>
                            <span class="option-text  active"><?= $item['name']; ?></span>
                            </li>
                          </a>
                        <?php
                    }
                  }
                  else
                  {
                  echo "No Data Available!!";
                  }
                 ?>
               </ul>
           </div>

          <!-- All Book -->
          <section id="product1" class="section-p1">
            <div class="pro-container">
              <?php
              $query = "SELECT * FROM products WHERE status='0'";
              $query_run = mysqli_query($con, $query);
              $check_products = mysqli_num_rows($query_run) > 0;

              if($check_products)
              {
                  while($row = mysqli_fetch_array($query_run))
                  {
                    ?>
                    <a href="./sproduct.php?product=<?=$row['slug'];?>">
                    <div class="pro">
                      
                    <img src="../Dashboard/main/uploads/<?= $row['image']; ?>" alt="All Images">
                     
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
                

         <!-- Pagination -->
         <!-- <section id="pagination" class="section-p1">
          <a href="#">1</a>
          <a href="#">2</a>
          <a href="#">--<i class="fa fa-arrow"></i></a>
        </section> -->

         <!-- Newsletter  -->
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
                <img src="./Images/logo1.png" class="logo1" alt="">
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

              <!-- Footer  -->
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


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./script.js"></script>
        <script src="./Book.js"></script>

</body>
</html>