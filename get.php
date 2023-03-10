<html>
<link rel="stylesheet" href="style.css">
</html>
<?php
//connecting to the message database
$host = "your_db_host";//your database hostname
$user = "db_username"; //your database username
$password = "db_password";//your database password
$dbname = "db_name"; //your database name

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM messages_table_name ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {//message display
    echo "<p><strong>" . $row['user'] . "</strong>: " . $row['message'] . "<br>" . "date: " . "<span class='format'>". "(" . $row['created_at'] . ")" . "</span>" . "</p>";
  }
} else {
  echo "<p>No messages.</p>";
}

mysqli_close($conn);
?>

