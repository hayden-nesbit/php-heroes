<!DOCTYPE html>
<html>

<h1>Hello!</h1>


<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "php-heros";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<a href="."><h3>$row[name]</h3></a>". "Bio: ". $row["about_me"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

</html>
