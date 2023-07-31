<?php
include('../Login/functions/userMyfunctions.php'); 

if(isset($_GET['product']))
{
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products",$product_slug);
    $product = mysqli_fetch_array($product_data);

    if($product)
    {
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
          <link rel="stylesheet" href="./sproduct.css">
          
      </head>
      <body>
                 <div class="navbar" class="section-p3">
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
      
              
                 <!-- Single product -->
                 <section id="prodetails" class="section-p2  background  product_data">
                  <div class="single-pro-image">
                  <h5><a href="./Book.php"><i class="bx bx-chevron-left data"></i> Back to Books</a></h5>
                      <div class="khatra">
                      <img src="../Dashboard/main/uploads/<?= $product['image']; ?>" width="100%" alt="Single Image"> 
                      </div> 
                      <h4>Genres: </h4>
                      <p><?= $product['meta_description'] ?></p>
                  </div>
                    <div class="single-pro-details">
                      <h2><?= $product['name'] ?></h2>
                      <p class="h5">By: <?= $product['author'] ?></p>
                      
                      <h3>Rs.<?= $product['selling_price'] ?></h3>

                      <div class="row1">
                      <button class="minus decrement-btn"><i class="bx bx-chevron-left data"></i></button>
                      <input type="text" class="input-qty" value="1" disabled>
                      <button class="plus increment-btn"><i class="bx bx-chevron-right data"></i></button>
                      </div>

                      <button class="normal addToCartBtn" value="<?=$product['id'];?>"><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                      <!-- <button class="normal addToWishBtn" value="<?=$product['id'];?>"><i class="fa fa-heart"></i>Add To Wishlist</button> -->
                      <h4>About the Book</h4>
                      <span><?= $product['description'] ?></span>
                      <!-- Other Info -->
                      <div class="mainOther">
                      <h4>Other info</h4>
                      <div class="other">
                        <div class="smallBox">
                      <div class="otherInfo">
                        <p>Page Count</p>
                        <i class="fa fa-book"></i>
                        <h5><?= $product['page_count'] ?></h5>
                      </div>
                      <div class="otherInfo">
                        <p>Weight</p>
                        <i class="fa fa-shopping-bag"></i>
                        <h5><?= $product['weight'] ?></h5>
                      </div>
                      <div class="otherInfo">
                        <p>ISBN</p>
                        <i class="fa fa-barcode"></i>
                        <h5><?= $product['isbn'] ?></h5>
                      </div>
                      <div class="otherInfo">
                        <p>Language</p>
                        <i class="fa fa-globe"></i>
                        <h5><?= $product['language'] ?></h5>
                      </div>
                    </div>
                      </div>
                    </div>
                    
                      </div>
                      <div class="single-pro-side">
                        <div class="single-pro-sideBar1">
                          <div class="single-pro-sideBar">
                           <i class="fa fa-car"></i>
                           <p>Free Delivery</p>
                           </div>
                           <div class="single-pro-sideBar">
                           <i class="fa fa-credit-card"></i>
                           <p>Pay on Delivery</p>
                           </div>
                           <div class="single-pro-sideBar">
                           <i class="fa fa-archive"></i>
                           <p>Replacement</p>
                           </div>
                           <div class="single-pro-sideBar">
                           <i class="fa fa-truck"></i>
                           <p>Novelty Delivered</p>
                           </div>
                           <div class="single-pro-sideBar">
                           <i class="fa fa-user"></i>
                           <p>Secure Transection</p>
                           </div>
                        </div>
                      </div>
                 </section>


               <!-- Recommendation -->
                 <section id="product1" class="section-p1">
                 <div class="title-text">
                <p>BOOKS</p>
                <h1>You may also like</h1>
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
              <?php
    }
    else
    {
      echo "Product Not Found";
    }
?>
<?php
}
else
{
    echo "Something went Wrong";
}
?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./script.js"></script>

</body>
</html>