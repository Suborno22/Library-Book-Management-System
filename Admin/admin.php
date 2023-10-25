<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['full_name']) && isset($_POST['password'])) {
        $fullname = $_POST['full_name'];
        $fullname = str_replace(' ', '', $fullname);
        $password = $_POST['password'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        require(__DIR__.'/../dbconfig/connect.php');

        // Check if the username already exists
        $checkQuery = "SELECT * FROM `admins` WHERE full_name = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, 's', $fullname);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($result) > 0) {
            echo 'Username already exists. Please choose a different username.';
        } else {
            // Insert the new user
            $insertQuery = "INSERT INTO `admins` (full_name, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, 'ss', $fullname, $hashedPassword);
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
