<?php

// Create connection
$conn = mysqli_connect("localhost","root","password","college");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully"."<br>";
echo "-----------------------------"."<br>";

// Step 2: Create a SQL query to select the data
$sql = "SELECT `book_name` FROM books";
$result = mysqli_query($conn, $sql);

// Step 3: Loop through the results of the query and display the data
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Name of the book " . $row["book_name"] . "<br>". "<br>";
    }
} else {
    echo  "<br>"."Its empty in here";
}

// Step 4: Close the database connection
mysqli_close($conn);
?>
