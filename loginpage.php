<?php
session_start();
$formData = array();
if (isset($_SESSION['form_data'])) {
    $formData = $_SESSION['form_data'];
}
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}
if (isset($_SESSION['name'])){
    header("Location: welcome.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="loginpage.css">
</head>
<body>
<form action="login_function.php" method="post">
    <h2>Login</h2>
    <div>
        <label>User Name</label>
        </br>
        <input type="text" name="uname" placeholder="User Name"
               value="<?php echo isset($formData['uname']) ? $formData['uname'] : ''; ?>">
        <?php if (isset($errors['uname'])) { ?>
            </br>
            <span class="error" style="color: red;"><?php echo $errors['uname'];unset($_SESSION['errors']); ?></span>
        <?php } ?>
    </div>
    <div>
        <label>Password</label>
        </br>
        <input type="password" name="password" placeholder="Password"
               value="<?php echo isset($formData['password']) ? $formData['password'] : ''; ?>">
        <?php if (isset($errors['password'])) { ?>
            </br>
            <span class="error" style="color: red;"><?php echo $errors['password'];unset($_SESSION['errors']) ?></span>
        <?php } ?>
    </div>
    <?php if (isset($_SESSION['invalid_credentials'])){ ?>
    <p style="color: red;"><?php echo $_SESSION['invalid_credentials']; ?><p>
        <?php } ?>
    <div>
        <button type="submit">Sign IN</button>
    </div>
    <div><div><a href="index.php">If you have not acount</a></div></div>
</form>

</body>
</html>
</html>
