<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling_book.css">
    <title>List of books</title>
</head>
<body>
<?php
require(__DIR__.'/../dbconfig/connect.php');

// Step 2: Create a SQL query to select the data
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>
<table cellpadding="7px" cellspacing="5px">
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Author</th>
        <th>Action</th>
    </tr>
    <?php
    // Step 3: Loop through the results of the query and display the data
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>". $row["id"]. "</td>";
            echo "<td>" . $row['book_name'] . "</td>";
            echo "<td>" . $row['author_name'] . "</td>";
            echo "<td>";
            // Wrap the button in an anchor element with a link (e.g., "#")
            echo "<a href='#' class='action-button'>Action</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4' id=warning>It's empty in here</td></tr>";
    }

    // Step 4: Close the database connection
    mysqli_close($conn);
    ?>
</table>
</body>
</html>
