<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="9">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    td {
        border: 1px solid black;
    }
    th {
        border: 2px solid black;
    }
    p {
        color: red;
    }
    .action-button {
        background-color: #4CAF50;
        color: white;
        padding: 6px 12px;
        border: none;
        cursor: pointer;
        text-decoration: none; /* Remove underline from the link */
    }
</style>
<body>
<?php
require(__DIR__.'/../dbconfig/connect.php');

// Step 2: Create a SQL query to select the data
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>
<table cellpadding="1px" cellspacing="5px">
    <tr>
        <th>Name</th>
        <th>Author</th>
        <th>Action</th>
    </tr>
    <?php
    // Step 3: Loop through the results of the query and display the data
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['book_name'] . "</td>";
            echo "<td>" . $row['author_name'] . "</td>";
            echo "<td>";
            // Wrap the button in an anchor element with a link (e.g., "#")
            echo "<a href='#' class='action-button'>Action</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>It's empty in here</td></tr>";
    }

    // Step 4: Close the database connection
    mysqli_close($conn);
    ?>
</table>
</body>
</html>
