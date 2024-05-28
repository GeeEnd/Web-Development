<?php
session_start();
include "include/config.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: login.php?error=Username is Required");
        exit();
    } elseif (empty($pass)) {
        header("Location: login.php?error=Password is Required");
        exit();
    } else {
        // hashing the password
        $pass = md5($pass);

        $host = 'localhost';
        $dbname = 'binfosystem';
        $username = 'root';
        $password = '';

        try {
            // Establish a PDO connection
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Using prepared statements to prevent SQL injection
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name=? AND password=?");
            $stmt->execute([$uname, $pass]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $sessionid= rand(999999, 00000);
            if ($result) {

                if ($result['inf'] == 0) {
                    // Redirect the user with an error message
                    header("Location: login.php?error=You are not authorized to login. Account not yet activated");
                    exit();
                }
                $_SESSION['user_name'] = $result['user_name'];
                $_SESSION['name'] = $result['name'];
                $_SESSION['id'] = $result['id'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['profile_image'] = $result['profile_image'];
                $_SESSION['user_role'] = $result['user_role']; // Store user role in session

                // Insert login_logs
                $name = $result['name'];
                $user_role = $result['user_role']; // Fetch user role from result

                // Check if the user role is Technician
              //  if ($user_role === 'Technician') {
                    // Insert login_logs
                //    $insert_log_sql = "INSERT INTO login_logs (full_name, login_time, session_id) VALUES (?, CURRENT_TIMESTAMP, ?)";
                  //  $stmt = $pdo->prepare($insert_log_sql);
                   // $stmt->execute([$name, $sessionid]);
               // }
                // Redirect based on user role
                if ($result['user_role'] == 'Captain' || $result['user_role'] == 'Counselor') {

                    header("Location: Counselor/index.php");
                    exit();
                } elseif ($result['user_role'] == 'Technician') {
                    header("Location: Technician/index.php");
                    exit();
                } else {
                    // Handle unrecognized role
                    header("Location: login.php?error=Unrecognized user role");
                    exit();
                }
            } else {
                header("Location: login.php?error=Incorrect User name or password");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>
