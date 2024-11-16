<?php
include('../Login/functions/userMyfunctions.php');

// Fetching all books from the database
$query = "SELECT * FROM products WHERE status='0'";
$query_run = mysqli_query($con, $query);
$books = [];
while ($row = mysqli_fetch_array($query_run)) {
    $books[] = $row; // Store books in an array
}

$searchResults = $books; // Initialize with all books, so we show all books initially

// Merge Sort function to sort books by price
function mergeSort($array, $order = 'asc') {
    if (count($array) <= 1) {
        return $array;
    }

    $middle = floor(count($array) / 2);
    $left = array_slice($array, 0, $middle);
    $right = array_slice($array, $middle);

    $left = mergeSort($left, $order);
    $right = mergeSort($right, $order);

    return merge($left, $right, $order);
}

function merge($left, $right, $order) {
    $result = [];
    while (count($left) > 0 && count($right) > 0) {
        if (
            ($order === 'asc' && $left[0]['selling_price'] <= $right[0]['selling_price']) ||
            ($order === 'desc' && $left[0]['selling_price'] > $right[0]['selling_price'])
        ) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }
    return array_merge($result, $left, $right);
}

// Function to get popularity-based books with heuristic adjustments
// Check if the user is logged in
function getPopularBooksWithHeuristic($con, $userPreferences) {
  // Query to get the count of each product purchase from the order_items table
  $query = "SELECT prod_id, COUNT(*) AS purchase_count 
            FROM order_items 
            GROUP BY prod_id 
            ORDER BY purchase_count DESC";
  $result = mysqli_query($con, $query);

  if (!$result) {
      die('Error: ' . mysqli_error($con)); // Handle query failure
  }

  $popularBooks = [];
  while ($row = mysqli_fetch_assoc($result)) {
      // Get the book details for the prod_id
      $productQuery = "SELECT * FROM products WHERE id = " . $row['prod_id'];
      $productResult = mysqli_query($con, $productQuery);

      if ($productRow = mysqli_fetch_assoc($productResult)) {
          // Calculate the heuristic score for this product based on purchase count
          $heuristicScore = $row['purchase_count'];

          // Adjust the score based on user preferences (e.g., preferred authors)
          if (in_array($productRow['author'], $userPreferences['preferred_authors'])) {
              $heuristicScore += 5; // Boost score for preferred authors
          }

          // Add the heuristic score to the product row
          $productRow['heuristic_score'] = $heuristicScore;
          $popularBooks[] = $productRow;
      }
  }

  // Sort books based on heuristic score (higher score is better)
  usort($popularBooks, function ($a, $b) {
      return $b['heuristic_score'] <=> $a['heuristic_score'];
  });

  return $popularBooks;
}

// Function to get popular books without user preferences (just by popularity)
function getPopularBooksWithoutPreferences($con) {
  // Query to get the count of each product purchase from the order_items table
  $query = "SELECT prod_id, COUNT(*) AS purchase_count 
            FROM order_items 
            GROUP BY prod_id 
            ORDER BY purchase_count DESC";
  $result = mysqli_query($con, $query);

  if (!$result) {
      die('Error: ' . mysqli_error($con)); // Handle query failure
  }

  $popularBooks = [];
  while ($row = mysqli_fetch_assoc($result)) {
      // Get the book details for the prod_id
      $productQuery = "SELECT * FROM products WHERE id = " . $row['prod_id'];
      $productResult = mysqli_query($con, $productQuery);

      if ($productRow = mysqli_fetch_assoc($productResult)) {
          // Calculate the popularity score for this product based on purchase count
          $popularityScore = $row['purchase_count'];

          // Add the popularity score to the product row
          $productRow['popularity_score'] = $popularityScore;
          $popularBooks[] = $productRow;
      }
  }

  // Sort books based on popularity score (higher score is better)
  usort($popularBooks, function ($a, $b) {
      return $b['popularity_score'] <=> $a['popularity_score'];
  });

  return $popularBooks;
}

