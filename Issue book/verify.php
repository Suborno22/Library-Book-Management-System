<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $name = $_POST['name'];
    require(__DIR__.'/../dbconfig/connect.php');
    $sql = "SELECT * FROM `students_database` WHERE name='$name' LIMIT 1";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        echo 'You Exist, hence you can apply for a book from <a href="Issue_book.php">here</a>. '."<br>";
    }
    else {
        echo 'Get a membership first. Click <a href="../Membership/membership.php">here</a> to get one.'."<br>";
    }
    

    mysqli_close($conn);
}

?>
