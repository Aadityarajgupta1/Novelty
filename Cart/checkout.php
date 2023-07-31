<?php
include('../Login/functions/userMyfunctions.php'); 
include('../Dashboard/middleware/authenticate.php');

if(isset($_POST['placeOrderBtn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
    $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

    if($name == "" || $email == ""|| $phone == "" || $address == "" || $city == "")
    {
        $_SESSION['message'] = "All Fields are Mandetory";
        echo('<script>alert("All data is required") </script>');
        // exit(0);
    }
    else{
        $userId = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price
        FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC";
        $query_run = mysqli_query($con, $query);

        $totalPrice = 0;
        foreach($query_run as $citem)
        {
           $totalPrice +=  $citem['selling_price'] * $citem['prod_qty'];
        }
        $tracking_no = "aadi".rand(1111,9999).substr($phone,2);

        $insert_query = "INSERT INTO orders (tracking_no, user_id,	name, email, phone,	address, city, total_price,
        payment_mode, payment_id) VALUES ('$tracking_no', '$userId', '$name', '$email', '$phone', '$address',
        '$city', '$totalPrice', '$payment_mode', '$payment_id')";

        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run)
        {
            $order_id = mysqli_insert_id($con);
            foreach($query_run as $citem)
            {
                $prod_id=  $citem['prod_id'];
                $prod_qty=  $citem['prod_qty'];
                $price=  $citem['selling_price'];
                $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price') ";
                $insert_items_query_run = mysqli_query($con, $insert_items_query);

                $product_query = "SELECT * FROM products WHERE id='$prod_id'";
                $product_query_run = mysqli_query($con, $insert_items_query);

                $product_query_run = mysqli_query($con, $product_query);
                $current_qty = $productData['qty'];

                $new_qty = $current_qty - $prod_qty;
                $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id'";
                $updateQty_query_run = mysqli_query($con, $updateQty_query);
            }

            $deleteCartQuery = "DELETE FROM carts WHERE user_id = '$userId'";
            $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);

            $_SESSION['message'] = "Order placed successfully";
            header('Location: ./my-orders.php');
            die();

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
    <link rel="stylesheet" href="./Checkout.css">
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

        

           <!-- Cart -->
           <div class="container">
           <div class="checkoutLayout">
        <div class="returnCart">
            <a href="../Cart/Cart.php"><i class="bx bx-chevron-left data"></i>Back to Carts</a>
            <h1>Cart Summary</h1>
            <div class="list">
                <?php
                $items = getCartItems();
                $count = 1;
                $totalPrice = 0;
                foreach ($items as $citem) {
                    ?>
                    <a href="../Book/sproduct.php?product=<?= $citem['name'] ?>">
                        <div class="item">
                            <img src="../Dashboard/main/uploads/<?= $citem['image'] ?>">
                            <div class="info">
                                <div class="name"><?= $citem['name'] ?></div>
                                <div class="price"></div>
                            </div>
                            <div class="quantity">x<?= $citem['prod_qty'] ?></div>
                            <div class="returnPrice">Rs.<?= $citem['selling_price'] ?></div>
                        </div>
                    </a>
                <?php
                    $count++;
                    $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                }
                ?>
            </div>
        </div>
        
    
        <div class="right">
            <h3>Billing Address</h3>
            <form  method="POST">
                <div class="group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" required>
                </div>
                <div class="sahii">
                <div class="group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" id="phone" required>
                </div>
                
                <div class="group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" required>
                </div>
                </div>
                <div class="return">
                    <div class="row">
                        <div>Shipping</div>
                        <div class="totalQuantity">Rs.0</div>
                    </div>
                    <div class="row">
                        <div>Total Price</div>
                        <div class="totalPrice">Rs.<?= $totalPrice ?></div>
                    </div>
                    <input type="hidden" name='payment_mode' value="COD">
                    <input type="hidden" name='payment_id' value="-">
                    <button type="submit" class="buttonCheckout" name="placeOrderBtn">Confirm your order</button>
                </div>
            </form>
        </div>
    </div>
</div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../Book/sbook.js"></script>
</body>
</html>