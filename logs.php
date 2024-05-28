<?php
// Start the session
session_start();

// Include database connection
$host = 'localhost';
$dbname = 'laboratory_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error connecting to database: " . $e->getMessage();
    die(); // Exit script
}

// Fetch the user ID of the last person who logged in based on the auto-incremented primary key
$sqlLastLogin = "SELECT id FROM login_logs ORDER BY id DESC LIMIT 1";
$stmtLastLogin = $pdo->query($sqlLastLogin);
$lastUserId = $stmtLastLogin->fetchColumn();

// Update the logout time in the login_logs table for the last login entry
$sqlUpdate = "UPDATE login_logs SET logout_time = CURRENT_TIMESTAMP WHERE id = ?";
$stmtUpdate = $pdo->prepare($sqlUpdate);
$stmtUpdate->execute([$lastUserId]);

// Fetch login logs from the database
$sqlSelect = "SELECT * FROM login_logs WHERE id = ?";
$stmtSelect = $pdo->prepare($sqlSelect);
$stmtSelect->execute([$lastUserId]);
$login_logs = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Logs</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/settings.png">  
</head>
<body>
    <div class="container">
    <div class="alert alert-success" role="alert">
            You have successfully logged out.
        </div>
   <p>For added security, you may counter check the transactions you made for this log session against the list below.</p>
      
        <table class="table mt-3 table table-bordered border-primary">
            <thead>
                <tr>
                <th scope="col">SESSION ID</th> 
                    <th scope="col">NAME</th>
                    <th scope="col">LOGIN TIME</th>
                    <th scope="col">LOGOUT TIME</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($login_logs as $log) : ?>
                    <tr>
                    <td><?php echo $log['session_id']; ?></td>
                        <td><?php echo $log['full_name']; ?></td>
                        <td><?php echo $log['login_time']; ?></td>
                        <td><?php echo $log['logout_time']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="login.php" class="btn btn-primary mt-3">Back to login</a>
       
    </div>
</body>
</html>

