<?php
require '../middleware/adminMiddleware.php';
include('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Products</h4>
                </div>
                <div class="card-body">
                    <form action="./code.php" method="POST" enctype="multipart/form-data">
                      <div class="row">
                      <div class="col-md-12">
                            <label class="mb-0" for="">Select Category</label>
                            <select name="category_id" class="form-select mb-2">
                            <option selected></option>
                                <?php
                                $categories = getAll("categories");

                                if(mysqli_num_rows($categories) > 0)
                                {
                                  foreach($categories as $item)
                                  {
                                    ?>
                                    <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>                                    
                                    <?php
                                  }
                                }
                                else
                                {
                                    echo "No Category Available";
                                }  
                                ?>                         
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0" for="">Name</label>
                            <input type="text" name="name" class="form-control mb-2">
                        </div>
                        <div class="col-md-6">
                                <label class="mb-0" for="">Author</label>
                                <input type="text" name="author" class="form-control mb-2">
                            </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Small Description</label>
                            <textarea rows="3" name="description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Description</label>
                            <textarea rows="3" name="small_description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0" for="">Original Price</label>
                            <input type="text" name="original_price" class="form-control mb-2">
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0" for="">Selling Price</label>
                            <input type="text" name="selling_price" class="form-control mb-2">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Upload Image</label>
                            <input type="file" name="image" class="form-control mb-2">
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0" for="">Quantity</label>
                            <input type="number" name="qty" class="form-control mb-2">
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0" for="">Slug</label>
                            <input type="text" name="slug" class="form-control mb-2">
                        </div>   
                        <div class="col-md-3">
                            <label class="mb-0" for="">Status</label><br>
                            <input type="checkbox" name="status">
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0" for="">Trending</label><br>
                            <input type="checkbox" name="trending">
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0" for="">Page Count</label>
                            <input type="text" name="page_count" class="form-control mb-2">
                        </div> 
                        <div class="col-md-3">
                            <label class="mb-0" for="">Weight</label>
                            <input type="text" name="weight" class="form-control mb-2">
                        </div> 
                        <div class="col-md-3">
                            <label class="mb-0" for="">ISBN</label>
                            <input type="text" name="isbn" class="form-control mb-2">
                        </div> 
                        <div class="col-md-3">
                            <label class="mb-0" for="">Language</label>
                            <input type="text" name="language" class="form-control mb-2">
                        </div>                      
                        
                        <div class="col-md-12">
                            <label class="mb-0" for="">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control mb-2">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Meta Description</label>
                            <textarea rows="3" name="meta_description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Meta Keywords</label>
                            <textarea rows="3" name="meta_keywords" class="form-control mb-2"></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                        </div>
                     </div>
                   </form>
                </div>
            </div>
        </div>

    </div>
</div>    
<?php include('footer.php');?>