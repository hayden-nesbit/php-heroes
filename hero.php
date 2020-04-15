<?php

require "connection.php";
require "header.php";
require "footer.php";

$id = $_GET["id"];

$sql = "SELECT * FROM heroes WHERE id = " . $id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = "";
    echo '<div class="container pl-5">';
    while ($row = $result->fetch_assoc()) {
        $output .= "<h3> $row[name]</h3></a>" . $row["biography"] . "<br>" . "<br>";
                    "<br";
    }

    echo $output;
    echo '</div>';

} else {
    echo "0 results";
}


$sql = "SELECT * FROM relationships WHERE hero1_id = $id OR hero2_id = $id AND type_id = 1";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    $output = "";
    echo '<div class="container pl-5">';
    echo "<h4>Friends</h4>";
    while ($row = $result->fetch_assoc()) {
        $output .= "<p>$row[hero1_id]</p>";
    }

    echo $output;
    echo '</div>';
} else {
    echo "0 results";
}

    
$conn->close();

?>