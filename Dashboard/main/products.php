<?php
require '../middleware/adminMiddleware.php';
include('header.php');

// Function to fetch all products from the database
function getAllProducts()
{
    $connection = mysqli_connect("localhost", "root", "", "novelty");
    $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);
    return $result;
}

// Bubble Sort function to sort products by name
function bubbleSortProductsByName($products)
{
    $n = count($products);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if (strtolower($products[$j]['name']) > strtolower($products[$j + 1]['name'])) {
                $temp = $products[$j];
                $products[$j] = $products[$j + 1];
                $products[$j + 1] = $temp;
            }
        }
    }
    return $products;
}

// Function to search products by name (first, last, or full name)
function searchProductsByName($products, $searchTerm)
{
    $results = [];
    $searchTerm = strtolower($searchTerm);
    
    foreach ($products as $product) {
        $name = strtolower($product['name']);
        // Check if search term is found in any part of the product name
        if (strpos($name, $searchTerm) !== false) {
            $results[] = $product;
        }
    }
    
    return $results;
}

// Fetch and store all products as an array
$productsResult = getAllProducts();
$productsArray = [];
while ($row = mysqli_fetch_assoc($productsResult)) {
    $productsArray[] = $row;
}

// Sort the products array by name
$sortedProducts = bubbleSortProductsByName($productsArray);

// Check if a search was submitted
$searchResults = [];
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchResults = searchProductsByName($sortedProducts, $searchTerm);
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Products</h4>
                    <!-- Search Form -->
                    <form method="POST" class="form-inline">
                        <input type="text" name="search" placeholder="Search by Name" class="form-control" required>
                        <button type="submit" class="btn btn-primary ml-2">Search</button>
                    </form>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th class="col-md-1">S.N.</th>
                                <th class="col-md-1">Name</th>
                                <th class="col-md-1">Image</th>
                                <th class="col-md-1">Status</th>
                                <th class="col-md-1">Edit</th>
                                <th class="col-md-1">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($searchResults) {
                                // Display search results
                                $count = 1;
                                foreach ($searchResults as $item) {
                                    ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><img src="./uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>"></td>
                                        <td><?= $item['status'] == '0' ? "Visible" : "Hidden"; ?></td>
                                        <td><a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><button type="button" class="btn btn-danger delete_product_btn" value="<?= $item['id']; ?>">Delete</button></td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                            } else {
                                // Display all products if no search or search yields no results
                                $count = 1;
                                foreach ($sortedProducts as $item) {
                                    ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><img src="./uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>"></td>
                                        <td><?= $item['status'] == '0' ? "Visible" : "Hidden"; ?></td>
                                        <td><a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><button type="button" class="btn btn-danger delete_product_btn" value="<?= $item['id']; ?>">Delete</button></td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php if (!$searchResults && isset($_POST['search'])) { ?>
                        <p class="text-center text-muted">No products found for "<?= htmlspecialchars($_POST['search']); ?>"</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
