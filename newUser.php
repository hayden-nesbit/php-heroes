
<?php 
require "connection.php";
require "header.php";

$userName = $_POST["heroname"]; 
$userBio = $_POST["biography"];
$userPower = $_POST["ability"];
$userPic = $_POST["image"];

$sql = "INSERT INTO heroes (name, biography, image_url) VALUES ('$userName', '$userBio', '$userPic')";
$result = $conn->query($sql);

if ($result === TRUE) {
    $last_id = $conn->insert_id;
    foreach($userPower as $ability) {
        $setPower = "INSERT INTO ability_hero (hero_id, ability_id) VALUES ('$last_id', '$ability')";
        $result = $conn->query($setPower);
    }
}


?>

<?php
require "footer.php";
$conn->close();

header("Location: /hero.php?id=" . $last_id);

?>