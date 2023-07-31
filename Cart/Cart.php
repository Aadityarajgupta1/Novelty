<?php
include('../Login/functions/userMyfunctions.php'); 
include('../Dashboard/middleware/authenticate.php');
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
    <link rel="stylesheet" href="./Cart.css">
</head>
<body>
           <div class="navbar">
               <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
                <ul>
                <li class="act"><a href="../Home/Index.php">HOME</a></li>
                <li><a href="../Blog/Blog.php">BLOG</a></li>
                <li><a href="../Book/Book.php">BOOKS</a></li>
                <li><a href="../Contact/Contact.php">CONTACT</a></li>
                <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <li><a href="../Login/logout.php">Logout</a></li>
                  <?php
                }
                else
                {
                  ?>
                  <li><a href="../Login/login.php">Login</a></li>
                  <?php
                }
                ?>
                <li><a class="active" href="./Cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>

           </div>

           <!-- Heading -->
           <section id="page-header">

           <h2>#Cart</h2>
           <p>Reading opens doors to infinite knowledge, sparks boundless imagination, and nurtures the soul.</p>

           </section>

           <!-- Cart -->
           <section id="cart" class="section-p1">
           <div id="myReload">
              <table width="100%">
            <thead>
              <tr>
                <td>S.N.</td>
                <td>Product</td>
                <td>Image</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Remove</td>
              </tr>
            </thead>
            
            <?php $items = getCartItems(); 
                $count = 1;
                $totalPrice = 0;
                foreach($items as $citem)
                {
               ?>
            <tbody class="product_data">
              <tr>
              <td><?= $count ?></td>
                <td><a href="../Book/sproduct.php?product=<?=$citem['name']?>"><?= $citem['name']?></a></td>               
                <td><a href="../Book/sproduct.php?product=<?=$citem['name']?>"><img src="../Dashboard/main/uploads/<?= $citem['image']?>" alt="Image"></a></td>                
                <td>Rs.<?= $citem['selling_price']?>
                <input type="hidden" class="prodId" value="<?= $citem['prod_id']?>"></td>
                      <td><div class="row1">
                      <button class="minus decrement-btn updateQty"><i class="bx bx-chevron-left"></i></button>
                      <input type="text" class="input-qty" value="<?= $citem['prod_qty']?>" disabled>
                      <button class="plus increment-btn updateQty"><i class="bx bx-chevron-right"></i></button>
                      </div></td>
                
                <td><button class="deleteItem" value="<?= $citem['cid']?>"><i class="fa fa-times-circle"></i></button></td>
              </tr>
            </tbody>
            
            <?php 
            $count++;
            $totalPrice +=  $citem['selling_price'] * $citem['prod_qty'];
                }
          ?>
          
                
          </table>
          

          </section>
             
          <section id="cart-add" class="section-p1">
            <div id="coupon">
              <h3>Apply coupon</h3>
              <div>
                <input type="text" placeholder="Enter Your coupon">
                <button class="normal">Apply</button>
              </div>
            </div>

            <div id="subtotal">
              <h3>Cart Total</h3>
              <table>
                <tr>
                  <td>Cart Subtotal</td>
                  <td>Rs.<?= $totalPrice ?></td>
                </tr>
                <tr>
                  <td>Shipping</td>
                  <td>Free</td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td><strong>Rs.<?= $totalPrice ?></strong></td>
                </tr>
              </table>
              <button><a href="./checkout.php" class="normal ">Proceed to checkout</a></button>
            </div>
          </section>
          </div>
          
          
          
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
                <a href="C:\Users\user\Desktop\Documents\Matri\Novelty\Webpage\Cart\Cart.html">View cart</a>
                <a href="#">My Wishlist</a>
                <a href="./my-orders.php">Track my order</a>
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
        <script src="../Book/sbook.js"></script>
</body>
</html>