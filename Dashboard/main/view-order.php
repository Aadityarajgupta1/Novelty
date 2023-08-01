<?php
require '../middleware/adminMiddleware.php';
include('header.php');

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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h4>Orders</h4>
            </div>
            <div class="card-body" id="">
                <div class="card"></div>
            </div>
         </div>
    </div>
</div>
