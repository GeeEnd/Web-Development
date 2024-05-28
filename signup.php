<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Sign Up</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/partners.png">  
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <style>
             body {
            background-color: #f4f4f4 !important; /* Light gray color */
        }
        .card{
            background: linear-gradient(to bottom, #008080, #000000) !important; /* Dark cyan to black */
            
            box: shadow 30%;
            width: 400px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="main-wrapper login-body d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-body">
                 <form action="signup-check.php" method="post" enctype="multipart/form-data">
                    <div style="text-align:center;">
                        <p>
                            <img class="img-fluid" src="images/partners.png" alt="Logo" style="max-height: 150px; width: auto;">
                            <h2 style=" color: white;"><strong>BMIS</strong></h2>
                        </p>
                    </div>
                    <!-- Display Success and Error Messages -->
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_SESSION['success_message'] ?>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['error_message'] ?>
                        </div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                    <!-- End Display Success and Error Messages -->

                    <div class="form-group">
                    
                        <input type="text" name="id_number" class="form-control" placeholder="School ID" required><br>
             
                        <?php if (isset($_GET['name'])): ?>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?= $_GET['name'] ?>"><br>
                        <?php else: ?>
                            <input type="text" name="name" class="form-control" placeholder="Name" required><br>
                        <?php endif; ?>
                       

                        <div id="emailValidationNote" style="color: white; font-size: 12px;"></div>
                        <?php if (isset($_GET['email'])): ?>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $_GET['email'] ?>" oninput="validateEmail()"><br>
                        <?php else: ?>
                            <input type="email" name="email" class="form-control" placeholder="Email" required oninput="validateEmail()"><br>
                        <?php endif; ?>

                        <?php if (isset($_GET['uname'])): ?>
                            <input type="text" name="uname" class="form-control" placeholder="User Name" value="<?= $_GET['uname'] ?>"><br>
                        <?php else: ?>
                            <input type="text" name="uname" class="form-control" placeholder="User Name" required><br>
                        <?php endif; ?>
                        
                        <!-- Password Strength Note and Input -->
                        <div id="passwordStrengthNote" style="color: white; font-size: 12px;">Password must be at least 8 characters long, contain special characters, and have at least one uppercase letter</div>
                        <div id="passwordContainer" style="position: relative;">
                            <input type="password" name="password" class="form-control" placeholder="Password" required id="passwordInput" style="padding-right: 35px;"><br>
                            <!-- Eye icon for password visibility toggle -->
                            <span onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 15%; transform: translateY(-50%);">
                                <i id="eyeIcon" class="fas fa-eye"></i>
                            </span>
                            <!-- Password Confirmation -->
                            <div id="passwordMatchNote" style="color: white; font-size: 14px;"></div>
                            <input type="password" class="form-control" name="re_password" id="passwordInput2" oninput="validatePasswordMatch()" placeholder="Confirm Password" required style="padding-right: 35px;"><br>
                        </div>
    
                    <!-- Profile Image Upload -->
                    <div class="form-group">
                        <label style="color: white;" for="profileImage">Profile Image</label>
                        <input type="file" class="form-control" id="profileImage" name="profileImage">
                    </div>
                    <!-- Register Button -->
                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block" type="submit">Register</button>
                    </div>
                    <div class="login-or">
                        <span class="or-line"></span> <span class="span-or"></span>
                    </div>
                    <!-- Login Link -->
                    <div class="text-center dont-have">Already have an account? <a style=" color: white;" href="login.php">Login</a> </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </form>
    <!-- Scripts -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/script.js"></script>
    <!-- Script for Password Visibility Toggle -->
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('passwordInput');
            var eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        }
    </script>
    <!-- Script for Password Match Validation -->
    <script>
        function validatePasswordMatch() {
            var passwordInput = document.getElementById('passwordInput');
            var passwordInput2 = document.getElementById('passwordInput2');
            var passwordMatchNote = document.getElementById('passwordMatchNote');

            if (passwordInput.value !== passwordInput2.value) {
                passwordMatchNote.innerHTML = 'Passwords do not match!';
                passwordMatchNote.style.color = 'maroon'; 
            } else {
                passwordMatchNote.innerHTML = 'Passwords match.';
                passwordMatchNote.style.color = 'teal'; 
            }
        }
    </script>
    <!-- Script for Email Validation -->
    <script>
        function validateEmail() {
            var emailInput = document.getElementsByName('email')[0];
            var emailValidationNote = document.getElementById('emailValidationNote');
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(emailInput.value)) {
                emailValidationNote.innerHTML = 'Please enter a valid and live email.';
                setTimeout(function () {
                    emailValidationNote.style.visibility = 'hidden';
                }, 500);
                setTimeout(function () {
                    emailValidationNote.style.visibility = 'visible';
                }, 1000);
            } else {
                emailValidationNote.innerHTML = '';
            }
        }
    </script>
</body>
</html>
