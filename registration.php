<?php
include_once 'database.php';
use Database\DB;

$database = new DB();
$database->connect();

session_start();
$_SESSION['errors'] = [];
$_SESSION['form_data'] = [];
$_SESSION['invalid_credentials'] = null;
$_SESSION['name'] = null;
$_SESSION['password'] = null;
$_SESSION['password_repeat'] = null;
$_SESSION['repeat error'] = null;
$_SESSION['image'] = null;
$validations = array();
$formData = array();
function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!empty($_REQUEST)) {
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
}
if ($_POST['uname'] == null) {
    $validations['uname'] = 'uname is required';
} else {
    $formData['uname'] = $_POST['uname'];
}
if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
    $validations['uname'] = "Invalid email format";
} else {
    $sql = "SELECT * FROM users WHERE user_name = '$uname'";
    $result = $database->query($sql);
    $row = $result->fetch_assoc();
    if (!is_null($row)) {
        $validations['uname'] = "Username already exists";
    }
}
if ($_POST['password'] == null) {
    $validations['password'] = "Password is required";
} else {
    $formData['password'] = $_POST['password'];
}
if ($_POST['password'] != $_POST['password_repeat']) {
    $validations['password_repeat'] = 'password repeat is not match';
}

if (empty($_FILES["image"]["name"])) {
    $validations['image'] = 'attach image';
}
else{
    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
        $image = $targetFilePath;
    }else{
        $image = null;
    }
}


if (!empty($validations)) {
    $_SESSION['errors'] = $validations;
    header("Location: index.php");
    exit();
} else {
    $sql = "INSERT INTO users (user_name, password, image ) VALUES ('$uname', md5('$pass'),'$image')";
    if ($database->query($sql) === TRUE) {
        $_SESSION['name'] = $uname;
        $_SESSION['image'] = $image;
        $sql = "SELECT * FROM users WHERE user_name = '$uname'";
        $result = $database->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row['id'];
        header("Location: welcome.php");
        echo "New record created successfully";


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>;

