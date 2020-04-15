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


$sql = "SELECT * FROM relationships INNER JOIN heroes on relationships.hero2_id=heroes.id WHERE (hero1_id = " . $id . ") AND (type_id = 1);";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = "";
    echo '<div class="container pl-5">';
    echo "<div class='row'>";
    echo "<div class='col-4'>";
    echo "<h5>Friends</h5>";
    while ($row = $result->fetch_assoc()) {
        $output .= "<li class='pl-3'>$row[name]</li>";
    }

    echo $output;
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo "0 results";
}


$sql = "SELECT * FROM ability_hero 
    INNER JOIN abilities on abilities.id=ability_hero.ability_id 
    INNER JOIN heroes on heroes.id=ability_hero.hero_id 
    WHERE (ability_hero.hero_id = $id)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = "";
    echo '<div class="container pl-5 mt-3">';
    echo "<div class='row'>";
    echo "<div class='col-4'>";
    echo "<h5>Super Powers</h5>";
    while ($row = $result->fetch_assoc()) {
        $output .= "<li class='pl-3'>$row[ability]</li>";
    }

    echo $output;
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo "0 results";
}

    
$conn->close();

?>