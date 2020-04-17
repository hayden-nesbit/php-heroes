<?php 
require "connection.php";
require "header.php";

$post = $_POST["post"]; 

$sql = "INSERT INTO posts (post) VALUES ('$post')";
$result = $conn->query($sql);
echo $result;


require "footer.php";
$conn->close();

header("Location: /index.php");



?>

