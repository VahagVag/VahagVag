<?php
session_start();
$formData = array();
if (isset($_SESSION['form_data'])) {
    $formData = $_SESSION['form_data'];
}
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Registration with image</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
<form action="registration.php" method="post" enctype="multipart/form-data">
    <h2>Registration with image</h2>

    <div>
        <label>User Name</label>
        </br>
        <input type="text" name="uname" placeholder="User Name"
               value="<?php echo isset($formData['uname']) ? $formData['uname'] : ''; ?>">
        <?php if (isset($errors['uname'])) { ?>
            </br>
            <span class="error" style="color: red;"><?php echo $errors['uname'];
                unset($_SESSION['errors']); ?></span>
        <?php } ?>
    </div>
    <div>
        <label>Password</label>
        </br>
        <input type="password" name="password" placeholder="pass"
               value="<?php echo isset($formData['pass']) ? $formData['pass'] : ''; ?>">
        <?php if (isset($errors['password'])) { ?>
            </br>
            <span class="error" style="color: red;"><?php echo $errors['password'];
                unset($_SESSION['errors']); ?></span>
        <?php } ?>

        </br>
        <label>Password_repeat</label>
        </br>
        <input type="password" name="password_repeat" placeholder="password_repeat"
               value="<?php echo isset($formData['password_repeat']) ? $formData['password_repeat'] : ''; ?>">
        <?php if (isset($errors['password_repeat'])) { ?>
            </br>
            </br>
            <span class="error" style="color: red;"><?php echo $errors['password_repeat'];
                unset($_SESSION['errors']); ?></span>
        <?php } ?>
    </div>
    <?php if (isset($_SESSION['invalid_credentials'])) { ?><?php echo $_SESSION['errors']; ?>;
    <?php } ?>
    Attach image
    </br>
    <div>
        <input type="file" name="image">
        <?php if (isset($errors['image'])) { ?>
            </br>
            <span class="error" style="color: red;"><?php echo $errors['image'];
                unset($_SESSION['errors']); ?></span>
        <?php } ?>
    </div>
</br>
    <div>
        <button type="submit">Registration</button>
    </div>
</br>
    <div><a href="loginpage.php">If you have an acount</a></div>
</form>

