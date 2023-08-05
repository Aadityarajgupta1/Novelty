<?php
include('../configer/dbcon.php');
include('../../Login/functions/myfunctions.php');


if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "./uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if ($name !== "" && $description !== "" && $image !== "")  
    {
        if (!validateFullName($name)) 
        {
            $_SESSION['message'] = "Please Enter a Valid name.";
            header('Location: ./add-category.php');
        } 
        else
        {
            $cate_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image)
            VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename')";

            $cate_query_run = mysqli_query($con, $cate_query);

            if($cate_query_run)
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            }
            else
            {
                redirect("add-category.php", "Something Went Wrong");
            }
            redirect("add-category.php", "Category updated Successful");

        }
    }
    else
    {
        redirect("add-category.php", "All Fields are mandetory");
    }
}
elseif(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['$old_image'];

    if($new_image != "")
    {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = "./uploads";

    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title',
    meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular',
    image='$update_filename' WHERE id='$category_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("./uploads/".$old_image))
            {
                unlink("./uploads/".$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Update Succesfully");
        
    }
    else
    {
        redirect("edit-category.php?id=$category_id", "Something went wrong");
    }
}
elseif(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("./uploads/".$image))
        {
            unlink("./uploads/".$image);
        }
        redirect("./category.php", "Category Deleted Successfully");
    }
    else
    {
        redirect("./category.php", "Something went Wrong");

    }
}
elseif(isset($_POST['add_product_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $page_count = $_POST['page_count'];
    $weight = $_POST['weight'];
    $isbn = $_POST['isbn'];
    $language = $_POST['language'];
    $author = $_POST['author'];
    $meta_title = $_POST['meta_title'];
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "./uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if($name != "" && $selling_price != "" && $description != "" && $image !== "")
    {
        if (!validateLanguage($language)) 
        {
            $_SESSION['message'] = "Please Enter a Valid language name.";
            header('Location: ./add-products.php');
        } 
        else
        {
        if (!validateFullName($name)) 
        {
            $_SESSION['message'] = "Please Enter a Valid name.";
            header('Location: ./add-products.php');
        } 
        else
        {
            if (!validateAuthor($author)) 
        {
            $_SESSION['message'] = "Please Enter a Valid author name.";
            header('Location: ./add-products.php');
        } 
        else
        { 
            if($qty >=1 )
            {    
                if($original_price >=1 )
                 {
                     if($selling_price >= $original_price )
                     {
                         if($weight >= 1)
                         {
                             $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price,
                             selling_price, qty, author, page_count, weight, isbn, language,meta_title, meta_description, meta_keywords, status, trending, image) 
                             VALUES ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price',
                             '$qty','$author','$page_count','$weight','$isbn','$language','$meta_title', '$meta_description', '$meta_keywords', '$status',
                             '$trending', '$filename')";

                             $product_query_run = mysqli_query($con, $product_query);

                             if($product_query_run)
                             {
                                 move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
                                 redirect("./add-products.php", "Product added Successfully");
                             }
                             else
                             {
                                 redirect("./add-products.php", "Something went Wrong");
                             }
                         }
                         else
                         {
                            redirect("./add-products.php", "Weight is not vallid");
                         }
                    }
                    else
                    {
                        redirect("./add-products.php", "Selling Price is not valid");
                    }
                }
                else
                {
                    redirect("./add-products.php", "Original Price is not valid");
                }
            }
            else
            {
                redirect("./add-products.php", "Quantity must be 1 or more.");
            }
        }
        }
    }
    }
    else
    {
        redirect("./add-products.php", "All Fields are Mandetory");
    }
}
elseif(isset($_POST['update_product_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $page_count = $_POST['page_count'];
    $weight = $_POST['weight'];
    $isbn = $_POST['isbn'];
    $language = $_POST['language'];
    $author = $_POST['author'];
    $meta_title = $_POST['meta_title'];
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $path = "./uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    
    $update_product_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', small_description='$small_description',
    description= '$description', original_price='$original_price', selling_price='$selling_price', qty= '$qty', page_count = '$page_count', weight= '$weight',
    isbn= '$isbn', language = '$language', author= '$author', meta_title= '$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', 
    trending='$trending', image='$update_filename' WHERE id='$product_id'";

    $update_product_query_run = mysqli_query($con, $update_product_query);

    if($update_product_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("./uploads/".$old_image))
            {
                unlink("./uploads/".$old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "Product Update Succesfully");
        
    }
    else
    {
        redirect("edit-product.php?id=$product_id", "Something went wrong");
    }
}
elseif(isset($_POST['delete_product_btn']))
{
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id'";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id='$product_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("./uploads/".$image))
        {
            unlink("./uploads/".$image);
        }
        // redirect("./products.php", "Product Deleted Successfully");
        echo 200;
    }
    else
    {
        // redirect("./products.php", "Something went Wrong");
        echo 500;
    }
}
elseif(isset($_POST['add_blog_btn']))
{
    $name = $_POST['name'];
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = isset($_POST['status']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "./uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if ($name !== "" && $slug !== "" && $description !== "" && $image !== "")  
    {
      $blog_query = "INSERT INTO blogs (name, description, status, image) 
      VALUES ('$name', '$description', '$status','$filename')";


      $blog_query_run = mysqli_query($con, $blog_query);

      if($blog_query_run)
      {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("./add-blogs.php", "blog added Successfully");
      }
      else
      {
        redirect("./add-blogs.php", "Something went Wrong");
      }
    }
    else
    {
        redirect("./add-blogs.php", "All Fields are Mandetory");

    }

}
elseif(isset($_POST['update_blog_btn']))
{
    $blog_id = $_POST['blog_id'];
    $name = $_POST['name'];
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = isset($_POST['status']) ? '1' : '0';

    $path = "./uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $update_blog_query = "UPDATE blogs SET name='$name', description= '$description', status='$status', image='$update_filename' WHERE id='$blog_id'";

    $update_blog_query_run = mysqli_query($con, $update_blog_query);

    if($update_blog_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("./uploads/".$old_image))
            {
                unlink("./uploads/".$old_image);
            }
        }
        redirect("edit-blogs.php?id=$blog_id", "blog Update Succesfully");
        
    }
    else
    {
        redirect("edit-blogs.php?id=$blog_id", "Something went wrong");
    }
}
elseif(isset($_POST['delete_blog_btn']))
{
    $blog_id = mysqli_real_escape_string($con, $_POST['blog_id']);

    $blog_query = "SELECT * FROM blogs WHERE id='$blog_id'";
    $blog_query_run = mysqli_query($con, $blog_query);
    $blog_data = mysqli_fetch_array($blog_query_run);
    $image = $blog_data['image'];

    $delete_query = "DELETE FROM blogs WHERE id='$blog_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("./uploads/".$image))
        {
            unlink("./uploads/".$image);
        }
        redirect("./blogs.php", "Blog Deleted Successfully");
    }
    else
    {
        redirect("./blogs.php", "Something went Wrong");

    }
}
elseif(isset($_POST['update_order_btn']))
{
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no'";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    redirect("orders.php", "Order status Updated Successfully");
}
else
{
    header('Location: ./admin.php');
}
?>
