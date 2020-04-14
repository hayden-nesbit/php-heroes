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
        echo "<br> id: ". $row["id"]. " - Name: ". $row["name"]. ". " . "<br>" . "Bio: ". $row["about_me"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();

?>