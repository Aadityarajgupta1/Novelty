<?php
require '../middleware/adminMiddleware.php';
include('header.php');

// Fetch and store all orders as an array using getOrderHistory function from myfunctions.php
$ordersResult = getOrderHistory();
$ordersArray = [];
while ($row = mysqli_fetch_assoc($ordersResult)) {
    $ordersArray[] = $row;
}

// Merge Sort function to sort orders by price
function mergeSortOrdersByPrice($orders, $orderType = 'asc')
{
    if (count($orders) <= 1) {
        return $orders;
    }

    $mid = count($orders) / 2;
    $left = array_slice($orders, 0, $mid);
    $right = array_slice($orders, $mid);

    $left = mergeSortOrdersByPrice($left, $orderType);
    $right = mergeSortOrdersByPrice($right, $orderType);

    return merge($left, $right, $orderType);
}

function merge($left, $right, $orderType)
{
    $sorted = [];
    while (count($left) > 0 && count($right) > 0) {
        if ($orderType === 'asc') {
            if ($left[0]['total_price'] <= $right[0]['total_price']) {
                $sorted[] = array_shift($left);
            } else {
                $sorted[] = array_shift($right);
            }
        } else {
            if ($left[0]['total_price'] >= $right[0]['total_price']) {
                $sorted[] = array_shift($left);
            } else {
                $sorted[] = array_shift($right);
            }
        }
    }
    return array_merge($sorted, $left, $right);
}

// Bubble Sort function to sort orders by tracking number
function bubbleSortOrdersByTracking($orders)
{
    $n = count($orders);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if (strtolower($orders[$j]['tracking_no']) > strtolower($orders[$j + 1]['tracking_no'])) {
                $temp = $orders[$j];
                $orders[$j] = $orders[$j + 1];
                $orders[$j + 1] = $temp;
            }
        }
    }
    return $orders;
}

// Sort function to sort orders by date
function sortOrdersByDate($orders, $orderType = 'asc')
{
    usort($orders, function($a, $b) use ($orderType) {
        if ($orderType === 'asc') {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        } else {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        }
    });
    return $orders;
}

// Binary search function to find an order by tracking number
function binarySearchOrder($orders, $searchTerm)
{
    $left = 0;
    $right = count($orders) - 1;

    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);
        $trackingNo = strtolower($orders[$mid]['tracking_no']);

        if ($trackingNo === strtolower($searchTerm)) {
            return $orders[$mid];
        } elseif ($trackingNo < strtolower($searchTerm)) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }
    return null;
}

// Sort the orders array by tracking number by default
$sortedOrders = bubbleSortOrdersByTracking($ordersArray);

// Check if a search or sort was submitted
$searchResult = null;
$sortType = 'asc';

if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchResult = binarySearchOrder($sortedOrders, $searchTerm);
} elseif (isset($_POST['sort'])) {
    $sortType = $_POST['sort'];
    if ($sortType == 'asc' || $sortType == 'desc') {
        $sortedOrders = mergeSortOrdersByPrice($ordersArray, $sortType);
    } elseif ($sortType == 'oldest' || $sortType == 'newest') {
        $sortedOrders = sortOrdersByDate($ordersArray, $sortType == 'oldest' ? 'asc' : 'desc');
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Order History</h4>
                    </div>
                    <!-- Search Form -->
                    <form method="POST" class="d-flex align-items-center">
                        <input type="text" name="search" placeholder="Search by Tracking #" class="form-control form-control-sm me-2" style="max-width: 200px;" required>
                        <button type="submit" class="btn btn-primary btn-sm mt-3" style="padding: 10px 15px;"><i class="fa fa-search me-1"></i></button>
                    </form>
                    <!-- Sort Dropdown -->
                    <form method="POST" class="ms-2">
                        <select name="sort" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="asc" <?= $sortType == 'asc' ? 'selected' : ''; ?>>Price: Low to High</option>
                            <option value="desc" <?= $sortType == 'desc' ? 'selected' : ''; ?>>Price: High to Low</option>
                            <option value="oldest" <?= $sortType == 'oldest' ? 'selected' : ''; ?>>Date: Oldest First</option>
                            <option value="newest" <?= $sortType == 'newest' ? 'selected' : ''; ?>>Date: Newest First</option>
                        </select>
                    </form>

                    <div>
                        <a href="orders.php" class="btn btn-warning">Back</a>
                    </div>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th class="col-md-1">Id</th>
                                <th class="col-md-2">User</th>
                                <th class="col-md-2">Tracking Number</th>
                                <th class="col-md-2">Price</th>
                                <th class="col-md-2">Date</th>
                                <th class="col-md-2">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($searchResult) {
                                // Display single search result
                                ?>
                                <tr>
                                    <td><?= $searchResult['id']; ?></td>
                                    <td><?= $searchResult['name']; ?></td>
                                    <td><?= $searchResult['tracking_no']; ?></td>
                                    <td><?= $searchResult['total_price']; ?></td>
                                    <td><?= $searchResult['created_at']; ?></td>
                                    <td>
                                        <a href="./view-order.php?t=<?= $searchResult['tracking_no']; ?>" class="btn btn-danger col-md-8">View Details</a>
                                    </td>
                                </tr>
                                <?php
                            } else {
                                // Display all sorted orders if no search or if search yields no results
                                foreach ($sortedOrders as $item) {
                                    ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['tracking_no']; ?></td>
                                        <td><?= $item['total_price']; ?></td>
                                        <td><?= $item['created_at']; ?></td>
                                        <td>
                                            <a href="./view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-danger col-md-8">View Details</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
<?php include('footer.php'); ?>
