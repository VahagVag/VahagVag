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
$validations = array();
$formData = array();
$uname = validate($_POST['uname']);
$password = validate($_POST['password']);
$_SESSION['image'] = null;
$url = "loginpage.php";

if ($_POST['uname'] == null) {
    $validations['uname'] = 'Username is required';
} else {
    $formData['uname'] = $_POST['uname'];
}
if ($_POST['password'] == null) {
    $validations['password'] = 'Password is required';
} else {
    $formData['password'] = $_POST['password'];
}
$_SESSION['form_data'] = $formData;
function validate($field)
{
    $field = trim($field);
    $field = stripcslashes($field);
    $field = htmlspecialchars($field);
    return $field;
}

if (!empty($validations)) {
    $_SESSION['errors'] = $validations;
    header("Location: " . $url);
    exit();
}

$result = null;

if (!empty($uname)) {
    $sql = "SELECT * FROM users WHERE user_name = '$uname' AND password = md5('$password')";
    $result = $database->query($sql);
    $row = $result->fetch_assoc();

    if (!$row){
        $_SESSION['invalid_credentials'] = 'Invalid credentials';
        header("Location: loginpage.php");
        exit();
    }
    $_SESSION['image'] = $row['image'];

}

if (!$result) {
    $_SESSION['invalid_credentials'] = 'Invalid credentials';
    header("Location: login.php");
    exit();

}
else {
    $_SESSION['name'] = $uname;
    $_SESSION['form_data'] = [];
    $_SESSION['user'] = $row['id'];
    header('Location: welcome.php?pruduct'.$r);
}

exit();
?>;
