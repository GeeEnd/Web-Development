<?php

session_start();

require 'include/config.php';

$email = $_GET['email'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Validate the passwords
    if ($newPassword !== $confirmPassword) {
        echo '<script>alert("Passwords do not match!");</script>';
    } else {
        // Hash the new password before updating the database
        $hashedPassword = md5($newPassword);

        // Update the user's password in the database
        $updatePasswordQuery = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
        if ($conn->query($updatePasswordQuery) === TRUE) {
            echo '<script>
            alert("Password changed successfully!");
            window.location.href = "login.php";
          </script>';
             exit();
        } else {
            echo '<script>alert("Error updating password: ' . $conn->error . '");</script>';
        }
    }
}

// Fetch user details based on the provided email
$selectUserQuery = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo '<script>alert("User not found!"); window.location.href = "login.php";</script>';
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Change Password</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icons8-user-64.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
         
		.login-right{
			background: linear-gradient(to bottom, #3498db, #000000);
		}
		.login-left{
			background: linear-gradient(to bottom, #3498db, #000000);
		}
		.login-box{
			background: linear-gradient(to bottom, #000000, #2ecc71);
		}
		body {
			background-color: #f4f4f4; /* Light gray color */
		}
        .card{
            background: linear-gradient(to bottom, #008080, #000000) !important; /* Dark cyan to black */
            
  height: auto;
  box: shadow 10%;
  width: 400px;
  border-radius: 5px;
}
    </style>
</head>

<body>
<div class="main-wrapper login-body d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-body">
            <div style="text-align: center" class="form-group">
                        <img  style="wdith: 200px; height: 200px;" src="images/partners.png" alt="Logo"><br>
                        <h4 style="color: white;">Enter new password to change!</h4>
                    </div>
             

                            <?php if (isset($_SESSION['error_message'])): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $_SESSION['error_message'] ?>
                                </div>
                                <?php unset($_SESSION['error_message']); ?>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['success_message'])): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $_SESSION['success_message'] ?>
                                </div>
                                <?php unset($_SESSION['success_message']); ?>
                            <?php endif; ?>
                                
                            <form method="post" class="form-group" style="text-align: center; color: white;">

    <div class="position-relative">
        <input style="padding-right: 35px;" class="form-control" type="password" name="new_password" placeholder="Password" required>
        <span onclick="togglePasswordVisibility('new_password', 'eyeIcon')" style="position: absolute; right: 10px; top: 45%; transform: translateY(-50%);">
            <i id="eyeIcon" class="fas fa-eye"></i>
        </span>
    </div>
    <br>
    
    <div class="position-relative">
        <input style="padding-right: 35px;" class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
        
    </div>
    <br>
    <input type="submit" class="btn btn-success btn-block" value="Change Password">
</form>
                        </div>
                    </div>
                </div>
 

    <script>
    function togglePasswordVisibility(passwordFieldName, eyeIconId) {
        const passwordInput = document.getElementsByName(passwordFieldName)[0];
        const eyeIcon = document.getElementById(eyeIconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            eyeIcon.className = 'fas fa-eye';
        }
    }
</script>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
