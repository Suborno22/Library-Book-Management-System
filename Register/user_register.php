<?php
ob_start(); // Start output buffering
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])){        
        
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $status = 'user';


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        require(__DIR__.'/../../dbconfig/connect.php');

        // Check if the username already exists
        $checkQuery = "SELECT * FROM `persons` WHERE username = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, 's', $username);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($result) > 0) {
            echo 'Username already exists. Please choose a different username.';
        } else {
            // Insert the new user
            $insertQuery = "INSERT INTO `persons` (username, email, status, phone, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, 'sssss', $username, $email, $status, $phone, $hashedPassword);

            $query = mysqli_stmt_execute($stmt);

            if ($query) {
                header("Location: /../../Homepage/Homepage.html");
                exit();
            } else {
                echo 'Error Occurred';
            }
            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($checkStmt);
        mysqli_close($conn);
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
</head>
<body>
    <form method="post" onsubmit="return validateForm()">
        <label for="username">Full Name: </label>
        <input type="text" id="username" name="username">
        
        <label for="email">Email: </label>
        <input type="email" id="email" name="email">
        
        <label for="phone">Phone Number: </label>
        <input type="number" id="phone" name="phone">
        
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required>
        
        <label for="cpassword">Confirm Password: </label>
        <input type="password" id="cpassword" name="cpassword" required>        
        
        <input type="submit" name="submit" id="submit" />
    </form>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var cpassword = document.getElementById("cpassword").value;
            var string = document.getElementById("username").value;
            var letters = /^[A-Za-z\s]+$/; 
            var phone = document.getElementById("phone").value;
            var length = phone.toString().length;
            var email = document.getElementById("email").value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!letters.test(string)) {
                alert("Name should contain only letters and spaces.");
                return false;
            }
            else if (password.length < 8 || password.length > 10) {
                alert("Password must be between 8 and 10 characters.");
                return false;
            }
            else if(password !== cpassword){
                alert("Please rewrite the password again");
                return false;
            }
            else if (!email.match(emailPattern)) {
                alert("Please enter a valid email address.");
                return false;
            }
            else if(length >10){
                alert("Number should be 10 digits")
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