// Check if the user is logged in
if (isset($_SESSION['id'])) {
  $userId = $_SESSION['id']; // Use session user ID

  // Fetch purchased books
  $query = "SELECT DISTINCT prod_id 
            FROM order_items 
            WHERE user_id = $userId";
  $query_result = mysqli_query($con, $query);

  if (!$query_result) {
    die('Error: ' . mysqli_error($con));
  }

  $purchasedBookIds = [];
  while ($row = mysqli_fetch_assoc($query_result)) {
    $purchasedBookIds[] = $row['prod_id']; // Store the product IDs of the purchased books
  }

  // Fetch the authors of the books the user has purchased
  $authors = [];
  foreach ($purchasedBookIds as $bookId) {
    $authorQuery = "SELECT author FROM products WHERE id = $bookId";
    $authorResult = mysqli_query($con, $authorQuery);

    if ($authorRow = mysqli_fetch_assoc($authorResult)) {
        $authors[] = $authorRow['author']; // Add the author to the list
    }
  }

  // Filter the books by the user's past purchases (authors they bought books from)
  $uniqueAuthors = array_unique($authors); // Remove duplicates
  $userPreferences = ['preferred_authors' => $uniqueAuthors]; // User preferences based on past authors

  // Fetch the popular books with user preferences (heuristic-based)
  $popularBooks = getPopularBooksWithHeuristic($con, $userPreferences);
} else {
  // If user is not logged in, fetch popular books without user preferences
  $popularBooks = getPopularBooksWithoutPreferences($con);
}

// Display the sorted popular books
foreach ($popularBooks as $book) {
    // Example of displaying book details
    // echo 'Book Name: ' . $book['name'] . ' - Author: ' . $book['author'] . ' - Heuristic Score: ' . $book['heuristic_score'] . '<br>';
}



// Perform search and sorting when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Search functionality
    if (isset($_POST['query'])) {
        $searchQuery = $_POST['query']; // Get the search query
        
        // Perform linear search: filter books that match the query in name, author, or ISBN
        $searchResults = [];
        foreach ($books as $book) {
            if (
                stripos($book['name'], $searchQuery) !== false || // Search by name
                stripos($book['author'], $searchQuery) !== false || // Search by author
                stripos($book['isbn'], $searchQuery) !== false // Search by ISBN
            ) {
                $searchResults[] = $book; // Add matching books to results
            }
        }
    }

    // Sorting functionality
    if (isset($_POST['sortOrder'])) {
        $sortOrder = $_POST['sortOrder']; // Get the sorting preference
        if ($sortOrder === 'lowToHigh') {
            $searchResults = mergeSort($searchResults, 'asc');
        } elseif ($sortOrder === 'highToLow') {
            $searchResults = mergeSort($searchResults, 'desc');
        } elseif ($sortOrder === 'popularity') {
            // Example user preferences (this can come from the session or user profile)
            $userPreferences = [
                'preferred_authors' => ['Author1', 'Author2'], // Example preferred authors
            ];
            
            // Fetch the popular books based on heuristic score
            $searchResults = getPopularBooksWithHeuristic($con, $userPreferences);
        }
    }
}
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
<>
<div class="navbar">
      <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
      <!-- <div>
      <div class="box">
        <input type="text" name="query" id="live_search" placeholder="Search..">
        <button  type="submit"><i class="fa fa-search"></i></button>
      </div>
      <div id="searchresult"></div>
      </div> -->

      <ul>
        <li><a  href="../Home/Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a class="active" href="../Book/Book.php">BOOKS</a></li>
        <li><a href="../Contact/Contact.php">CONTACT</a></li>
        <li><a  onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
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

           <h2>#RealityEscape</h2>
           <p>Reading opens doors to infinite knowledge, sparks boundless imagination, and nurtures the soul.</p>

           </section>
           
          <!-- Categories -->
            <div class="sear">
              <form class="box" method="POST">
              <input type="text" name="query" id="live_search" placeholder="Search..">
              <button  type="submit"><i class="fa fa-search"></i></button>
              </form>

              <div class="select-menu">
               <div class="select-btn">
                  <span class="sBtn-text">Categories</span>
                  <i class="bx bx-chevron-down"></i>
               </div>            
               <div>
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
            </div>
                  <!-- Price -->
                  <div class="select-menu1">
    <form method="POST">
        <div class="select-btn1">
            <span class="sBtn-text1">Preference</span>
            <i class="bx bx-chevron-down"></i>
        </div>
        <div>
            <ul class="options1">
            <li class="option1">
                    <button type="submit" name="sortOrder" value="popularity">
                        <i class="bx bx-book"></i>
                        <span class="option-text active">Popularity</span>
                    </button>
                </li>
                <li class="option1">
                    <button type="submit" name="sortOrder" value="lowToHigh">
                        <i class="bx bx-book"></i>
                        <span class="option-text active">Low to High</span>
                    </button>
                </li>
                <li class="option1">
                    <button type="submit" name="sortOrder" value="highToLow">
                        <i class="bx bx-book"></i>
                        <span class="option-text active">High to Low</span>
                    </button>
                </li>
            </ul>
        </div>
    </form>
