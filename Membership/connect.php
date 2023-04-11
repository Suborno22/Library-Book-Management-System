<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $conn = mysqli_connect('localhost','root','','college') or die("Connection failed:".mysqli_connect_error());

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['semester']) && isset($_POST['department'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $semester = $_POST['semester'];
        $department = $_POST['department'];

        $stmt = mysqli_prepare($conn, "INSERT INTO `students_database` (name,email,phone,semester, department) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $phone, $semester, $department);
        $query = mysqli_stmt_execute($stmt);

        if($query){
            echo 'Entry Successful';
        }
        else{
            echo 'Error Occured';
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
