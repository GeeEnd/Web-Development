<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "include/config.php";

if (
    isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password']) && isset($_POST['email'])
) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id_number = validate($_POST['id_number']);
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);

    // Check if passwords match
    if ($pass !== $re_pass) {
        $_SESSION['error_message'] = 'Passwords do not match';
        header("Location: signup.php");
        exit();
    }

    // Determine user role based on id_number
    $user_role = is_numeric($id_number) ? 'Student' : 'Faculty';

    // Hashing the password using md5 (You might want to use a more secure hashing algorithm)
    $pass = md5($pass);

    // Simulate activation process
    // Add a delay to simulate processing
    sleep(2);

    $sql = "SELECT * FROM users WHERE user_name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $uname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['error_message'] = 'The Username is Already Taken, Try Another!';
        header("Location: signup.php");
        exit();
    } else {
        // Handle file upload
        $targetDirectory = "assets/images/users/";

        $targetFile = $targetDirectory . basename($_FILES["profileImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {

            $sql2 = "INSERT INTO users (id_number, user_name, password, name, email, profile_image, created_at, user_role) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, 'sssssss', $id_number, $uname, $pass, $name, $email, $targetFile, $user_role);
            mysqli_stmt_execute($stmt2);

            if ($stmt2) {
                // Set success message
                $_SESSION['success_message'] = 'Your account has been created successfully. Please wait for your email confirmation for activation.';
                header("Location: signup.php");
                exit();
            } else {
                $_SESSION['error_message'] = 'Unknown error occurred';
                header("Location: signup.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = 'Sorry, there was an error uploading your file.';
            header("Location: signup.php");
            exit();
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
