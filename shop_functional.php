<?php
include_once 'database.php';
use Database\DB;
$database = new DB();
$database->connect();
$_SESSION['errors'] = [];
$_SESSION['form_data'] = [];
$_SESSION['description'] = null;
$_SESSION['price'] = null;
$_SESSION['count'] = null;
$formData = array();
$validations = array();
function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$user_id = $_POST['user'];

$targetDir = "uploads/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (!empty($_REQUEST)) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $count = validate($_POST['count']);
}
$image = null;
if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
    $image = $targetFilePath;
} else {
    $image = $_POST['product_image'];
}
if ($_POST['name'] == null) {
    $validations['name'] = "name is required";
} else {
    $formData['name'] = $_POST['name'];
}
if ($_POST['description'] == null) {
    $validations['description'] = "description is required";
} else {
    $formData['description'] = $_POST['description'];
}
if ($_POST['price'] == null) {
    $validations['price'] = "price is required";
} else {
    $formData['price'] = $_POST['price'];
}
if ($_POST['count'] == null) {
    $validations['count'] = "count is required";
} else {
    $formData['count'] = $_POST['count'];
}

if (empty($_FILES["image"]["name"])) {
    if ($image == '' or $image == null) {
        $validations['image'] = 'attach image';
    }

} else {
    $_FILES['image'] = $_POST['image'];
}


if (!empty($validations)) {
    $_SESSION['errors'] = $validations;
    $url = 'shop.php';
    if ($_POST['submit'] == 'Update Product') {
        $url = 'shop.php?product=' . $_POST['product'];
    }

    header("Location: " . $url);
    exit();

}
if ($_POST['submit'] == 'Update Product') {
    $sql = "UPDATE pruducts SET name = '$name',
                    description = '$description',
                    price = '$price',
                    image = '$image',
                    count = '$count',
                    user_id = '$user_id'
                    WHERE id=" . $_POST['product'];
} else {
    $sql = "INSERT INTO pruducts (name, description, price,image,count,user_id ) VALUES ('$name', '$description','$price','$image','$count',$user_id)";
}

if ($database->query($sql) === TRUE) {
    header("Location: welcome.php");
} else {
    var_dump($database->error);
}
?>
