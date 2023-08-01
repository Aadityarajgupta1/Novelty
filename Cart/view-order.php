<?php
include('../Login/functions/userMyfunctions.php'); 
include('../Dashboard/middleware/authenticate.php');

if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
    if(mysqli_num_rows($orderData) < 0)
    {
       ?>
      <h4>Something went wrong</h4>
      <?php
      die();
    }
}
else
{
    ?>
      <h4>Something went wrong</h4>
    <?php
    die();
}

$data = mysqli_fetch_array($orderData);
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
    <link rel="stylesheet" href="./view-order.css">
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


	    <div class="container">

		   <div class="left">
           <a href="./my-orders.php" alt=""><i class="bx bx-chevron-left data"></i>Back to order</a>
             
			<h3>Delivery Address</h3>
			<form>
				Full name
				<input type="text" name="name" value="<?= $data['name'];?>" disabled>
				Email
				<input type="text" name="email" value="<?= $data['email'];?>"disabled>

				Address
				<input type="text" name="address" value="<?= $data['address'];?>"disabled>
				
				Phone
				<input type="text" name="phone" value="<?= $data['phone'];?>"disabled>
				<div id="zip">
					<label>
						City
                        <input type="text" name="city" value="<?= $data['city'];?>"disabled>
                    </label>
                    <label class="f2">
                    Payment Mode
                        <input type="text" name="" value="<?= $data['payment_mode'] ?>"disabled>
                    </label>
				</div>
                
                        
                        
                        
			</form>
		</div>
		<div class="right">
			<h3>Order Details</h3>
            <form>
				 
                        <table>
                            <thead>
                            <tr>
                                <td><b>Image</b></td>
                                <td><b>Name</b></td>
                                <td><b>Price</b></td>
                                <td><b>Quantity</b></td>
                            </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                 $userId = $_SESSION['auth_user']['user_id'];
                                 $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.qty as quantity, oi.*, p.* FROM orders o, order_items oi,
                                 products p WHERE o.user_id='$userId' AND oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no'";

                                 $order_query_run = mysqli_query($con, $order_query);

                                 if(mysqli_num_rows($order_query_run) > 0)
                                 {
                                     foreach($order_query_run as $item)
                                     {
                                        ?>
                                        <tr>
                                            <td><img src="../Dashboard/main/uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>"></td>
                                            <td><?= $item['name'] ?></td>
                                            <td>Rs.<?= $item['price'] ?></td>
                                            <td>x<?= $item['quantity'] ?></td>
                                            
                                        </tr>
                     
                                        <?php
                                    }
                                 }
                                ?>
                                
                            </tbody>
                        </table>
               
                        <br><br>
                        
                        Total Price
                        <input type="text" name="" value="Rs.<?= $data['total_price'] ?>" disabled>
                        <br>
                        
                        <label class="f2">
						Status
						<input type="text" name="status" 
                        value="
                        <?php 
                           if($data['status'] == 0 )
                           {
                             echo "Under Process";
                           }
                           else if($data['status'] == 1 )
                           {
                             echo "Completed";
                           }
                           else if($data['status'] == 2 )
                           {
                             echo "Cancelled";
                           }
                        ?>"
                        disabled>
					</label>
                    
                        
                    </form>
		</div>
	</div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../Book/sbook.js"></script>
</body>
</html>