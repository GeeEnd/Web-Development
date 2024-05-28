<?php      session_start(); ?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Bukidnon Online Guidance Appointment System</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/partners.png">
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
                        <img  style="wdith: 200px; height: 200px;" src="images/partners.png" alt="Logo">
                    </div>
    
                            <div class="form-group">
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
                                <h4 style="text-align: center; color: white;">Enter Your Email To Reset Your Password</h4>

								<?php
                           
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'include/config.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_email = $_POST["recipient_email"];
    $code = rand(999999, 111111);

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$recipient_email'";
    $result = $conn->query($checkEmailQuery);


    if ($result->num_rows > 0) {
        // Email found in the database, proceed with sending the reset code
        $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->Username = 'giljordan0373@gmail.com';
        $mail->Password = 'hensxbvwuotbmtwr';

        $mail->setFrom('gee.eentaguiam@gmail.com', 'Barangay Information and Management System');
        $mail->addAddress($recipient_email);

        $mail->isHTML(true);
        $mail->Subject = 'Electronics Laboratory';
        $mail->Body = "Good morning! Your Password Reset Code is:<strong><br> $code <br>";

        $mail->send();
			

        $insertCodeQuery = "UPDATE users SET code = $code WHERE email = '$recipient_email'";
        if ($conn->query($insertCodeQuery) === TRUE) {
            $alert_message = "Code has been sent to $recipient_email";
            $_SESSION['success_message'] = $alert_message;
            header("Location: activation.php?email=" . urlencode($recipient_email));
            exit();
        } else {
            $_SESSION['error_message'] = "Failed to insert code into the database!";
            header("Location: forgot_password.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Failed while sending code! Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
        header("Location: forgot_password.php");
        exit();
    }
} else {
    // Email not found in the database, set an error message
    $_SESSION['error_message'] = "The email provided is not found!";
    header("Location: forgot_password.php");
    exit();
}
}
// Close the database connection
$conn->close();
?>

                                <form method="post" >
                                    <label for="recipient_email"></label>
                                    <input type="email" class="form-control" name="recipient_email" placeholder="Email" id="recipient_email" required>
                                    <div><p></p></div>
                                    <input type="submit" class="btn btn-success btn-block" value="Send">
                                </form>
                            </div>
                        </div>
         
    
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
