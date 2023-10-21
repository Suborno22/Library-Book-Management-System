<?php
require(__DIR__.'/../dbconfig/connect.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

    if(isset($_POST['bname']) && isset($_POST['author']) && isset($_POST['stock'])){

        $name = $_POST['bname'];
        $author = $_POST['author'];
        $stock = $_POST['stock'];

        $stmt = mysqli_prepare($conn, "INSERT INTO `books` (book_name,author,stock) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssi', $name, $author, $stock);
        $query = mysqli_stmt_execute($stmt);

        if($query){
            echo 'Entry Successful';
        }
        else{
            echo 'Error Occurred';
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
