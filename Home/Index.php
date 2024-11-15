<?php
session_start();
require '../Dashboard/configer/dbcon.php';
?>
<?php if (isset($_SESSION['message'])) { ?>
  <p class="alert"></p> <?= $_SESSION['message']; ?>
<?php
  unset($_SESSION['message']);
} ?>

<html>

<head>
  <title>Novelty.com</title>
  <link rel="stylesheet" href="Style.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet" />
  <!-- <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"/> -->


</head>

<body>


    <div class="navbar">
      
      <a href="./Index.php"><img src="./Images/logo.png" class="logo"></a>
      <ul>
        <li><a class="active" href="./Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a href="../Book/Book.php">BOOKS</a></li>
        <li><a href="../Contact/Contact.php">CONTACT</a></li>
        <li><a onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
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
    
    <div id="banner" class="background">

    <div class="content">
      <h1>WE ARE EVERYTHING YOU NEED</h1>
      <p>We offers a diverse range of books across multiple categories, providing a one-stop-shop for all your Literary Desires.<br> With a user-friendly interface and secure payment gateway, enjoy a seamless shopping experience<br> and excellent customer service.</p>

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
        <img src="./Images/1.jpg">
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
      <h1>New Arrivals</h1>
    </div>
    <div class="pro-container">

    <?php
    $query = "SELECT * FROM products WHERE status='0' ORDER BY id DESC LIMIT 8";
    $query_run = mysqli_query($con, $query);
    $check_products = mysqli_num_rows($query_run) > 0;

    if ($check_products) {
      while ($row = mysqli_fetch_array($query_run)) {
        $isInStock = isset($row['qty']) && $row['qty'] > 0;
    ?>
        <a href="../Book/sproduct.php?product=<?= $row['slug']; ?>">
          <div class="pro">
            <img src="../Dashboard/main/uploads/<?= $row['image']; ?>" alt="All Images">
            <div class="des">
              <span><?php echo $row['name']; ?></span>
              <h5><?php echo $row['author']; ?></h5>
              <div class="star">
                <i class="fa fa-book"></i>
                <i class="fa fa-book"></i>
                <i class="fa fa-book"></i>
                <i class="fa fa-book"></i>
                <i class="fa fa-book"></i>
              </div>
              <h4>Rs.<?php echo $row['selling_price']; ?></h4>
            </div>
            <?php if (!$isInStock) { ?>
              <span class="out-of-stock-label">Out of Stock</span>
            <?php } ?>
        </a>
        <?php if ($isInStock) { ?>
          <button class="addToCartBtn" value="<?= $row['id']; ?>"><i class="fa fa-shopping-cart"></i></button>
        <?php } ?>

      </div>

    <?php
      }
    } else {
      echo "No Products Found";
    }
    ?>
  </div>
</section>

