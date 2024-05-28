<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Barangay Management and Information System</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/partners.png">  
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #f4f4f4 !important; /* Light gray color */
        }
        .card {
            background: linear-gradient(to bottom, #008080, #000000) !important; /* Dark cyan to black */
            height: auto;
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
                <form id="loginForm" action="validate.php" method="post">
                    <div style="text-align: center" class="form-group">
                        <div>
                            <p>
                                <img class="img-fluid" src="images/partners.png" alt="Logo" height="150px" width="150px"> <h2 style=" color: white;"><strong>BMIS</strong></h2>
                            </p>
                        </div>

                        <?php if (isset($_GET['error'])) { ?>
                            <p class="alert alert-danger" role="alert" class="error"><?php echo $_GET['error']; ?></p>
                        <?php } ?>

                        <?php if (isset($_GET['success'])) { ?>
                            <p class="alert alert-success" role="alert" class="success"><?php echo $_GET['success']; ?></p>
                        <?php } ?>

                        <!-- Your existing HTML content -->
                        <div class="js-focus-state input-group form">
                            <div class="input-group-prepend form__prepend">
                                <span class="input-group-text form__text">
                                    <i class="fa fa-user form__text-inner"></i>
                                </span>
                            </div>
                            <input style=" height: 50px;" class="form-control" type="text" name="uname" placeholder="Username" required>
                        </div>
                        <br>
                        <div class="position-relative">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>                    
                                    </div>
                                <input id="passwordInput" style="padding-right: 35px; height: 50px;" class="form-control" type="password" name="password" placeholder="Password" required>
                                <div class="input-group-prepend"><span id="eyeIcon" onclick="togglePasswordVisibility()" style="position: absolute; right: 15px; top: 52%; transform: translateY(-50%);">
                                    <i class="fas fa-eye"></i>
                                </span>       </div>
                            </div>
                           
                        </div> 
                        <div style="font-size: 15px; color: white; float: right;" class="text-center forgotpass">
                            <a href="forgot_password.php">Forgot Password?</a>
                            <span style="padding-left: 10px;"></span>
                        </div>
                        <br>
                        <button style="height: 50px; margin-top:10px;" class="btn btn-primary btn-block" type="button" onclick="submitLoginForm()"><strong style="font-size: 18px;">L O G I N</strong></button>
                    </div>
                 
                </form>
      
                            <p style="text-align: center; color:white;">Don't have an account? Click <a href="insert_resident_new.php">here!</a></p>
        
               <!-- <div class="text-center dont-have" style=" color: white;">Don’t have an account? <a style=" color:skyblue;" href="signup.php">Signup</a></div><br> -->
                <p class="small text-center " style="color: skyblue;">All rights reserved. © 2024.</p>
            </div>
        </div>
    </div>

    <script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.setAttribute('type', 'text');
            eyeIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.setAttribute('type', 'password');
            eyeIcon.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }

    function submitLoginForm() {
        document.getElementById('loginForm').submit();
    }
</script>



    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
