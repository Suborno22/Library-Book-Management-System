<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['submit'])) {
    // Get the input values from the form
    $name = $_POST['name'];
    $bname = $_POST['bname'];
    $author = $_POST['author'];
    require(__DIR__.'/../dbconfig/connect.php');

    // Find the book in the database
    $sql = "SELECT * FROM books WHERE book_name='$bname' AND author='$author'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Book found in the database, decrease the stock by 1
        $book = $result->fetch_assoc();
        if ($book['stock'] > 0) {
            $sql = "UPDATE books SET stock=stock-1 WHERE id=" . $book['id'];
            if ($conn->query($sql) === TRUE) {
                // Book stock updated successfully, insert the issuing history into the history table
                $sql = "INSERT INTO history (user_name, book_name, author_name) VALUES ('$name', '$bname', '$author')";
                if ($conn->query($sql) === TRUE) {
                    echo "Book issued successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Book is out of stock!";
        }
    } else {
        echo "Book not found!";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue a Book</title>
</head>
<body>
    <h1>Issue a Book</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name: </label>
        <input type="text" name="name" required><br><br>

        <label for="bname">Book Name: </label>
        <input type="text" name="bname" required><br><br>

        <label for="author">Author: </label>
        <input type="text" name="author" required><br><br>

        <input type="submit" name="submit" id="submit" />
    </form>
</body>
</html>
