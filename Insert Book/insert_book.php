<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    if (isset($_POST['bname']) && isset($_POST['pdate']) && isset($_POST['author'])) {

        $name = $_POST['bname'];
        $pdate = $_POST['pdate'];
        $author = $_POST['author'];
        require(__DIR__ . '/../dbconfig/connect.php');

        $checkQuery = "SELECT * FROM `books` WHERE book_name = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, 's', $name); // Corrected parameter name to $name
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($result) > 0) {
            echo 'Book already exists. Please choose a different book';
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO `books` (book_name, publishing_date, author_name) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'sss', $name, $pdate, $author);
            $query = mysqli_stmt_execute($stmt);

            if ($query) {
                echo 'Entry Successful';
            } else {
                echo 'Error Occurred';
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>