</div>
</div>
           
          <!-- All Book -->
          <section id="product1" class="section-p1">
            <div class="pro-container">
                  <?php 
                    if(!empty($searchResults)) 
                    {
                      foreach ($searchResults as $book) 
                    {
                  ?>
                    <a href="./sproduct.php?product=<?= $book['slug']; ?>">
                      <div class="pro">
                        <img src="../Dashboard/main/uploads/<?= $book['image']; ?>" alt="Book Image">
                        <br>
                        <div class="des">
                          <span><?= $book['name']; ?></span>
                          <h5><?= $book['author']; ?></h5>
                          <div class="star">
                                <i class="fa fa-book"></i>
                                <i class="fa fa-book"></i>
                                <i class="fa fa-book"></i>
                                <i class="fa fa-book"></i>
                                <i class="fa fa-book"></i>
                          </div>
                          <h4>Rs.<?= $book['selling_price']; ?></h4>
                        
                      </div>
                    </a>
                    <!-- <button class="addToCartBtn" value="<?= $book['id']; ?>"><i class="fa fa-shopping-cart"></i></button> -->
                    <?php if ($book['qty'] > 0) { ?>
                        <button class="addToCartBtn" value="<?=$book['id'];?>"><i class="fa fa-shopping-cart"></i></button>
                    <?php } else { ?>
                        <span class="out-of-stock">Out of Stock</span>
                    <?php } ?>
                    </div>
                  <?php
                }
              }
              else
              {
                echo "Search not found";
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
              <form class="form" action="../Login/functions/newsLetter.php" method="POST">
              <input type="email" name="email" placeholder="Your Email Address">
              <button type="submit" name="news_btn" class="normal">Subscribe</button>
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

              <!-- Footer  -->
            <div class="col">
                <h4>About</h4>
                <a href="../About/about_us.php">About us</a>
                <a href="../Cart/Checkout.php">Delivery Information</a>
                <a href="../Privacy/Privacy.php">Privacy policy</a>
                <!-- <a href="#">Terms & Conditions</a> -->
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
                <!-- <a href="#">My Wishlist</a> -->
                <a href="../Cart/my-orders.php">Track my order</a>
                <a href="../Help/Help.php">Help</a>
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./script.js"></script>
        <script src="./Book.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript">
          $(document).ready(function(){
            $("#live_search").keyup(function(){
                var input = $(this).val();
                //alert(input);
                if(input != "")
                {
                  $.ajax({
                    url:"./livesearch.php",
                    method: "POST",
                    data:{input:input},

                    success:function(data){
                      $("#searchresult").html(data);
                    }

                  });
                }
                else
                {
                  $("#searchresult").css("display","none");
                }
            });
          });
        </script>

</body>
</html>