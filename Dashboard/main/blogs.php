<?php
require '../middleware/adminMiddleware.php';
include('header.php');

// Fetch and store all blogs as an array
$blogsResult = getAll("blogs");
$blogsArray = [];
while ($row = mysqli_fetch_assoc($blogsResult)) {
    $blogsArray[] = $row;
}

// Bubble Sort function to sort blogs by name
function bubbleSortBlogsByName($blogs) {
    $n = count($blogs);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if (strtolower($blogs[$j]['name']) > strtolower($blogs[$j + 1]['name'])) {
                $temp = $blogs[$j];
                $blogs[$j] = $blogs[$j + 1];
                $blogs[$j + 1] = $temp;
            }
        }
    }
    return $blogs;
}

// Function to perform case-insensitive substring search
function substringSearchBlog($blogs, $searchTerm) {
    $searchTerm = strtolower($searchTerm); // Convert search term to lowercase
    $matchingBlogs = [];

    // Loop through blogs and check if the search term is found anywhere in the name
    foreach ($blogs as $blog) {
        if (strpos(strtolower($blog['name']), $searchTerm) !== false) {
            $matchingBlogs[] = $blog;
        }
    }

    return $matchingBlogs;
}

// Sort the blogs array by name
$sortedBlogs = bubbleSortBlogsByName($blogsArray);

// Check if a search was submitted
$searchResult = null;
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchResult = substringSearchBlog($sortedBlogs, $searchTerm);
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Blogs</h4>
                    <!-- Search Form -->
                    <form method="POST" class="form-inline d-inline-flex">
                        <input type="text" name="search" placeholder="Search by Blog Name" class="form-control form-control-sm me-2" style="max-width: 180px;" required>
                        <button type="submit" class="btn btn-primary btn-sm" style="padding: 2px 8px;">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>
                </div>
                <div class="card-body" id="blogs_table">
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
                            if ($searchResult && count($searchResult) > 0) {
                                // Display matching search results
                                $count = 1;
                                foreach ($searchResult as $item) {
                                    ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><img src="./uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>"></td>
                                        <td><?= $item['status'] == '0' ? "Visible" : "Hidden"; ?></td>
                                        <td><a href="edit-blogs.php?id=<?= $item['id']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                        <td>
                                            <form action="./code.php" method="POST">
                                                <input type="hidden" name="blog_id" value="<?= $item['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete_blog_btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                            } else {
                                // If no search results or no search term, display all sorted blogs
                                $count = 1;
                                foreach ($sortedBlogs as $item) {
                                    ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><img src="./uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>"></td>
                                        <td><?= $item['status'] == '0' ? "Visible" : "Hidden"; ?></td>
                                        <td><a href="edit-blogs.php?id=<?= $item['id']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                        <td>
                                            <form action="./code.php" method="POST">
                                                <input type="hidden" name="blog_id" value="<?= $item['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete_blog_btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php if (!$searchResult && isset($_POST['search'])) { ?>
                        <p class="text-center text-muted">No records found for "<?= htmlspecialchars($_POST['search']); ?>"</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>   
<?php include('footer.php'); ?>
