<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['status']) && isset($_POST['phone']) && isset($_POST['password'])){        $fullname = $_POST['username'];
        
        $fullname = $_POST['username'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        
        $fullname = str_replace(' ', '', $fullname);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        require(__DIR__.'/../dbconfig/connect.php');

        // Check if the username already exists
        $checkQuery = "SELECT * FROM `admins` WHERE username = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, 's', $fullname);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($result) > 0) {
            echo 'Username already exists. Please choose a different username.';
        } else {
            // Insert the new user
            $insertQuery = "INSERT INTO `user` (username, email, status, phone, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, 'sssss', $fullname, $email, $status, $phone, $hashedPassword);

            $query = mysqli_stmt_execute($stmt);

            if ($query) {
                echo 'Entry Successful';
            } else {
                echo 'Error Occurred';
            }
            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($checkStmt);
        mysqli_close($conn);
    }
}
?>
