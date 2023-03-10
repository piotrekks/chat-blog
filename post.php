<?php
// Get data from the form
$name = $_POST['user'];
$message = $_POST['message'];

// connecting to the message database
$host = "your_db_host";//your database hostname
$user = "db_username"; //your database username
$password = "db_password";//your database password
$dbname = "db_name"; //your database name

$conn = mysqli_connect($host, $user, $password, $dbname);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Save the message to the database
$sql = "INSERT INTO messages_table_name (user, message) VALUES ('$name', '$message')";
if (mysqli_query($conn, $sql)) {
    echo "New message added successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
