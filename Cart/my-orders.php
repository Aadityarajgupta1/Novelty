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
        <li><a  href="../Home/Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a href="../Book/Book.php">BOOKS</a></li>
        <li><a href="../Contact/Contact.php">CONTACT</a></li>
        <li><a class="active" onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
      </ul>
      <!-- <img src="Images/profile.png" class="user-pic" onclick="toggleMenu()"> -->
          <div class="sub-menu-wrap" id="subMenu">
          <?php
          if(isset($_SESSION['auth']))
          {          
          ?>
            <div class="sub-menu">
              <div class="user-info">
                <img src="./Images/Novelty.png" alt="Image">
                <h4><?= $_SESSION['name']; ?></h4>
              </div>
              <?php
              }
              else
              {
                ?>
                <div class="sub-menu">
                <div class="user-info">
                <img src="./Images/Novelty.png" alt="Image">
                <h3>Hello Guest</h3>
              </div>
              <?php
              }
               ?>
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

           <!-- Heading -->
           <section id="page-header">

           <h2>#YourOrder</h2>
           <p>Your order is here.</p>

           </section>

           <!-- Cart -->
          <section id="cart" class="section-p1">
           
              <table width="100%">
             <thead>
              <tr>
                <td>S.N.</td>
                <td>Tracking No.</td>
                <td>Price</td>
                <td>Date</td>
                <td>View Details</td>
              </tr>
             </thead>
             <tbody class="product_data">
             <?php
               $orders = getOrders();

               if(mysqli_num_rows($orders) > 0)
               {
                $count = 1;
                // $totalPrice = 0;
                   foreach ($orders as $item)
                   {
                    ?>
                    <tr>
                    <td><?= $count ?></td>
                    <td><?= $item['tracking_no']; ?></td>
                    <td>Rs.<?= $item['total_price']; ?></td>
                    <td><?= $item['created_at']; ?></td>
                    <td><a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="normal">View Detail</a>
                                         
                    </tr>
                    <?php
                    $count++;
                    // $totalPrice +=  $item['selling_price'] * $item['prod_qty'];
                    }
                      
                }
               
               else
               {
                ?>
                <tr>
                <td>No order Yet</td>
                
                                     
                </tr>
                <?php
               }
           ?>
            </tbody>
              </table>
          </section>
          
          
          <!-- Newsletter -->
        <section id="newsletter" class="section-p1 section-m1">
              <div class="nestext">
                <h4>Sign up for Newsletter</h4>
                <p>Get E-mail updates about our latest shop and <span class="span2">special offers</span>.</p>
              </div>
              <form class="form" action="../Login/functions/newsLetter.php" method="POST">
               <input type="email" name="email" placeholder="Your Email Address">
              <button type="submit" name="news_btn" class="normal">Sign up</button>
               </form>
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
                <a href="./Cart/Cart.php">View cart</a>
                <a href="#">My Wishlist</a>
                <a href="./my-orders.php">Track my order</a>
                <a href="#">Help</a>
            </div>

            <div class="col install">
                <h4>Comming Soon</h4>
                <p>Install From App Store or Google Play</p>
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

        <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu()
    {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../Book/sbook.js"></script>
</body>
</html>