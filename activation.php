<?php
session_start();
require 'include/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Bukidnon Online Guidance Appointment System</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icons8-user-64.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .login-right {
            background: linear-gradient(to bottom, #3498db, #000000);
        }

        .login-left {
            background: linear-gradient(to bottom, #3498db, #000000);
        }

        .login-box {
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
            <img  style="wdith: 200px; height: 200px;" src="images/partners.png" alt="Logo">
                    </div>
                        <div class="form-group">
                        <h4 style="text-align: center; color: white;">Activation Page</h4>
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
                          
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $entered_code = $_POST["activate"];

                                // Check if the entered code matches the stored code for any user
                                $checkCodeQuery = "SELECT * FROM users WHERE code = $entered_code";
                                $result = $conn->query($checkCodeQuery);

                                if ($result->num_rows > 0) {
                                    // Code matches, consider the user as authenticated
                                    $user = $result->fetch_assoc();
                                    $email = $user['email']; // Assuming 'email' is the column in the 'users' table
                                    $alert_message = "Code has been sent to $email";
                                    $_SESSION['success_message'] = $alert_message;
        
                                    header("Location: change-password.php?email=" . $email);
                                    exit();
                                } else {
                                    // Code doesn't match
                                  
                                    $_SESSION['error_message'] = "The code provided is incorrect!";
                                    header("Location: activation.php");
                                    exit();
                                }
                            }
                            ?>

                            <form method="post">
                                <label for="activate"></label>
                                <input type="text" class="form-control" name="activate" placeholder="Enter activation Code" id="activate" required>
                                <div><p></p></div>
                                <input type="submit" class="btn btn-success btn-block" value="Activate">
                            </form>
                        </div>
                    </div>
                </div>

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
