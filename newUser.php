
<?php 
require "connection.php";
require "header.php";

$userName = $_POST["heroname"]; 
$userBio = $_POST["biography"];
$userPower = $_POST["ability"];



$sql = "INSERT INTO heroes (name, biography) VALUES ('$userName', '$userBio')";
var_dump($sql);
$result = $conn->query($sql);



?>

<?php
require "footer.php";
$conn->close();
?>