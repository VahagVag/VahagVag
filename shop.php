<?php
session_start();
include_once 'database.php';
use Database\DB;
$database = new DB();
$database->connect();

$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
if (isset($_SESSION['form_data'])) {
    $formData = $_SESSION['form_data'];
}
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}
$name = null;
$description = null;
$price = null;
$count = null;
$image = null;
$is_update = false;
$product_id = null;

if (isset($_GET['product'])){
    $query = "SELECT * FROM pruducts where id=".$_GET['product'];
    $result = $database->query($query);
    $row = $result->fetch_assoc();
    if(count($row) > 0){
        $is_update = true;
        $product_id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $count = $row['count'];
        $image = $row['image'];
    }
}

?>
<!DOCTYPE html>
<head xmlns="http://www.w3.org/1999/html">
    <title>Shop</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="shop.css">
</head>
<div>
    <form method="post" enctype="multipart/form-data" action="shop_functional.php">
        <h1>You can add your products</h1>
        </br>
        </br>
        </br>
        </br>
        <table class="products">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Count</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="name"
                           value="<?php echo isset($formData['name']) ? $formData['name'] : $name; ?>">
                    <?php if (isset($errors['name'])) { ?>

                        </br>
                        <span class="error" style="color: red;"><?php echo $errors['name'];
                            unset($_SESSION['errors']); ?></span>
                    <?php } ?>
                    </br>
                </td>
                <td><input type="text" name="description"
                           value="<?php echo isset($formData['description']) ? $formData['description'] : $description; ?>">
                    <?php if (isset($errors['description'])) { ?>
                        </br>
                        <span class="error" style="color: red;"><?php echo $errors['description'];
                            unset($_SESSION['errors']); ?></span>
                    <?php } ?>
                </td>
                <td><input type="number" name="price"
                           value="<?php echo isset($formData['price']) ? $formData['price'] : $price; ?>">
                    <?php if (isset($errors['price'])) { ?>
                        </br>
                        <span class="error" style="color: red;"><?php echo $errors['price'];
                            unset($_SESSION['errors']); ?></span>
                    <?php } ?>
                </td>
                <td><input type="number" name="count"
                           value="<?php echo isset($formData['count']) ? $formData['count'] : $count; ?>">
                    <?php if (isset($errors['count'])) { ?>
                        </br>
                        <span class="error" style="color: red;"><?php echo $errors['count'];
                            unset($_SESSION['errors']); ?></span>
                    <?php } ?>
                </td>
                <td><input type="file" name="image"></td>
                <input type="hidden" name="user" value="<?= $user ?>">
                <input type="hidden" name="product_image" value="<?=$image?>">
                <input type="hidden" name="product" value="<?=$product_id?>">
            </tr>
            <tbody>
        </table>
        <input type="submit" value="<?=$is_update? 'Update Product': 'Add product'?>" name="submit">
    </form>
    <h6><a href="welcome.php">If you want to go to profile page</a></h6></div>
</div>