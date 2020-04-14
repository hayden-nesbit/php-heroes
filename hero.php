<?php

require "connection.php";
require "header.php";

$id = $_GET["id"];

$sql = "SELECT * FROM heroes WHERE id = " . $id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hero = "hero.php?id=" . $row["id"];
        echo "<h3> $row[name]</h3></a>" . $row["biography"] . "<br>" . "<br>";
        echo "<br";
        echo "<a href='index.php'>". "Back" . "</a>";
    }
} else {
    echo "0 results";
}

$sql = "SELECT * FROM relationships WHERE hero1_id = $id OR hero2_id = $id AND type_id = 1";
$result = $conn->query($sql);
var_dump($result) ;

$conn->close();

?>