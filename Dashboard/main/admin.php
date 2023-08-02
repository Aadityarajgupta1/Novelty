<?php 
require '../middleware/adminMiddleware.php';
require 'header.php';
?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                Total Users
                <?php
                    $dash_user_query = "SELECT * FROM users";
                    $dash_user_query_run = mysqli_query($con, $dash_user_query);

                    if($user_total = mysqli_num_rows($dash_user_query_run))
                    {
                        echo '<h4 class="mb-0">'.$user_total.'</h4>';
                    }
                    else
                    {
                         echo '<h4 class="mb-0">No Data</h4>';
                    }
                ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Total blogs
            <?php
                    $dash_blog_query = "SELECT * FROM blogs";
                    $dash_blog_query_run = mysqli_query($con, $dash_blog_query);

                    if($blog_total = mysqli_num_rows($dash_blog_query_run))
                    {
                        echo '<h4 class="mb-0">'.$blog_total.'</h4>';
                    }
                    else
                    {
                         echo '<h4 class="mb-0">No Data</h4>';
                    }
                ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="./blogs.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">Total Categories
            <?php
                    $dash_category_query = "SELECT * FROM categories";
                    $dash_category_query_run = mysqli_query($con, $dash_category_query);

                    if($category_total = mysqli_num_rows($dash_category_query_run))
                    {
                        echo '<h4 class="mb-0">'.$category_total.'</h4>';
                    }
                    else
                    {
                         echo '<h4 class="mb-0">No Data</h4>';
                    }
                ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="./category.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mr-4">
        <div class="card bg-danger text-white mb-4 ">
            <div class="card-body">Total Products
            <?php
                    $dash_product_query = "SELECT * FROM products";
                    $dash_product_query_run = mysqli_query($con, $dash_product_query);

                    if($product_total = mysqli_num_rows($dash_product_query_run))
                    {
                        echo '<h4 class="mb-0">'.$product_total.'</h4>';
                    }
                    else
                    {
                         echo '<h4 class="mb-0">No Data</h4>';
                    }
                ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="./products.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped ">
        <thead class="align-items-center justify-content-between">
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody class="align-items-center justify-content-between">
            <?php
             $query = "SELECT * FROM users ORDER BY id DESC";
             $query_run = mysqli_query($con, $query);

             if(mysqli_num_rows($query_run) > 0)
             {
                $count=1;
                 foreach($query_run as $row)
                 {
                    ?>
                      <tr>
                       <td><?= $count ?></td>
                       <td><?= $row['name']; ?></td>
                       <td><?= $row['email']; ?></td>
                       <td><?= $row['phone']; ?></td>
                       <td> <?= $row['role_as'] == 0? "User":"Admin" ?></td>
                      </tr>
                    <?php
                    $count++;
                 }
             }
             else
             {
                ?>
                <tr>
                <td>No Data Found</td>   
                </tr>
                <?php
             }
            ?>
            
        </tbody>
    </table>
</div>



<?php include('footer.php');?>

<div class="background"><p></p></div>