<?php
if (isset($_SESSION['auth'])) {
    $userId = $_SESSION['auth_user']['user_id'];

    // Fetch purchased books
    $purchasedBooksQuery = "SELECT p.id, p.name, p.author FROM order_items oi
                            INNER JOIN products p ON oi.prod_id = p.id 
                            WHERE oi.user_id = '$userId' AND p.status = '0'";
    $purchasedBooksResult = mysqli_query($con, $purchasedBooksQuery);

    $purchasedBooks = [];
    while ($row = mysqli_fetch_assoc($purchasedBooksResult)) {
        $purchasedBooks[] = $row;
    }

    // Extract authors
    $authors = [];
    foreach ($purchasedBooks as $book) {
        $authors[] = $book['author'];
    }
    $authors = array_unique($authors);

    // Recommend books
    $recommendations = [];
    foreach ($authors as $author) {
        $authorBooksQuery = "SELECT * FROM products WHERE author = '$author' AND status = '0'";
        $authorBooksResult = mysqli_query($con, $authorBooksQuery);

        while ($book = mysqli_fetch_assoc($authorBooksResult)) {
            if (!in_array($book['id'], array_column($purchasedBooks, 'id'))) {
                $similarityScore = calculateCosineSimilarity($purchasedBooks, $book);
                $recommendations[] = [
                    'book' => $book,
                    'similarity' => $similarityScore
                ];
            }
        }
    }

    // Sort recommendations
    usort($recommendations, function ($a, $b) {
        return $b['similarity'] <=> $a['similarity'];
    });

    shuffle($recommendations);
    $recommendations = array_slice($recommendations, 0, 8);

    // Display recommendations
    if (count($recommendations) > 0) {
        ?>
        <section id="product1" class="section-p1">
            <div class="title-text">
                <p>Recommendation</p>
                <h1>Just for You</h1>
            </div>
            <div class="pro-container">
                <?php
                foreach ($recommendations as $rec) {
                    $book = $rec['book'];
                    $isInStock = isset($book['qty']) && $book['qty'] > 0; // Check if the book is in stock
                    ?>
                    <div class="pro">
                        <a href="../Book/sproduct.php?product=<?= htmlspecialchars($book['slug']); ?>">
                            <img src="../Dashboard/main/uploads/<?= htmlspecialchars($book['image']); ?>" alt="Book Image">
                            <div class="des">
                                <span><?= htmlspecialchars($book['name']); ?></span>
                                <h5><?= htmlspecialchars($book['author']); ?></h5>
                                <div class="star">
                                    <i class="fa fa-book"></i>
                                    <i class="fa fa-book"></i>
                                    <i class="fa fa-book"></i>
                                    <i class="fa fa-book"></i>
                                    <i class="fa fa-book"></i>
                                </div>
                                <h4>Rs. <?= htmlspecialchars($book['selling_price']); ?></h4>
                            </div>
                        </a>
                        <?php if (!$isInStock) { ?>
                            <span class="out-of-stock-label">Out of Stock</span>
                        <?php } else { ?>
                            <button class="addToCartBtn" value="<?= $book['id']; ?>"><i class="fa fa-shopping-cart"></i></button>
                        <?php } ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
        <?php
    } else {
        echo "<p>No Recommended Books Found</p>";
    }
}

// Function to calculate cosine similarity
function calculateCosineSimilarity($purchasedBooks, $book) {
    $userProfileVector = [];

    foreach ($purchasedBooks as $purchasedBook) {
        $userProfileVector[] = $purchasedBook['author'];
        $userProfileVector[] = $purchasedBook['name'];
    }

    $bookVector = [$book['author'], $book['name']];

    $dotProduct = 0;
    $userMagnitude = count($userProfileVector);
    $bookMagnitude = count($bookVector);

    foreach ($userProfileVector as $key => $value) {
        $dotProduct += (isset($bookVector[$key]) && $value === $bookVector[$key]) ? 1 : 0;
    }

    $userMagnitude = sqrt($userMagnitude);
    $bookMagnitude = sqrt($bookMagnitude);

    return ($userMagnitude == 0 || $bookMagnitude == 0) ? 0 : $dotProduct / ($userMagnitude * $bookMagnitude);
}
?>


 

  <!-- Action -->
  <section id="banner1" class="section-m1">
    <h4>!!OFFER OFFER OFFER!!</h4>
    <h2>Upto <span class="span3">30% Off</span> on all Books.</h2>
    <a href="../Book/Book.php">
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
    <form class="form" action="../Login/functions/newsLetter.php" method="POST">
      <input type="email" name="email" placeholder="Your Email Address" required>
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
      <a href="../About/about_us.php">About us</a>
      <a href="../Cart/checkout.php">Delivery Information</a>
      <a href="../Privacy/Privacy.php">Privacy policy</a>
      <!-- <a href="#">Terms & Conditions</a> -->
      <a href="../Contact/Contact.php">Contact us</a>
    </div>

    <div class="col">
      <h4>My Account</h4>
      <?php
      if (isset($_SESSION['auth'])) {
      ?>
        <a href="../Login/logout.php">Sign out</a>
      <?php
      } else {
      ?>
        <a href="../Login/login.php">Sign in</a>
      <?php
      }
      ?>
      <a href="..\Cart\Cart.php">View cart</a>
      <!-- <a href="#">My Wishlist</a> -->
      <a href="../Cart/my-orders.php">Track my order</a>
      <a href="../Help/Help.php">Help</a>
    </div>

    <div class="col install">
      <h4>Comming Soon</h4>
      <p>Install from App Store or Google Play</p>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  

</body>

</html>